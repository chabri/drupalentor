import { Component } from 'htm/preact';

export default class Geolocation extends Component {
  static defaultProps = {
    enableHighAccuracy: false,
    timeout: (5 * 1000),
    maximumAge: (24 * 60 * 60 * 1000),
    onSuccess: () => {},
    onError: () => {}
  }

  state = {
    isLoading: false,
    position: null,
    error: null
  }

  constructor (props, context) {
    super(props, context);

    this.handleSuccess = this.handleSuccess.bind(this);
    this.handleError = this.handleError.bind(this);
  }

  static get isSupported () {
    return 'geolocation' in window.navigator;
  }

  static get isAllowed () {
    return (
      (window.location.protocol === 'https:') ||
      (window.location.hostname === 'localhost')
    );
  }

  getCurrentPosition () {
    this.setState({ isLoading: true });

    return window.navigator.geolocation.getCurrentPosition(this.handleSuccess, this.handleError, {
      enableHighAccuracy: this.props.enableHighAccuracy,
      timeout: this.props.timeout,
      maximumAge: this.props.maximumAge
    });
  }

  handleSuccess (position) {
    this.setState({ position, isLoading: false }, () => {
      this.props.onSuccess(position);
    });
  }

  handleError (error) {
    this.setState({ error, isLoading: false }, () => {
      this.props.onError(error);
    });
  }

  render () {
    if (
      !Geolocation.isSupported ||
      !Geolocation.isAllowed ||
      !this.props.render
    ) {
      return null;
    }

    const fn = this.getCurrentPosition.bind(this);
    const state = this.state;

    return this.props.render({ getCurrentPosition: fn, ...state }) || null;
  }
}
