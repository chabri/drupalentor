import { html, Component } from 'htm/preact';

import Icon, { IconSize } from './Icon';

export default class IconButton extends Component {
  static defaultProps = {
    type: 'button',
    label: null,
    icon: null,
    size: IconSize.LARGE,
  }

  render ({ type, label, icon, size, children, ...props }) {
    const classes = [
      'c-button',
      'c-button--icon',
      `c-button--${icon}`
    ];

    return html`
      <button type="${type}" class="${classes.join(' ')}" ...${props}>
        <${Icon} name="${icon}" size="${size}" />
        <span class="u-sr-only">
          ${label || children}
        </span>
      </button>
    `;
  }
}
