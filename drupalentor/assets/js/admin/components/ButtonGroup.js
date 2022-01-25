import { html, Component } from 'htm/preact';

export default class ButtonGroup extends Component {
  static defaultProps = {
    align: null,
    direction: null,
    reverse: false,
  };

  render ({ align, reverse, direction, children, ...props }) {
    const classes = [
      'c-button-group',
      align && `c-button-group--${align}`,
      direction && `c-button-group--${direction}`,
      reverse && `c-button-group--reverse`,
    ];

    return html`
      <div class="${classes.filter(Boolean).join(' ')}" ...${props}>
        ${children}
      </div>
    `;
  }
}
