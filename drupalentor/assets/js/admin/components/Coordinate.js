import { html, Component } from 'htm/preact';

export default class Coordinate extends Component {
  static defaultProps = {
    location: null,
    separator: ', ',
    unit: '°',
    digits: 3,
    directions: {
      north: 'Nord',
      south: 'Süd',
      east: 'Ost',
      west: 'West'
    }
  }

  render ({ location, separator, unit, digits, directions, children, ...props }) {
    const hasLocation = (location !== null);

    return html`${hasLocation && html`
      <span class="h-geo" ...${props}>
        <span class="p-latitude">
          ${location.lat.toFixed(digits)}
          ${unit}${' '}
          ${location.lat > 0 ? directions.north : directions.south}
        </span>
        ${separator}
        <span class="p-longitude">
          ${location.lng.toFixed(digits)}
          ${unit}${' '}
          ${location.lng > 0 ? directions.east : directions.west}
        </span>
      </span>
    `}`;
  }
}
