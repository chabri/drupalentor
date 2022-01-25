import {
  html,
  Component
} from 'htm/preact';

import {
  compare,
  get
} from '../utilities/misc';

import {
  Service,
  getConsentStatus
} from '../utilities/uc';

import {
  City,
  MarkerIcon,
  geolocate, 
  geocode,
  lookup,
  distance,
  toLatLng
} from '../utilities/google';

import Button from './Button';
import ButtonGroup from './ButtonGroup';
import Card from './Card';
import ContactForm from './ContactForm';
import Dialog from './Dialog';
import Grid from './Grid';
import LocationMap from './LocationMap';
import LocationSearch from './LocationSearch';
import MapMarker from './MapMarker';
import Pagination from './Pagination';

export default class Finder extends Component {
  static defaultProps = {
    title: null,
    description: null,
    items: [],
    page: 1,
    perPage: 12,
    orderBy: 'familyName',
    order: 'ASC'
  }

  state = {
    isDialogOpen: false,
    google: null,
    query: '',
    item: null,
    location: null,
    address: null,
    center: City.BREMEN,
    page: this.props.page,
    perPage: this.props.perPage,
    orderBy: this.props.orderBy,
    order: this.props.order,
  }

  constructor (props, context) {
    super(props, context);

    this.handleMapLoad = this.handleMapLoad.bind(this);
    this.handleMapIdle = this.handleMapIdle.bind(this);

    this.handleLocationInput = this.handleLocationInput.bind(this);
    this.handleLocationChange = this.handleLocationChange.bind(this);
    this.handleLocationSubmit = this.handleLocationSubmit.bind(this);
    this.handleLocationReset = this.handleLocationReset.bind(this);

    this.handleDialogOpen = this.handleDialogOpen.bind(this);
    this.handleDialogClose = this.handleDialogClose.bind(this);

    this.handleCardSelect = this.handleCardSelect.bind(this);
    this.handlePageChange = this.handlePageChange.bind(this);
    this.handleMarkerMove = this.handleMarkerMove.bind(this);
  }

  getChildContext () {
    return {
      google: this.state.google
    };
  }

  async getCurrentLocation () {
    const result = await geolocate({ considerIp: true });

    return {
      location: get(result, ['location']),
      accuracy: get(result, ['accuracy']),
    };
  }

  async getAddress (location) {
    const results = await lookup(location);
    const place = results.shift();

    return {
      location: get(place, ['geometry', 'location']),
      address: get(place, ['formatted_address'])
    };
  }

  async getGeolocation (query) {
    const results = await geocode(query);
    const place = results.shift();

    return {
      query: query,
      location: get(place, ['geometry', 'location']),
      address: get(place, ['formatted_address'])
    };
  }

  getDistanceBetween (origin, target) {
    return distance(toLatLng(origin), toLatLng(target));
  }

  getDistanceToCurrentLocation (target) {
    const location = this.state.location;

    if (!target || !location) {
      return 0;
    }

    return this.getDistanceBetween(location, target);
  }

  paginate (items, page = 0, perPage = 10) {
    const start = (page - 1) * perPage;
    const end = Math.min(start + perPage, items.length);

    return items.slice(start, end);
  }

  sort (items, orderBy = 'familyName', order = 'ASC') {
    const direction = (order === 'ASC') ? 1 : -1;
    const getter = (orderBy === 'distance')
      ? (item) => this.getDistanceToCurrentLocation(item.geolocation)
      : (item) => get(item, orderBy);

    return items.sort((a, b) => direction * compare(getter(a), getter(b)));
  }

  handleMapLoad({ google = null }) {
    this.setState({ google });

    this.getCurrentLocation()
      .then((result) => this.setState({ center: toLatLng(result.location) }))
      .catch(() => this.setState({ center: City.BREMEN }));
  }

  handleMapIdle() {
    // TODO
  }

  handleLocationInput ({ query = '' }) {
    this.setState({ query });
  }

  handleLocationChange ({ query = '', location = null, address = null }) {
    if (address) {
      this.setState({ location, address, query, page: 1, center: location, orderBy: 'distance' });
    } else if (location) {
      this.getAddress(location).then(({ location, address }) => {
        this.setState({ location, address, query, page: 1, center: location, orderBy: 'distance' });
      });
    }
  }

  handleLocationSubmit () {
    this.getGeolocation(this.state.query).then(({ location, address }) => {
      this.setState({ location, address, page: 1, center: location, orderBy: 'distance' });
    });
  }

