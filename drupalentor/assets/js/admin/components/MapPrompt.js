import { html, Component } from 'htm/preact';

import Prompt from './Prompt';

export default class MapPrompt extends Component {
  render ({ children, ...props }) {
    return html`
      <${Prompt} class="c-map-prompt" ...${props}>
        <h2>
          Verwendung von Google Maps
        </h2>
        <p>
          Um eine interaktive Karte der Ansprechpartner anzuzeigen werden die
          Dienste von Google Maps benötigt. Von Google werden bei der Nutzung
          der Kartenfunktion Daten über die Nutzung erhoben und verarbeitet.
          Nähere Informationen entnehmen Sie bitte den${` `}
          <a href="https://policies.google.com/privacy?hl=de" class="c-link">
          Datenschutzhinweisen</a> von Google.
        </p>
        ${children}
      </${Prompt}>
    `;
  }
}
