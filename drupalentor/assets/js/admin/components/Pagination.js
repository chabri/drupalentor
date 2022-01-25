import { html, Component } from 'htm/preact';

import PaginationButton from './PaginationButton';
import PaginationItem from './PaginationItem';
import PaginationEllipsis from './PaginationEllipsis';

export default class Pagination extends Component {
  static defaultProps = {
    title: null,
    total: 0,
    page: 1,
    offset: 2,
    perPage: 10,
    firstLabel: 'Erste Seite',
    prevLabel: 'Vorherige Seite',
    itemLabel: 'Seite',
    nextLabel : 'Nächste Seite',
    lastLabel: 'Letzte Seite',
    onChange: () => {},
  }

  goTo (p) {
    const { total, perPage } = this.props;

    const pages = Math.ceil(total / perPage);
    const page = Math.min(Math.max(1, parseInt(p)), pages);

    this.setState({ page });
    this.publish({ page });
  }

  prev () {
    this.goTo(this.props.page - 1);
  }

  next () {
    this.goTo(this.props.page + 1);
  }

  publish (state = {}) {
    this.props.onChange(state);
  }

  render ({ title, total, page, perPage, offset }) {
    const pages = Math.ceil(total / perPage);
    const limit = (2 * offset) + 1;

    let start = Math.max(1, page - offset);
    let end = Math.min(start + limit, pages + 1);

    if (end >= pages) {
      start = Math.max(1, end - limit);
    }

    const length = (end - start);
    const range = Array.from({ length }, (_, p) => p + start);

    const hasPages = (pages > 1);
    const hasPrev = (page > 1);
    const hasNext = (page < pages);

    return html`${hasPages && html`
      <nav ref="${(el) => this.container = el}" class="c-pagination" aria-label="${title}">
        <${PaginationButton} class="c-pagination__prev" disabled="${!hasPrev}" onClick="${() => this.prev()}">
          ${this.props.prevLabel}
        </${PaginationButton}>

        ${(start > 1) && html`
          <${PaginationItem} current="${(page === 1)}" aria-label="${this.props.firstLabel}" onClick="${() => this.goTo(1)}">
            <span class="u-sr-only">${this.props.itemLabel}</span> 1
          </${PaginationItem}>
        `}

        ${(start > 2) && html`
          <${PaginationEllipsis} />
        `}

        ${range.map((p) => html`
          <${PaginationItem} current="${(p === page)}" onClick="${() => this.goTo(p)}">
            <span class="u-sr-only">${this.props.itemLabel}</span> ${p}
          </${PaginationItem}>
        `)}

        ${(end < pages) && html`
          <${PaginationEllipsis} />
        `}

        ${(end <= pages) && html`
          <${PaginationItem} current="${(page === pages)}" aria-label="${this.props.lastLabel}" onClick="${() => this.goTo(pages)}">
            <span class="u-sr-only">${this.props.itemLabel}</span> ${pages}
          </${PaginationItem}>
        `}

        <${PaginationButton} class="c-pagination__next" disabled="${!hasNext}" onClick="${() => this.next() }">
          ${this.props.nextLabel}
        </${PaginationButton}>
      </nav>
    `}`;
  }
}