  handleLocationReset () {
    this.setState({
      query: '',
      location: null,
      address: null,
      orderBy: 'familyName'
    });
  }

  handlePageChange ({ page }) {
    this.setState({ page });
  }

  handleMarkerMove ({ latLng = null }) {
    this.getAddress(latLng).then(({ location, address }) => {
      this.setState({ location, address, center: location, query: '', orderBy: 'distance' })
    });
  }

  handleCardSelect ({ target }) {
    const element = target.closest('[id]') || target;
    const id = (element.id || '')
      .split(':')
      .pop();

    const item = this.props.items.find((item) => (
      item.id === id
    ));

    if (item) {
      this.setState({ item, center: toLatLng(item.geolocation) });
    }
  }

  handleDialogOpen ({ target }) {
    Drupal.webform = Drupal.webform || {};
    Drupal.webform.dialog = Drupal.webform.dialog || {};
    Drupal.webform.dialog.options = Drupal.webform.dialog.options || {};
    const element = target.closest('[id]') || target;
    const url = target.getAttribute("webform");
    const ajaxSettings = {
      url: url,
      dialogType: 'modal', 
      dialog: { width: 700,title: 'Jetzt Termin vereinbaren', },  
    }; 
    ajaxSettings.progress = {type: 'fullscreen'};

    let myAjaxObject = Drupal.ajax(ajaxSettings);
    myAjaxObject.execute();
  }

  handleDialogClose () {
    this.setState({ item: null, isDialogOpen: false });
  }

  render({ title, description, items }, { isDialogOpen, google, query, item, location, address, center, page, perPage, orderBy, order }) {
    const isGuardActive = (google === null);
    const hasSelection = (item !== null);

    return html`
      <div class="c-contact-finder">
        <div class="c-contact-finder__content">
          <h2 class="c-contact-finder__title / c-section-title / u-divider">
            ${title}
          </h2>
          <p class="c-contact-finder__description">
            ${description}
          </p>
          <p class="c-contact-finder__summary">
            ${items.length} Ansprechpartner
          </p>

          <${LocationSearch}
            class="c-contact-finder__form / c-search-form"
            query="${query}"
            address="${address}"
            location="${location}"
            onInput="${this.handleLocationInput}"
            onChange="${this.handleLocationChange}"
            onSubmit="${this.handleLocationSubmit}"
            onReset="${this.handleLocationReset}"
          />
        </div>

        <div class="c-contact-finder__map">
          <${LocationMap}
            items="${items}"
            consent="${getConsentStatus(Service.GOOGLE_MAPS)}"
            center="${center || City.BREMEN}"
            render="${({ item }) => html`<${Card} style="compact" item="${item}"/>`}"
            onLoad="${this.handleMapLoad}"
            onIdle="${this.handleMapIdle}"
          >
            <${MapMarker}
              title="Aktueller Standort"
              icon="${MarkerIcon.DOT}"
              position="${location}"
              draggable="${true}"
              onDragEnd="${this.handleMarkerMove}"
            />
          </${LocationMap}>
        </div>

        <${Grid}
          class="c-contact-finder__suggestions"
          items="${this.paginate(this.sort(items, orderBy, order), page, perPage)}"
          page="${page}"
          render="${({ item }) => html`
            <${Card} item="${item}" distance="${this.getDistanceToCurrentLocation(item.geolocation)}">
              ${item.geolocation && html`
                <${ButtonGroup} direction="vertical">
                  ${!isGuardActive && html`
                    <${Button} size="sm" icon="pin" onClick="${this.handleCardSelect}">
                      Auf der Karte anzeigen
                    </${Button}>
                  `}
                  ${item.email && html`
                    <${Button} size="sm" webform="/form/ansprechpartner?recipe_email=${item.email}"icon="calendar" onClick="${this.handleDialogOpen}">
                      Termin vereinbaren
                    </${Button}>
                  `}
                </${ButtonGroup}>
              `}
            </${Card}>
          `}"
        >
          <${Pagination}
            total="${items.length}"
            page="${page}"
            perPage="${perPage}"
            onChange="${this.handlePageChange}"
          />
        </${Grid}>

        <${Dialog} id="contact-dialog" open="${isDialogOpen && hasSelection}" onClose="${this.handleDialogClose}">
          <${ContactForm} action="/api/form/index.php" recipient="${item}" onDismiss="${this.handleDialogClose}" />
        </${Dialog}>
      </div>
    `;
  }
}
