import {
  html,
  Component
} from 'htm/preact';

export default class GeolocationField extends Component {
  static defaultProps = {
    google: null,
    id: 'geolocation',
    name: 'geolocation',
    label: 'Ort',
    value: '',
    placeholder: 'Ort oder Postleitzahl',
    countries: ['de', 'at', 'pl'],
    required: true,
    disabled: false,
    readonly: false,
    onLoad: () => {},
    onInput: () => {},
    onSelect: () => {},
  }

  state = {
    autocomplete: null
  }

  componentDidUpdate() {
    const google = this.props.google || this.context.google || null;
    const autocomplete = this.state.autocomplete || null;

    if (autocomplete === null && google !== null) {
      this.boot({ google });
    }
  }

  componentWillUnmount () {
    if (this.state.autocomplete) {
      this.state.autocomplete.unbindAll();
    }
  }

  getChildContext () {
    return {
      google: this.props.google || this.context.google,
      autocomplete: this.state.autocomplete
    };
  }

  getQuery () {
    return this.input.value;
  }

  getPlace () {
    return this.state.autocomplete.getPlace();
  }

  boot() {
    const autocomplete = new google.maps.places.Autocomplete(this.input, {
      fields: [
        'name',
        'geometry',
        'geometry.location',
        'formatted_address'
      ],
      componentRestrictions: {
        country: this.props.countries,
      }
    });

    autocomplete.addListener('place_changed', () => {
      const place = this.getPlace();
      const query = this.getQuery();

      if (place) {
        this.props.onSelect({ query, place });
      }
    });

    this.setState({ autocomplete });
    this.props.onLoad({ google, autocomplete });
  }

  render ({ id, name, label, value, placeholder, required, disabled, readonly, children, onInput }, { autocomplete }) {
    const isLoading = (autocomplete === null);

    return html`
      <div class="c-field">
        <label class="c-label / u-sr-only" for="${id}">
          ${label}
        </label>

        <input
          ref="${(el) => this.input = el}"
          type="search"
          id="${id}"
          name="${name}"
          value="${value}"
          placeholder="${placeholder}" class="c-input"
          readonly="${readonly}"
          disabled="${disabled || isLoading}"
          required="${required}"
          onInput="${onInput}"
        />

        ${children.length > 0 && html`
          <div class="c-field__help">
            ${children}
          </div>
        `}
      </div>
    `;
  }
}
