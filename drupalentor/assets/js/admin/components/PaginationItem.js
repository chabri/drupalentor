import { html, Component } from 'htm/preact';

export default class PaginationItem extends Component {
  static defaultProps = {
    current: false
  }

  render ({ current, children, ...props }) {
    return html`
      <button type="button" class="${`c-pagination__item${current ? ' is-current' : ''}`}" aria-current="${current ? 'page' : null}" ...${props}>
        ${children}
      </button>
    `;
  }
}
