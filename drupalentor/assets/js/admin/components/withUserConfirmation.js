import { html, Component } from 'htm/preact';

import { uniqueId } from '../utilities/misc';

export function withUserConfirmation (BaseComponent, PromptComponent, FallbackComponent) {
  return class extends Component {
    static defaultProps = {
      key: null,
      consent: null,
      remember: false,
    }

    state = {
      isAccepted: false,
      isDismissed: false,
      key: null,
      remember: this.props.remember,
    }

    constructor (props, context) {
      super(props, context);

      this.handleAccept = this.handleAccept.bind(this);
      this.handleDismiss = this.handleDismiss.bind(this);
      this.handleRememberChange = this.handleRememberChange.bind(this);
    }

    componentDidMount () {
      const name = PromptComponent.displayName || 'Prompt';
      const key = this.props.key || uniqueId(name);
      const value = (this.props.consent === null)
        ? JSON.parse(localStorage.getItem(key))
        : Boolean(this.props.consent);

      this.setState({
        isAccepted: (value === true),
        isDismissed: (value === false),
        key: key
      });
    }

    componentWillUnmount () {
      this.setState({
        isAccepted: false,
        isDismissed: false,
      });
    }

    getChildContext () {
      return {
        isAccepted: this.state.isAccepted,
        isDismissed: this.state.isDismissed,
      };
    }

    handleAccept() {
      this.setState({ isAccepted: true });

      if (this.state.remember) {
        localStorage.setItem(this.state.key, true);
      } else {
        localStorage.removeItem(this.state.key);
      }
    }

    handleDismiss() {
      this.setState({ isDismissed: true });

      if (this.state.remember) {
        localStorage.setItem(this.state.key, false);
      } else {
        localStorage.removeItem(this.state.key);
      }
    }

    handleRememberChange({ remember }) {
      this.setState({ remember });
    }

    render (props, { isAccepted, isDismissed }) {
      if (isDismissed) {
        return html`<${FallbackComponent} />`;
      }

      if (isAccepted) {
        return html`<${BaseComponent} ...${props}/>`;
      }

      return html`
        <${PromptComponent}
          onAccepted="${this.handleAccept}"
          onDismissed="${this.handleDismiss}"
          onRememberChange="${this.handleRememberChange}"
        />`;
    }
  }
}
