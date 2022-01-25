import get from 'just-safe-get';
import truncate from 'just-truncate';

/**
 * A counter used to generate unique IDs.
 *
 * @type {integer}
 */
let uid = 0;

/**
 * Compare two objects.
 *
 * @param {*} a First object to compare.
 * @param {*} b Second object to compare.
 * @return {Number}
 */
function compare (a, b) {
  if (a == b) {
    return 0;
  }

  return (a > b) ? 1 : -1;
}

/**
 * Determine whether an object has the given property.
 *
 * @param {Object} obj The object to inspect.
 * @param {string} property The property to test for.
 * @return {void}
 */
function has (obj, property) {
  return Object.prototype.hasOwnProperty.call(obj, property);
}

/**
 * Get the first element from a given collection.
 *
 * @param {Array} collection The collection to inspect.
 * @return {*}
 */
function head (collection) {
  return collection && collection.length > 0 ? collection[0] : null;
}

/**
 * Invoke the closure if the value provided as the first argument is not null.
 *
 * @param {*} value The value to inspect.
 * @param {Function} fn The function to invoke.
 * @returns {*}
 */
 function optional(value, fn) {
  if (value === null || value === undefined) {
    return null;
  }

  return fn(value);
}

/**
 * Generates a unique ID.
 *
 * @param {string} [prefix=''] The value to prefix the ID with.
 * @return {string}
 */
function uniqueId (prefix = '') {
  var id = ++uid;
  return prefix + id;
}

export {
  compare,
  get,
  has,
  head,
  optional,
  truncate,
  uniqueId
};
