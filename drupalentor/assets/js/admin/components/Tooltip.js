import { html, Component } from 'htm/preact';

export const TooltipPlacement = {
  ABOVE: 'above',
  BELOW: 'below',
  LEFT: 'left',
  RIGHT: 'right'
};

export default class Tooltip extends Component {
  static defaultProps = {
    open: false,
    placement: TooltipPlacement.BELOW
  }

  render ({ open, animation, placement, children, ...props }) {
    const classes = [
      'c-tooltip',
      `c-tooltip--${placement}`
    ];

    return html`${
      open && html`
        <div class="${classes.join(' ')}" ...${props}>
          ${children}
        </div>
      `
    }`;
  }
}
