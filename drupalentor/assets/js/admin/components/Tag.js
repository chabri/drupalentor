import { html, Component } from 'htm/preact';

import Icon from './Icon';
import IconButton from './IconButton';

export default class Tag extends Component {
  static defaultProps = {
    label: null,
    icon: null,
    style: null,
    action: 'Entfernen',
    disposable: false,
    onDispose: () => {}
  }

  render ({ label, icon, style, action, disposable, onDispose, children, ...props }) {
    return html`
      <span class="c-tag" ...${props}>
        ${icon && html`
          <${Icon}
            name="${icon}"
            align="left"
          />
        `}

        ${label || children}

        ${disposable && html`
          <${IconButton}
            label="${action}"
            icon="close"
            class="c-tag__action"
            onClick="${() => onDispose()}"
          />
        `}
      </span>
    `;
  }
}
