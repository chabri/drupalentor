import { html, Component } from 'htm/preact';

export default class CarouselPaginationButton extends Component {
  static defaultProps = {
    active: false,
    disabled: false
  };

  render ({ active, disabled, children, ...props }) {
    const classes = [
      'c-carousel__dot',
      active && 'is-active',
      disabled && 'is-disabled'
    ]
      .filter(Boolean);

    return html`
      <button type="button" class="${classes.join(' ')}" disabled="${disabled}" ...${props}>
        ${children}
      </button>`;
  }
}
