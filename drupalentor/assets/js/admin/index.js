import {
  html,
  render
} from 'htm/preact';

import {
  whenAvailable
} from './utilities/dom';

import Bin from 'storagebinjs';
import Finder from './components/Finder';

/**
 * The name of the current module.
 *
 * @type {string}
 */
const MODULE_NAME = 'Finder';

/**
 * Total number of milliseconds in one day.
 *
 * @type {Number}
 */
const DAY_IN_MS = 24 * 60 * 60 * 1000;

/**
 * Fetch all employees from a JSON feed.
 *
 * @return {Promise<Object[]>}
 */
export async function fetchEmployees() {
  try {
    const response = await fetch(`/api/geo_json`);
    return response.json();
  } catch (e) {
    console.error(e);
    return [];
  }
}
 
/**
 * Get the list of employees from the application cache.
 *
 * @return {Object[]}
 */
async function getEmployees () {
  let cache = new Bin(MODULE_NAME);

  if (!cache.isValid(DAY_IN_MS)) {
    cache.remove();
  }

  let employees = cache.get();

  if (!employees) {
    employees = await fetchEmployees();
    cache.set(employees);
  }

  return employees;
}

/**
 * Get the current page number from the URL.
 *
 * @return {Number}
 */
function getCurrentPage () {
  const path = location.pathname
    .split('/')
    .filter(Boolean);

  return parseInt(path.pop() || 1);
}

/**
 * Bind the Finder module to the given DOM element.
 *
 * @param {Element} element The container element of the module.
 * @param {Object} props The props to provide to the application root.
 * @return {void}
 */
function bind (container, props) {
  render(html`<${Finder} ...${props}/>`, container, container.firstChild);
}

/**
 * Boot the Finder module.
 *
 * @param {Element} container The container element of the module.
 * @return {void}
 */
async function boot (container) {
  const titleElement = container.querySelector('.js-finder-title');
  const descElement = container.querySelector('.js-finder-desc');

  const title = titleElement ? titleElement.textContent : null;
  const description = descElement ? descElement.textContent : null;
  const page = getCurrentPage();
  const items = await getEmployees();

  bind(container, { title, description, page, items });
}

const container = document.querySelector(`[data-module="${MODULE_NAME}"]`);
const uc = document.getElementById('usercentrics-cmp');

if (container) {
  if (uc) {
    whenAvailable('UC_UI', () => boot(container));
  } else {
    boot(container);
  }
}
