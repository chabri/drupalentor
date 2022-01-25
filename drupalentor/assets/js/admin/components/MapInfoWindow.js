import {
  html,
  Component
} from 'htm/preact';

import {
  addEventListeners,
  removeEventListeners
} from '../utilities/google';

import Portal from 'preact-portal';

export default class MapInfoWindow extends Component {
  static defaultProps = {
    position: null,
    maxWidth: 384,
    pixelOffset: [0, -5],
    disableAutoPan: false,
    zIndex: null
  }

  static events = {
    onContentChanged: 'content_changed',
    onContentLoaded: 'domready',
    onCloseClick: 'closeclick'
  }

  state = {
    infoWindow: new google.maps.InfoWindow({
      content: document.createElement('div'),
      position: this.props.position,
      maxWidth: this.props.maxWidth,
      pixelOffset: new google.maps.Size(...this.props.pixelOffset),
      disableAutoPan: this.props.disableAutoPan,
      zIndex: this.props.zIndex
    })
  }

  componentDidMount () {
    this.open();
    this.listeners = addEventListeners(this, this.state.infoWindow, MapInfoWindow.events);
  }

  componentWillUnmount () {
    this.close();
    removeEventListeners(this, this.state.infoWindow, this.listeners);
  }

  componentDidUpdate (prevProps) {
    const {
      position,
      zIndex
    } = this.props;

    const {
      infoWindow
    } = this.state;

    if (prevProps.position !== position) {
      infoWindow.setPosition(position);
    }

    if (prevProps.zIndex !== zIndex) {
      infoWindow.setZIndex(zIndex);
    }
  }

  getChildContext () {
    return {
      infoWindow: this.state.infoWindow
    };
  }

  getPosition () {
    return this.state.infoWindow.getPosition();
  }

  getContent () {
    return this.state.infoWindow.getContent();
  }

  open () {
    const { infoWindow } = this.state;
    const { anchor } = this.context;

    const map = infoWindow.getMap();
    const position = infoWindow.getPosition();

    if (anchor) {
      infoWindow.open(map, anchor);
    } else if (position) {
      infoWindow.open(map)
    } else {
      throw new Error('You must provide either an anchor element (e.g. a <Marker>) or an explicit position for the <InfoWindow>.')
    }
  }

  close() {
    this.state.infoWindow.close();
  }

  render ({ children }, { infoWindow }) {
    return html`
      <${Portal} into="${infoWindow.getContent()}">
        ${children}
      </${Portal}>
    `;
  }
}
