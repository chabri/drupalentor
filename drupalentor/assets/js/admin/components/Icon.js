import { html, Component } from 'htm/preact';

export const IconSize = {
  SMALL: 'sm',
  MEDIUM: 'md',
  LARGE: 'lg'
};

export const IconAlignment = {
  LEFT: 'left',
  CENTER: 'center',
  RIGHT: 'right'
};

export default class Icon extends Component {
  static defaultProps = {
    name: null,
    size: IconSize.MEDIUM,
    align: null
  }

  render ({ name, size, align, ...props }) {
    const classes = [
      'o-icon',
      size && `o-icon--${size}`,
      align && `o-icon--${align}`
    ];

    return html`
      <svg class="${classes.filter(Boolean).join(' ')}" ...${props}>
        <use xlink:href="${`/themes/custom/basic/assets/images/icons.svg#icon-${name}`}" />
      </svg>
    `;
  }
}
 