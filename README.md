## Lia Andes

### Fragen:
- Hinten nach vorne // außen nach innen
- kein Layout, erst mal Content
- Kirby // Lizenz kommt noch
- Texte etwas chaotisch
- brauchen wir eigene Seiten für Coaching sängerin und kompotistion?
- brauchen wir eine Folgeseite bei den News oder reicht die Übersicht?
- Site Infos vervollständigen
- Rezensionen können gepflegt werden

- Kontaktformular
- Komposition eine Rose für Dich -> Wo ist die Vertonung?
- Kontakt: nur E-Mail? Oder auch Insta und Co?
- Was ist mit Linkedin?
- Bild Komposition
- Angaben Impressum

- Firefox nutzen!

### Bandsintown CSV Export

- URL: `/export/bandsintown.csv`
- Exportiert kommende Termine (aus `news`-Unterseiten) als CSV im Bandsintown-Bulk-Upload-Format.
- Empfohlene Pflege im Panel (bei `kind: termin`): `bitVenue`, `bitAddress`, `bitPostalCode`, `bitCity`, `bitRegion`, `bitCountry`, `bitTimezone`, `bitStartTime`.
- Optional: Mehrere Termine pro Seite über die Structure `bandsintownEvents` (jede Zeile = ein Event/CSV-Row).

Defaults können per Kirby-Optionen überschrieben werden (siehe Plugin `site/plugins/bandsintown-export`).
