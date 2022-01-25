import {
  html,
  Component
} from 'htm/preact';

import throttle from 'just-throttle';

import Form from './Form';
import FieldGroup from './FieldGroup';

import ButtonGroup from './ButtonGroup';
import Button from './Button';
import SubmitButton from './SubmitButton';

import TextField from './TextField';
import TextArea from './TextArea';
import Checkbox from './Checkbox';

export default class ContactForm extends Component {
  static defaultProps = {
    id: 'appointment',
    action: null,
    recipient: null,
    onSubmit: () => {},
    onDismiss: () => {},
    onInvalid: () => {},
    onError: () => {}
  }

  state = {
    isLoading: false,
    isSuccess: false,
    isFailure: false,
    firstname: '',
    lastname: '',
    email: '',
    telephone: '',
    partner: '',
    nopartner: false,
    description: '',
    privacy: false,
    errors: {},
  }

  constructor (props, context) {
    super(props, context);

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleDismiss = this.handleDismiss.bind(this);

    this.handleInput = throttle(this.handleInput.bind(this), 200);
    this.handleChange = this.handleChange.bind(this);
  }

  async submit (data = {}) {
    const response = await fetch(this.props.action, {
      method: 'POST',
      body: new URLSearchParams(data),
      headers: {
        'Accept': 'application/json'
      }
    });

    return await response.json();
  }

  serialize () {
    return {
      form: this.props.id,
      recipient: this.props.recipient
        ? this.props.recipient.id
        : '',
      firstname: this.state.firstname,
      lastname: this.state.lastname,
      email: this.state.email,
      telephone: this.state.telephone,
      partner: !this.state.nopartner
        ? this.state.partner
        : '',
      nopartner: this.state.nopartner,
      description: this.state.description,
      privacy: this.state.privacy
    };
  }

  clear () {
    this.setState({
      firstname: '',
      lastname: '',
      email: '',
      telephone: '',
      partner: '',
      nopartner: '',
      description: '',
      privacy: '',
    });
  }

  handleSubmit (e) {
    e.preventDefault();

    this.setState({
      isLoading: true,
      isSuccess: false,
      isFailure: false,
      errors: {}
    });

    this.submit(this.serialize())
      .then((response) => {
        if (response.ok) {
          this.handleValidSubmission(response);
        } else {
          this.handleInvalidSubmission(response);
        }
      })
      .catch((e) => {
        this.handleUnknownError(e);
      });
  }

  handleDismiss (e) {
    this.props.onDismiss(e);
  }

  handleInput (e) {
    const element = e.target;

    const name = element.name || element.id;
    const value = element.value;

    this.setState({ [name]: value });
  }

  handleChange (e) {
    const element = e.target;

    const name = element.name || element.id;
    const value = element.checked;

    this.setState({ [name]: value });
  }

  handleValidSubmission (response) {
    this.setState({
      isLoading: false,
      isSuccess: true,
      isFailure: false,
      errors: {}
    });

    this.props.onSubmit(response);
    this.clear();
  }

  handleInvalidSubmission (response) {
    this.setState({
      isLoading: false,
      isSuccess: false,
      isFailure: true,
      errors: response.errors || {},
    });

    this.props.onInvalid(response);
  }

  handleUnknownError (e) {
    this.setState({
      isLoading: false,
      isFailure: true,
      isSuccess: false,
      errors: {},
    });

    this.props.onError(e);
  }

