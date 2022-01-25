import { html, Component } from 'htm/preact';

import CarouselButton from './CarouselButton';
import CarouselPagination from './CarouselPagination';
import CarouselPaginationButton from './CarouselPaginationButton';

export default class Carousel extends Component {
  static defaultProps = {
    loop: true,
    speed: 300,
    summary: '%d Ansprechpartner',
    labelDot: 'Zu Seite %d',
    labelPrev: 'Zurück',
    labelNext: 'Weiter',
    onChange: () => {},
  }

  state = {
    currentSlide: 0,
    stageWidth: 0,
    stageHeight: 0
  }

  constructor (props, context) {
    super(props, context);

    this.handlePrevClick = this.handlePrevClick.bind(this);
    this.handleNextClick = this.handleNextClick.bind(this);
    this.handleResize = this.handleResize.bind(this);
  }

  componentDidMount () {
    this.updateDimensions();

    window.addEventListener('resize', this.handleResize);
  }

  componentWillUnmount () {
    window.removeEventListener('resize', this.handleResize);
  }

  goTo (slide) {
    this.setState({ currentSlide: slide });
    this.props.onChange({ slide });
  }

  prev () {
    let shouldWrap = this.props.loop;

    let total = this.props.children.length;
    let current = this.state.currentSlide;
    let next = current - 1;

    if (next < 0) {
      next = shouldWrap ? total - 1 : 0;
    }

    this.goTo(next);
  }

  next () {
    let shouldWrap = this.props.loop;

    let total = this.props.children.length;
    let current = this.state.currentSlide;
    let next = current + 1;

    if (next >= total) {
      next = shouldWrap ? next % total : total - 1;
    }

    this.goTo(next);
  }

  updateDimensions () {
    const { width, height } = this.stage.getBoundingClientRect();

    this.setState({
      slideWidth: Math.round(width),
      slideHeight: Math.round(height),
    });
  }

  handlePrevClick (e) {
    e.preventDefault();
    this.prev();
  }

  handleNextClick (e) {
    e.preventDefault();
    this.next();
  }

  handleResize () {
    this.updateDimensions();
  }

  render ({ summary, loop, speed, labelDot, labelPrev, labelNext, children }, { currentSlide, slideWidth }) {
    const total = children.length;
    const offset = currentSlide * slideWidth;

    return html`
      <div ref="${(el) => this.container = el}" class="c-carousel / u-position-static">
        <div ref="${(el) => this.stage = el}" class="c-carousel__stage" style="${`transform: translate3d(-${offset}px, 0, 0); transition-duration: ${speed}ms;`}">
          ${children}
        </div>
        <div class="c-carousel__navigation">
          <${CarouselButton} class="c-carousel__button c-carousel__prev" disabled="${!loop && (currentSlide === 0)}" onClick="${this.handlePrevClick}">
            <svg class="c-carousel__button-icon">
              <use xlink:href="/assets/images/icons.svg#arrow-left" />
            </svg>
            <div class="c-carousel__button-label">
              ${labelPrev}
            </div>
          </${CarouselButton}>
          <${CarouselPagination}>
            ${children.map((_, index) => html`
              <${CarouselPaginationButton} active="${index === currentSlide}" onClick="${() => this.goTo(index)}">
                <span class="u-sr-only">
                  ${labelDot.replace('%d', index + 1)}
                </span>
              </${Carousel}
            `)}
          </${CarouselPagination}>
          <${CarouselButton} class="c-carousel__button c-carousel__prev" disabled="${!loop && (currentSlide === total - 1)}" onClick="${this.handleNextClick}">
            <div class="c-carousel__button-label">
              ${labelNext}
            </div>
            <svg class="c-carousel__button-icon">
              <use xlink:href="/assets/images/icons.svg#arrow-right" />
            </svg>
          </${CarouselButton}>
        </div>
        ${summary && html`
          <div class="c-carousel__caption">
            ${summary.replace('%d', total)}
          </div>
        `}
      </div>`;
  }
}
