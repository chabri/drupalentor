import { html, Component } from 'htm/preact';

import Portal from 'preact-portal';
import IconButton from './IconButton';

export default class Dialog extends Component {
  static defaultProps = {
    open: false,
    close: 'Schließen',
    onClose: () => {},
  }

  constructor (props, context) {
    super(props, context);
    this.handleClick = this.handleClick.bind(this);
  }

  open (element) {
    this.modal = element;

    if (element) {
      this.focus();
    }
  }

  close () {
    this.props.onClose();
  }

  focus () {
    const focusable = ['input', 'button', 'select', 'textarea'];
    const target = this.modal.querySelector(focusable.join(','));

    if (target) {
      setTimeout(() => target.focus(), 60);
    }
  }

  handleClick ({ target }) {
    const button = target.closest('.c-button--close');
    const backdrop = target.matches('.c-modal');

    if (button || backdrop) {
      this.close();
    }
  }

  render ({ open, close, children, ...props }) {
    return html`
      ${open && html`
        <${Portal} into="body">
          <div ref="${(el) => el && this.open(el)}" class="c-modal" tabindex="-1" role="dialog" onClick="${this.handleClick}" ...${props}>
            <div class="c-modal-dialog" role="document">
              ${children}
              <${IconButton} icon="close">
                ${close}
              </${IconButton}>
            </div>
          </div>
        </${Portal}>
      `}
    `;
  }
}
