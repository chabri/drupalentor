import { html, Component } from 'htm/preact';

export default class CarouselPagination extends Component {
  render ({ children, ...props }) {
    return html`
      <div class="c-carousel__pagination" ...${props}>
        ${children}
      </div>`;
  }
}
