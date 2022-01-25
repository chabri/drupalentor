import {
  html,
  Component
} from 'htm/preact';

import {
  addEventListeners,
  removeEventListeners
} from '../utilities/google';

export default class MapMarker extends Component {
  static defaultProps = {
    title: null,
    label: null,
    icon: null,
    position: null,
    draggable: false
  }

  static events = {
    onClick: 'click',
    onDoubleClick: 'dblclick',
    onPositionChanged: 'position_changed',
    onDragEnd: 'dragend'
  }

  state = {
    marker: new google.maps.Marker({
      title: this.props.title,
      label: this.props.label,
      icon: this.props.icon,
      position: this.props.position,
      draggable: this.props.draggable
    })
  }

  componentDidMount () {
    const {
      marker
    } = this.state;

    const {
      map,
      clusterer
    } = this.context;

    if (map) {
      marker.setMap(map);
    }

    if (clusterer) {
      clusterer.addMarker(marker);
    }

    this.listeners = addEventListeners(this, marker, MapMarker.events);
  }

  componentWillUnmount () {
    const marker = this.state.marker;
    const clusterer = this.context.clusterer;

    if (marker) {
      marker.setMap(null);

      if (clusterer) {
        clusterer.removeMarker(marker);
      }
    }

    removeEventListeners(this, marker, this.listeners);
  }

  componentDidUpdate (prevProps) {
    const {
      title,
      label,
      icon,
      position,
      draggable
    } = this.props;

    const {
      marker
    } = this.state;

    if (prevProps.title !== title) {
      marker.setTitle(title);
    }

    if (prevProps.label !== label) {
      marker.setLabel(label);
    }

    if (prevProps.icon !== icon) {
      marker.setIcon(icon);
    }

    if (prevProps.position !== position) {
      marker.setPosition(position);
    }

    if (prevProps.draggable !== draggable) {
      marker.setDraggable(draggable);
    }
  }

  getChildContext () {
    return {
      anchor: this.state.marker
    };
  }

  isDraggable () {
    return this.state.marker.getDraggable();
  }

  getTitle () {
    return this.state.marker.getTitle();
  }

  getLabel () {
    return this.state.marker.getLabel();
  }

  getIcon () {
    return this.state.marker.getIcon();
  }

  getPosition () {
    return this.state.marker.getPosition();
  }

  remove () {
    return this.state.marker.setMap(null);
  }

  render ({ children }) {
    return html`${children && children[0] || null}`;
  }
}
