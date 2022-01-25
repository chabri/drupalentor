import {
  html,
  Component
} from 'htm/preact';

import {
  addEventListeners,
  removeEventListeners
} from '../utilities/google';

import MarkerClusterer from '@google/markerclusterer';

export default class MapMarkerCluster extends Component {
  static defaultProps = {
    minimumClusterSize: 2,
    gridSize: 40,
    maxZoom: null,
    averageCenter: false,
    zoomOnClick: true,
    styles: [
      {
        url: '/themes/custom/basic/assets/images/google/clusterer/marker.png',
        anchor: [15, 0],
        width: 40,
        height: 75,
        textColor: '#fff',
        textSize: 12
      }
    ]
  }

  static events = {
    onClick: 'click',
    onClusteringBegin: 'clusteringbegin',
    onClusteringEnd: 'clusteringend'
  }

  state = {
    clusterer: new MarkerClusterer(this.context.map, [], {
      minimumClusterSize: this.props.minimumClusterSize,
      gridSize: this.props.gridSize,
      maxZoom: this.props.maxZoom,
      averageCenter: this.props.averageCenter,
      zoomOnClick: this.props.zoomOnClick,
      styles: this.props.styles
    })
  }

  componentDidMount () {
    this.listeners = addEventListeners(this, this.state.clusterer, MapMarkerCluster.events);
  }

  componentWillUnmount () {
    const clusterer = this.state.clusterer;

    clusterer.removeMarkers();
    clusterer.setMap(null);

    removeEventListeners(this, clusterer, this.listeners);
  }

  componentDidUpdate (prevProps) {
    const {
      gridSize,
      maxZoom,
      styles
    } = this.props;

    const {
      clusterer
    } = this.state;

    if (prevProps.gridSize !== gridSize) {
      clusterer.setGridSize(gridSize);
    }

    if (prevProps.maxZoom !== maxZoom) {
      clusterer.setMaxZoom(maxZoom);
    }

    if (prevProps.styles !== styles) {
      clusterer.setStyles(styles);
    }
  }

  getChildContext () {
    return {
      clusterer: this.state.clusterer
    };
  }

  getMarkers () {
    return this.state.clusterer.getMarkers();
  }

  getBounds() {
    return this.state.clusterer.getExtendedBounds();
  }

  getGridSize () {
    return this.state.clusterer.getGridSize();
  }

  getMaxZoom () {
    return this.state.clusterer.getMaxZoom();
  }

  getStyles () {
    return this.state.clusterer.getStyles();
  }

  addMarkers (...args) {
    this.state.clusterer.addMarkers(...args);
  }

  addMarker (...args) {
    this.state.clusterer.addMarker(...args);
  }

  remove () {
    this.state.clusterer.clearMarkers();
    this.state.clusterer.setMap(null);
  }

  render ({ children }) {
    return html`<div>${children}</div>`;
  }
}
