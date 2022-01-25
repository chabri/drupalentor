import { html, Component } from 'htm/preact';

export default class Grid extends Component {
  static defaultProps = {
    items: []
  }

  render ({ items, page, perPage, render, children, ...props }) {
    return html`
      <div ...${props}>
        <ol class="o-grid">
          ${items.map((item, index) => html`
            <li key="${item.id}" class="o-grid__unit">
              ${render({ item, index })}
            </li>
          `)}
        </ol>
        ${children}
      </div>
    `;
  }
}
