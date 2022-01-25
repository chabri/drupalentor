import {
  html,
  Component
} from 'htm/preact';

import {
  toLatLng
} from '../utilities/google';

import MapMarker from './MapMarker';
import MapInfoWindow from "./MapInfoWindow";

export default class LocationMarker extends Component {
  static defaultProps = {
    image: '/themes/custom/basic/assets/images/google/maps/marker-primary.png',
    size: [40, 60],
    origin: [0, 0],
    anchor: [20, 60],
  }

  state = {
    isActive: false,
    isLoaded: false,
    icon: null 
  }

  constructor (props, context) {
    super(props, context);

    this.handleClick = this.handleClick.bind(this);
    this.handleCloseClick = this.handleCloseClick.bind(this);
    this.handleContentLoad = this.handleContentLoad.bind(this);
  }

  componentDidMount() {
    this.setState({
      icon: {
        url: this.props.image,
        size: new google.maps.Size(...this.props.size),
        origin: new google.maps.Point(...this.props.origin),
        anchor: new google.maps.Point(...this.props.anchor)
      }
    });
  }

  componentDidUpdate(prevProps) {
    const {
      image,
      size,
      origin,
      anchor
    } = this.props;

    const {
      icon
    } = this.state;

    if (prevProps.image !== image) {
      icon.image = image;
    }

    if (prevProps.size !== size) {
      icon.size = new google.maps.Size(...size);
    }

    if (prevProps.origin !== origin) {
      icon.origin = new google.maps.Point(...origin);
    }

    if (prevProps.anchor !== anchor) {
      icon.anchor = new google.maps.Point(...anchor);
    }
  }

  show () {
    this.setState({ isActive: true });
  }

  hide () {
    this.setState({
      isActive: false,
      isLoaded: false
    });
  }

  toggle () {
    if (this.state.isActive) {
      this.hide();
    } else {
      this.show();
    }
  }

  handleContentLoad () {
    this.setState({ isLoaded: true });
  }

  handleClick (...args) {
    if (typeof this.props.onClick === 'function') {
      this.props.onClick(...args);
    }

    this.toggle();
  }

  handleCloseClick (...args) {
    if (typeof this.props.onCloseClick === 'function') {
      this.props.onCloseClick(...args);
    }

    this.hide();
  }

  render ({ position, children, ...props }, { isActive, isLoaded, icon }) {
    return html`
      <${MapMarker} icon="${icon}" position="${toLatLng(position)}" onClick="${this.handleClick}" ...${props}>
        ${isActive && html`
          <${MapInfoWindow} onContentLoaded="${this.handleContentLoad}" onCloseClick="${this.handleCloseClick}">
            ${isLoaded && children}
          </${MapInfoWindow}>
        `}
      </${MapMarker}>
    `;
  }
}
