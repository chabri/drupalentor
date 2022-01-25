import { html, Component } from 'htm/preact';

import loadGoogleMapsApi from 'load-google-maps-api';
import Spinner from './Spinner';

export function withGoogleMap (BaseComponent, credentials) {
  return class extends Component {
    static defaultProps = {
      version: 3,
      libraries: ['places'],
    }

    state = {
      google: null,
      error: null,
    }

    async componentDidMount () {
      const { version, libraries } = this.props;

      try {
        const options = credentials(this.props);
        const google = await loadGoogleMapsApi({ v: version, libraries, ...options });
        this.setState({ google });
      } catch (o_O) {
        this.setState({ error: o_O });
      }
    }

    getChildContext () {
      return {
        google: this.state.google
      };
    }

    render (props, { google }) {
      if (!google) {
        return html`<${Spinner}/>`;
      }

      return html`<${BaseComponent} ...${props}/>`;
    }
  }
}
