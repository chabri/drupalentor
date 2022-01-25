import { html, Component } from 'htm/preact';

export default class PaginationButton extends Component {
  static defaultProps = {
    disabled: false
  }

  render ({ children, ...props }) {
    return html`
      <button type="button" class="c-pagination__button" ...${props}>
        ${children}
      </button>
    `;
  }
}
