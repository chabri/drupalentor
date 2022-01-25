import { html, Component } from 'htm/preact';

export default class FieldGroup extends Component {
  render ({ children, ...props }) {
    return html`
      <div class="c-field-group" ...${props}>
        ${children}
      </div>
    `;
  }
}
