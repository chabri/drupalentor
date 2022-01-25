import {
  html,
  Component
} from 'htm/preact';

import {
  get,
  head
} from '../utilities/misc';

import Carousel from './Carousel';
import CarouselItem from './CarouselItem';
import Map from './Map';
import MapMarkerClusterer from './MapMarkerClusterer';
import LocationMarker from './LocationMarker';

export default class LocationMap extends Component {
  static defaultProps = {
    items: [],
    center: null,
    groupBy: 'place',
    defaultGroup: 'unknown',
    labelPrev: 'Zurück',
    labelNext: 'Weiter'
  }

  filter (items, property = 'geolocation') {
    return items.filter((item) => get(item, property));
  }

  groupBy (items, key) {
    const groups = this.filter(items).reduce((registry, item) => {
        const group = get(item, key) || this.props.defaultGroup;

        if (!registry[group]) {
          registry[group] = [item];
        } else {
          registry[group].push(item);
        }

        return registry;
      }, {});

    return Object.entries(groups);
  }

  render ({ items, center, groupBy, render, children, ...props }) {
    return html`
      <${Map} center="${center}" ...${props}>
        <${MapMarkerClusterer}>
          ${this.groupBy(items, groupBy).map(([group, entries]) => html`
            <${LocationMarker} key="${group}" position="${get(head(entries), 'geolocation')}">
              ${entries.length === 1 ? (html`
                ${render({ item: head(entries) })}
              `) : (html`
                <${Carousel}>
                  ${entries.map((entry) => html`
                    <${CarouselItem} key="${entry.id}">
                      ${render({ item: entry })}
                    </${CarouselItem}>
                  `)}
                </${Carousel}>
              `)}
            </${LocationMarker}>
          `)}
        </${MapMarkerClusterer}>
        ${children}
      </${Map}>
    `;
  }
}
