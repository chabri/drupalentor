import haversine from 'haversine';

/**
 * Base url of the Google Maps API.
 *
 * @see {@link https://developers.google.com/maps/documentation/javascript/tutorial}
 *
 * @type {string}
 */
export const GOOGLE_MAPS_BASE_URL = 'https://maps.googleapis.com/maps/';

/**
 * Base url of the Google Geolocation API.
 *
 * @see {@link https://developers.google.com/maps/documentation/geolocation/intro}
 *
 * @type {string}
 */
export const GOOGLE_GEOLOCATE_BASE_URL = 'https://www.googleapis.com/geolocation/';

/**
 * Enumeration of cities.
 *
 * @enum
 */
export const City = {
  BREMEN: {
    lat: 53.072289,
    lng: 8.810519
  }
};

/**
 * Enumeration of zoom levels.
 *
 * @enum
 */
export const ZoomLevel = {
  WORLD: 1,
  LANDMASS: 5,
  CITY: 10,
  STREETS: 15,
  BUILDINGS: 20
};

/**
 * An enumeration of predefined Marker icons.
 *
 * @type {Object<string,Object>}
 */
export const MarkerIcon = {
  DOT: {
    path: 0,
    scale: 5,
    fillColor: '#95c11f',
    fillOpacity: 1,
    strokeColor: 'white',
    strokeWeight: 1
  }
};

/**
 * Generate an absolute URL for an API endpoint.
 *
 * @param {string} path The path to the API endpoint.
 * @param {Object} [params={}] Optional URL parameters.
 * @param {string} [base='/'] Base url of the API endpoint.
 * @return {URL}
 */
export function getURL (path, base = '/', params = {}) {
  path = path.replace(/^\/|\/$/, '');

  const search = new URLSearchParams(params);
  const url = new URL(path + `?${search}`, base);

  return url;
}

/**
 * Get a JSON response from a given API endpoint.
 *
 * @param {string} url The url of the API endpoint.
 * @return {Promise<Object[]>}
 */
export async function getJSON (url) {
  try {
    const response = await fetch(url);

    if (!response.ok) {
      return [];
    }

    const content = await response.json();

    if (content.status !== 'OK') {
      return [];
    }

    return content.results;
  } catch (o_O) {
    return [];
  }
}

/**
 * Send a post request to a given API endpoint.
 *
 * @param {string} url The url of the API endpoint.
 * @param {Object} [data={}] Optional data for the body field.
 * @return {Promise<Object>}
 */
export async function postJSON (url, data = {}) {
  const response = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    }
  });

  if (!response.ok) {
    throw new Error(`${response.status} ${response.statusText}`);
  }

  const content = await response.json();

  if (response.error) {
    throw new Error(`${response.error.code} ${response.error.message}`);
  }

  return content;
}

/**
 * Retrieve the user location based on information about cell towers and WiFi
 * nodes of a mobile client.
 *
 * @param {Object} [options={}] Additional request options.
 * @return {Object}
 */
export function geolocate (options = {}) {
  const url = getURL('/v1/geolocate', GOOGLE_GEOLOCATE_BASE_URL, {
    key: GOOGLE_GEOLOCATE_KEY
  });

  return postJSON(url, options);
}

/**
 * Retrieve the geographical coordinates for a given address component.
 *
 * @param {string} address The address to geocode.
 * @param {string} region A region the results should be biased to.
 * @return {Promise<Object[]>}
 */
export function geocode (address, region = 'de', language = 'de') {
  const url = getURL('/api/geocode/json', GOOGLE_MAPS_BASE_URL, {
    key: GOOGLE_GEOCODE_KEY,
    address: address,
    region: region,
    language: language
  });

  return getJSON(url);
}

/**
 * Retrieve address information for a given geolocation.
 *
 * @param {Object|google.maps.LatLng} position The location to retrieve address information for.
 * @return {Promise<Object[]>}
 */
export function lookup (position, types = [], language = 'de') {
  const location = toLatLng(position);
  const url = getURL('/api/geocode/json', GOOGLE_MAPS_BASE_URL, {
    key: GOOGLE_GEOCODE_KEY,
    latlng: `${location.lat},${location.lng}`,
    result_type: types.join('|'),
    language: language,
  })

  return getJSON(url);
};

/**
 * Calculate the distance between two geographic coordinates.
 *
 * @param {Object|google.maps.LatLng} origin The origin to start from.
 * @param {Object|google.maps.LatLng} target The target location.
 * @return {Number}
 */
export function distance (origin, target) {
  return haversine(toLatLng(origin), toLatLng(target), { format: '{lat,lng}' });
}

/**
 * Convert a geolocation to lat/lng notation.
 *
 * @param {Object} obj The object to convert.
 * @return {Object}
 */
export function toLatLng(obj) {
  if (typeof obj !== 'object') {
    return null;
  } else if (typeof obj.toJSON === 'function') {
    return obj.toJSON();
  } else if (obj.latitude || obj.longitude) {
    return {
      lat: parseFloat(obj.latitude || 0),
      lng: parseFloat(obj.longitude || 0),
    };
  }

  return obj;
}

/**
 * A helper function used to delegate events from a Google Map instance to a
 * Preact component.
 *
 * @param {Component} component The component to register events for.
 * @param {google.maps.MVCObject} target The target element to register listeners on.
 * @param {Object<string,string>} events A map of event handlers to event names.
 * @return {Object[]}
 */
export function addEventListeners (component, target, events) {
  const props = component.props || {};
  const listeners = [];

  for (const [listener, event] of Object.entries(events)) {
    if (typeof props[listener] === 'function') {
      listeners.push(target.addListener(event, (...args) => {
        return props[listener](...args, component, target);
      }));
    }
  }

  return listeners;
}

/**
 * A helper function used to remove event listeners.
 *
 * @param {Component} component The component to register events for.
 * @param {google.maps.MVCObject} target The target element to remove listeners from.
 * @param {Object[]} listeners A list of event listeners registered for the component.
 * @return {void}
 */
export function removeEventListeners (component, target, listeners) {
  for (const listener of listeners) {
    if (typeof listener.remove === 'function') {
      listener.remove();
    }
  }
}
