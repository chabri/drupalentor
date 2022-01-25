import { html, Component } from 'htm/preact';

export default class Avatar extends Component {
  static defaultProps = {
    url: null,
    alt: ''
  }

  render ({ url, alt, children, ...props }) {
    return url ?
      (
        html`
          <div ...${props}>
            <img src="${url}" alt="${alt}" class="u-photo / u-img-fit / u-img-top"/>
          </div>
        `
      ) : (
        html`
          <div ...${props}>
            ${children}
          </div>
        `
      );
  }
}
