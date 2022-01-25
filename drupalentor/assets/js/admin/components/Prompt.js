import { html, Component } from 'htm/preact';

import { default as Button, ButtonStyle } from './Button';

import ButtonGroup from './ButtonGroup';
import Checkbox from './Checkbox';

export default class Prompt extends Component {
  static defaultProps = {
    acceptLabel: 'Ok',
    dismissLabel : 'Abbrechen',
    rememberLabel: 'Auswahl merken',
    onAccepted: () => {},
    onDismissed: () => {},
    onRememberChange: () => {},
  }

  constructor (props, context) {
    super(props, context);

    this.handleAccept = this.handleAccept.bind(this);
    this.handleDismiss = this.handleDismiss.bind(this);
    this.handleChange = this.handleChange.bind(this);
  }

  handleAccept() {
    this.props.onAccepted({
      remember: this.props.remember && this.state.remember,
    });
  }

  handleDismiss() {
    this.props.onDismissed({
      remember: this.props.remember && this.state.remember,
    });
  }

  handleChange(e) {
    this.props.onRememberChange({
      remember: e.target.checked
    });
  }

  render ({ acceptLabel, dismissLabel, rememberLabel, children, ...props }) {
    return html`
      <article class="${`c-prompt${props.class ? ' ' + props.class : ''}`}">
        ${children}
        <div class="c-prompt__footer">
          <${ButtonGroup} align="center">
            <${Button} style="${ButtonStyle.PRIMARY}" onClick="${this.handleAccept}">
              ${acceptLabel}
            </${Button}>
            <${Button} style="${ButtonStyle.SECONDARY}" onClick="${this.handleDismiss}">
              ${dismissLabel}
            </${Button}>
          </${ButtonGroup}>

          <${Checkbox} onChange="${this.handleChange}">
            ${rememberLabel}
          </${Checkbox}>
        </div>
      </article>
    `;
  }
}
