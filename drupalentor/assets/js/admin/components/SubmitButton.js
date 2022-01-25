import { html, Component } from 'htm/preact';

import Button, { ButtonStyle } from './Button';

export default class SubmitButton extends Component {
  static defaultProps = {
    style: ButtonStyle.PRIMARY,
    label: null,
    loading: false,
  }

  render ({ label, loading, children, ...props }) {
    return html`
      <${Button} type="submit" disabled="${loading}" ...${props}>
        ${loading && html`
          <span class="c-spinner">Loading …</span>
        `}
        ${label || children}
      </${Button}>
    `;
  }
}
