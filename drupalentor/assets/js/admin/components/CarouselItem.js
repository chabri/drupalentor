import { html, Component } from 'htm/preact';

export default class CarouselItem extends Component {
  render ({ children, ...props }) {
    return html`
      <div class="c-carousel__slide">
        ${children}
      </div>`;
  }
}
