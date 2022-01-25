import {
  html,
  Component
} from 'htm/preact';

import {
  getUniqueId
} from '../utilities/dom';

import Label from './Label';

export default class TextField extends Component {
  static defaultProps = {
    id: null,
    name: null,
    label: null,
    help: null,
    valid: null,
    required: false,
  }

  getChildContext () {
    return {
      required: !!this.props.required,
      valid: !!this.props.valid,
    };
  }

  render ({ id, name, label, help, valid, required, children, ...props }) {
    const uid = getUniqueId(id || name);

    const fieldClasses = [
      'c-field',
      required === true && 'is-required',
      valid === true && 'is-valid',
      valid === false && 'is-invalid',
    ];

    const inputClasses = [
      'c-input',
      valid === true && 'is-valid',
      valid === false && 'is-invalid',
    ];

    return html`
      <div class="${fieldClasses.filter(Boolean).join(' ')}">
        <${Label} for="${uid}">
          ${label}
        </${Label}>

        <input type="text" id="${uid}" name="${name}" class="${inputClasses.filter(Boolean).join(' ')}" required="${required}" ...${props}/>

        ${(valid === false) && html`
          <p class="c-field__help">
            ${help}
          </p>
        `}

        ${children}
      </div>
    `;
  }
}