  render ({ id, action, recipient }, state) {
    return html`
      <${Form} method="post" action="${action}" novalidate onSubmit="${this.handleSubmit}">
        <h2 class="u-size-2 u-mb">
          Jetzt Termin vereinbaren
        </h2>

        <${FieldGroup}>
          <${TextField}
            label="Vorname"
            name="firstname"
            value="${state.firstname}"
            valid="${state.isFailure ? !state.errors.firstname : null}"
            help="${state.errors.firstname}"
            onInput="${this.handleInput}"
            required
          />
          <${TextField}
            label="Nachname"
            name="lastname"
            value="${state.lastname}"
            valid="${state.isFailure ? !state.errors.lastname : null}"
            help="${state.errors.lastname}"
            onInput="${this.handleInput}"
            required
          />
          <${TextField}
            label="E-Mail"
            name="email"
            value="${state.email}"
            valid="${state.isFailure ? !state.errors.email : null}"
            help="${state.errors.email}"
            onInput="${this.handleInput}"
            required
          />
          <${TextField}
            label="Telefon"
            name="telephone"
            value="${state.telephone}"
            valid="${state.isFailure ? !state.errors.telephone : null}"
            help="${state.errors.telephone}"
            onInput="${this.handleInput}"
          />
        </${FieldGroup}>

        <${FieldGroup}>
          ${!state.nopartner && html`
            <${TextField}
              label="Mein Fachhandwerker/Planer/Bauträger"
              name="partner"
              value="${state.partner}"
              valid="${state.isFailure ? !state.errors.partner : null}"
              help="${state.errors.partner}"
              onInput="${this.handleInput}"
            />
          `}
          <${Checkbox}
            name="nopartner"
            checked="${state.nopartner}"
            valid="${state.isFailure ? !state.errors.nopartner : null}"
            help="${state.errors.nopartner}"
            onChange="${this.handleChange}"
          >
            Ich habe keinen Fachhandwerker
          </${Checkbox}>
        </${FieldGroup}>

        <h3 class="u-size-3 u-mb">
          Meine Terminanfrage
        </h3>

        <p class="u-mb">
          Jedes Bau-Projekt ist einzigartig. Damit wir als Ihre persönlichen
          Ansprechpartner aus den Fachbereichen einen ersten wichtigen
          Eindruck von Ihren Zielsetzungen und Ihrem Bedarf bekommen,
          haben Sie im Anschluss die Möglichkeit, Ihr Projekt kurz zu
          skizzieren und uns Details mitzuteilen. Nach Eingabe und Absenden
          Ihrer Kontaktdaten setzen wir uns schnellstmöglich zu einer
          Terminvereinbarung mit Ihnen in Verbindung. Bitte beachten Sie,
          dass wir für Termine mindesten drei Tage Vorlauf benötigen.
        </p>

        <${FieldGroup}>
          <${TextArea}
            label="Hier finden Sie genügend Raum, Details zu Ihrem Projekt zu formulieren"
            name="description"
            value="${state.description}"
            valid="${state.isFailure ? !state.errors.description : null}"
            help="${state.errors.description}"
            onInput="${this.handleInput}"
          />
          <${Checkbox}
            name="privacy"
            checked="${state.privacy}"
            valid="${state.isFailure ? !state.errors.privacy : null}"
            help="${state.errors.privacy}"
            onChange="${this.handleChange}"
            required
          >
            Ich habe die <a href="/datenschutz" target="_blank"
            rel="noopener">Datenschutzerklärung</a> gelesen und akzeptiert.
          </${Checkbox}>
        </${FieldGroup}>

        <div class="c-form__feedback" aria-live="assertive" aria-atom="true">
          ${state.isSuccess && html`
            <div class="c-message c-message--info / u-mb" role="alert">
              <p>
                Ihre Anfrage wurde erfolgreich versendet. Bitte geben Sie uns
                etwas Zeit um Ihr Anliegen zu bearbeiten.
              </p>
            </div>
          `}
          ${state.isFailure && html`
            <div class="c-message c-message--error / u-mb" role="alert">
              <p>
                Ihre Anfrage konnte nicht versendet werden.
              </p>
            </div>
          `}
        </div>

        <${ButtonGroup}>
          <${SubmitButton} loading="${state.isLoading}">
            Absenden
          </${SubmitButton}>
          <${Button} onClick="${this.handleDismiss}">
            Abbrechen
          </${Button}>
        </${ButtonGroup}>

        ${recipient && html`
          <input type="hidden" name="form" value="${id}" />
          <input type="hidden" name="recipient" value="${recipient.id}" />
        `}
      </${Form}>
    `;
  }
}
