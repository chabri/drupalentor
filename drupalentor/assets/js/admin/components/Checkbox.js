import {
  html,
  Component
} from 'htm/preact';

import {
  getUniqueId
} from '../utilities/dom';

export default class Checkbox extends Component {
  static defaultProps = {
    name: null,
    label: null,
    value: 1,
    valid: null,
    help: null,
    required: false
  }

  render ({ id, name, label, valid, help, children, ...props }) {
    const fieldClasses = [
      'c-field',
      valid === true && 'is-valid',
      valid === false && 'is-invalid'
    ];

    const inputClasses = [
      'c-checkbox',
      valid === true && 'is-valid',
      valid === false && 'is-invalid'
    ];

    return html`
      <div class="${fieldClasses.filter(Boolean).join(' ')}">
        <label class="${inputClasses.filter(Boolean).join(' ')}">
          <input
            type="checkbox"
            id="${getUniqueId(id || name)}"
            name="${name}"
            class="c-checkbox__input"
            ...${props}
          />
          <span class="c-checkbox__label">
            ${label || children}
          </span>
        </label>
        ${(valid === false) && html`
          <p class="c-field__help">
            ${help}
          </p>
        `}
      </div>
    `;
  }
}
