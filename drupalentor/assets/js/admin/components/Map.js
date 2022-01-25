import {
  html,
  Component
} from 'htm/preact';

import {
  City,
  ZoomLevel,
  addEventListeners,
  removeEventListeners
} from '../utilities/google';

import {
  withGoogleMap
} from './withGoogleMap';

import {
  withUserConfirmation
} from './withUserConfirmation';

import MapFallback from './MapFallback';
import MapPrompt from './MapPrompt';
import Spinner from './Spinner';

export class Map extends Component {
  static defaultProps = {
    google: null,
    animate: true,
    center: City.BREMEN,
    zoom: ZoomLevel.CITY,
    styles: [],
    onLoad: () => {},
  }

  static events = {
    onIdle: 'idle',
    onTilesLoaded: 'tilesloaded',
    onCenterChanged: 'center_changed',
    onBoundsChanged: 'bounds_changed',
    onZoomChanged: 'zoom_changed'
  }

  state = {
    map: null
  }

  componentDidMount () {
    const map = new google.maps.Map(this.canvas, {
      center: this.props.center,
      zoom: this.props.zoom,
      styles: this.props.styles
    });

    this.listeners = addEventListeners(this, map, Map.events);

    this.setState({ map });
    this.props.onLoad({ google, map });
  }

  componentWillUnmount () {
    removeEventListeners(this, this.state.map, this.listeners);
  }

  componentDidUpdate (prevProps) {
    const { animate, bounds, center, zoom } = this.props;

    if (prevProps.zoom !== zoom) {
      this.state.map.setZoom(zoom);
    }

    if (prevProps.bounds !== bounds) {
      if (animate) {
        this.state.map.panToBounds(bounds);
      } else {
        this.state.map.fitBounds(bounds);
      }
    }

    if (prevProps.center !== center) {
      if (animate) {
        this.state.map.panTo(center);
      } else {
        this.state.map.setCenter(center);
      }
    }
  }

  getChildContext () {
    return {
      google: this.props.google || this.context.google,
      map: this.state.map,
    };
  }

  getBounds () {
    return this.state.map.getBounds();
  }

  getCenter () {
    return this.state.map.getCenter();
  }

  getZoom () {
    return this.state.map.getZoom();
  }

  fitBounds (...args) {
    this.state.map.fitBounds(...args);
  }

  panTo (...args) {
    this.state.map.panTo(...args);
  }

  render ({ children, ...props }, { map }) {
    const isLoading = (map == null);

    return html`
      <div class="c-map" ref="${(el) => this.canvas = el}" ...${props}>
        ${isLoading ? (html`
          <${Spinner} />
        `) : (html`
          ${children}
        `)}
      </div>
    `;
  }
}

const GoogleMap = withGoogleMap(Map, () => ({
  v: GOOGLE_MAPS_API_VERSION,
  key: GOOGLE_MAPS_API_KEY
}));

export default withUserConfirmation(GoogleMap, MapPrompt, MapFallback);
