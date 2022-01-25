import { html, Component } from 'htm/preact';

export default class Form extends Component {
  render ({ children, ...props }) {
    return html`
      <form class="c-form" ...${props}>
        ${children}
      </form>
    `;
  }
}
