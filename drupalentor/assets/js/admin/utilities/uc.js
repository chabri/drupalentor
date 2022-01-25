import {
  optional
} from '../utilities/misc';

/**
 * Enumeration of services.
 *
 * @enum
 */
export const Service = {
  GOOGLE_MAPS: 'Google Maps'
};

/**
 * Get information about a User Centrics service.
 *
 * @param {string} name Name of the service to retrieve.
 * @returns {object?}
 */
export function getService(name) {
  return optional(window.UC_UI, (UC) => (
    UC.getServicesBaseInfo().find((service) => (
      service.name.toLowerCase() === name.toLowerCase()
    ))
  ));
}

/**
 * Get the consent status of a User Centrics service.
 *
 * @param {string} name Name of the service to retrieve the consent status.
 * @returns {boolean|null}
 */
export function getConsentStatus(name) {
  return optional(getService(name), ({consent}) => (
    consent.status
  ));
}
