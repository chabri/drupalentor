import {
  html,
  Component
} from 'htm/preact';

import {
  get,
  truncate
} from '../utilities/misc';

import {
  toLatLng
} from '../utilities/google';

import ButtonGroup from './ButtonGroup';
import Form from './Form';
import Geolocation from './Geolocation';
import GeolocationField from './GeolocationField';
import IconButton from './IconButton';
import Tag from './Tag';
import Tooltip from './Tooltip';

export default class LocationSearch extends Component {
  static defaultProps = {
    google: null,
    query: '',
    location: null,
    address: null,
    readonly: false,
    onInput: () => {},
    onChange: () => {},
    onSubmit: () => {},
    onReset: () => {},
    onError: () => {}
  }

  constructor (props, context) {
    super(props, context);

    this.handleInput = this.handleInput.bind(this);
    this.handleSelect = this.handleSelect.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleReset = this.handleReset.bind(this);
    this.handleError = this.handleError.bind(this);
  }

  getChildContext () {
    return {
      google: this.props.google || this.context.google
    };
  }

  handleInput ({ target }) {
    this.props.onInput({ query: target.value });
  }

  handleSelect ({ query, place }) {
    const location = toLatLng(get(place, ['geometry', 'location']))
    const address = get(place, ['formatted_address']);

    this.props.onChange({
      query,
      location,
      address
    });
  }

  handleSubmit (e) {
    e.preventDefault();

    if (!this.state.locked) {
      this.props.onSubmit();
    }
  }

  handleReset () {
    if (!this.state.locked) {
      this.props.onReset();
    }
  }

  handleGeolocation (position) {
    this.props.onChange({
      location: toLatLng(position),
      address: null
    });
  }

  handleError (e) {
    this.props.onError(e);
  }

  render ({ query, address, readonly }) {
    const google = (this.props.google || this.context.google || null);
    const ready = (google !== null);

    return html`
      <${Form} class="c-search-form / c-tooltip-anchor" onSubmit="${this.handleSubmit}">
        <${GeolocationField} value="${query}" readonly="${readonly}" onInput="${this.handleInput}" onSelect="${this.handleSelect}">
          ${address && html`
            <${Tag} icon="pin" disposable="${true}" onDispose="${this.handleReset}">
              ${truncate(address, 48)}
            </${Tag}>
          `}
        </${GeolocationField}>

        <${ButtonGroup}>
          <${Geolocation} onSuccess="${this.handleGeolocation}" onError="${this.handleError}" render="${({ isLoading, getCurrentPosition }) => html`
            <${IconButton} icon="location" label="Meinen Standort verwenden" disabled="${isLoading || !ready}" onClick="${() => getCurrentPosition()}" />
          `}"/>
          <${IconButton} type="submit" icon="search" label="Standort suchen" disabled="${readonly || !ready}" />
        </${ButtonGroup}>

        <${Tooltip} open="${!ready}">
          Die Suche nach Ansprechpartnern anhand von Ort oder
          Postleitzahle benötigt die Dienste von Google Maps. Bitte stimmen
          Sie der Nutzung von Google Maps Diensten zu, um die Suche zu
          verwenden.
        </${Tooltip}>
      </${Form}>
    `;
  }
}
