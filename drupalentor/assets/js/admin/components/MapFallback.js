import { html, Component } from 'htm/preact';

export default class MapFallback extends Component {
  static defaultProps = {
    message: 'Interaktive Karte ist deaktiviert',
  }

  render ({ message, ...props }) {
    return html`
      <div class="c-map-fallback" ...${props}>
        <strong>
          ${message}
        </strong>
      </div>
    `;
  }
}
