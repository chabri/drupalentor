import { html, Component } from 'htm/preact';

export default class Spinner extends Component {
  static defaultProps = {
    align: null
  }

  render ({ children }) {
    if (children.length > 0) {
      return html`<div class="c-spinner">${children}</div>`;
    }

    return html`<div class="c-spinner">Loading …</div>`;
  }
}
