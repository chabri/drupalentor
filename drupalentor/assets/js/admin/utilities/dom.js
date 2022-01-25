/**
 * A registry of already taken HTML IDs.
 *
 * @type {Object<string,Number>}
 */
const store = {};

/**
 * Ensure that the given HTML ID is not already used by another component.
 *
 * @param {string} id The ID to use for the element.
 * @param {string} [separator=''] The string to use as separator.
 * @return {string}
 */
export function getUniqueId(id, separator = '-') {
  if (!id || !store[id]) {
    return id;
  }

  return id + separator + (++store[id]);
}

/**
 * Poll for the availability of a JavaScript global.
 *
 * @param {string} name The name of the global.
 * @param {Function} callback The callback function.
 * @param {number} interval The polling interval.
 * @return {void}
 */
export function whenAvailable(name, callback, interval = 60) {
  setTimeout(function() {
      if (window[name]) {
          callback(window[name]);
      } else {
          whenAvailable(name, callback, interval);
      }
  }, interval);
}
