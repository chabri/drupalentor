import { html, Component } from 'htm/preact';

import Avatar from './Avatar';
import Icon from './Icon';

export const CardStyle = {
  DEFAULT: 'default',
  COMPACT: 'compact',
};

export default class Card extends Component {
  static defaultProps = {
    item: null,
    photo: false,
    distance: 0,
    style: CardStyle.DEFAULT,
  }

  render ({ item, distance, style, photo, children }) {
    const isCompact = (style === CardStyle.COMPACT);
    const isLoose = (style !== CardStyle.COMPACT);

    const hasPhoto = (item.photo !== null);
    const hasChildren = (children.length > 0);

    return html`
      <article id="${`employee:${item.id}`}" class="${`c-contact-person${isCompact ? ' c-contact-person--compact' : ''}`}">

        ${isLoose && photo && html`
          <${Avatar} url="${hasPhoto ? item.photo.url : null}" class="c-contact-person__photo" />
        `}

        <div class="c-contact-person__details">
          <h3 class="c-contact-person__name / p-name">
            <span class="p-given-name">
              ${item.givenName}
            </span>
            ${' '}
            <span class="p-family-name">
              ${item.familyName}
            </span>
          </h3>

          ${item.jobTitle && html`
            <p class="c-contact-person__job-title / p-job-title">
              ${item.jobTitle}
            </p>
          `}

          ${item.role && html`
            <p class="c-contact-person__role / p-role">
              ${item.role}
            </p>
          `}

          ${item.note && html`
            <p class="c-contact-person__note / p-note">
              ${item.note}
            </p>
          `}

          ${item.address && html`
            <div class="c-contact-person__address / p-adr / h-adr">
              <span class="p-street-address">
                ${item.address.streetAddress}
              </span>
              ${' '}
              <span class="p-postal-code">
                ${item.address.postalCode}
              </span>
              ${' '}
              <span class="p-locality">
                ${item.address.locality}
              </span>
            </div>
          `}

          ${item.mobilephone && html`
            <div class="c-contact-person__telephone">
              <${Icon} name="phone" align="left"/>
              <span class="u-sr-only">
                Telefon:
              </span>
              ${' '}
              <span class="p-tel">
                ${item.mobilephone}
              </span>
            </div>
          `}

          ${item.email && html`
            <div class="c-contact-person__email">
              <${Icon} name="mail" align="left"/>
              <span class="u-sr-only">
                E-Mail:
              </span>
              ${' '}
              <a href="${`mailto:${item.email}`}" class="u-email">
                ${item.email}
              </a>
            </div>
          `}

          ${item.geolocation && html`
            <div class="c-contat-person__geolocation / p-geo / h-geo" hidden>
              <span class="p-latitude">
                ${item.geolocation.latitude}
              </span>
              ${', '}
              <span class="p-longitude">
                ${item.geolocation.longitude}
              </span>
            </div>
          `}

          ${(distance > 0) && html`
            <div class="c-contact-person__distance">
              <span class="u-sr-only">
                Entfernung:
              </span>
              ${distance.toLocaleString('de-DE', { maximumFractionDigits: 1 })} km
            </div>
          `}

          ${hasChildren && html`
            <div class="c-contact-person__footer">
              ${children}
            </div>
          `}
        </div>

      </article>
    `;
  }
}
