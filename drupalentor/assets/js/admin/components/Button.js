import { html, Component } from 'htm/preact';

import Icon from './Icon';

export const ButtonSize = {
  SMALL: 'sm',
  MEDIUM: 'md',
  LARGE: 'lg'
};

export const ButtonStyle = {
  PRIMARY: 'primary',
  SECONDARY: 'secondary',
  LINK: 'LINK',
  OUTLINED: 'outlined'
};

export default class Button extends Component {
  static defaultProps = {
    type: 'button',
    style: ButtonStyle.SECONDARY,
    size: ButtonSize.MEDIUM,
    label: null,
    icon: null,
  }

  render ({ type, label, style, size, icon, children, ...props }) {
    const exclude = [
      `c-button--${Button.defaultProps.style}`,
      `c-button--${Button.defaultProps.size}`
    ];

    const classes = [
      'c-button',
      `c-button--${style}`,
      `c-button--${size}`
    ]
      .filter((className) => (
        !exclude.includes(className)
      ));

    return html`
      <button type="${type}" class="${classes.join(' ')}" ...${props}>
        ${icon !== null && html`
          <${Icon} name="${icon}" align="left" />
        `}
        ${label || children}
      </button>
    `;
  }
}
