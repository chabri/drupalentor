import { html, Component } from 'htm/preact';

export default class Label extends Component {
  static defaultProps = {
    hidden: false
  }

  render ({ hidden, children, ...props }, state, { required }) {
    return html`
      <label class="c-label${hidden ? ' u-sr-only' : ''}" ...${props}>
        ${children}
        ${required && html`
          <span class="c-label__suffix">
            (Pflichtfeld)
          </span>
        `}
      </label>
    `;
  }
}
