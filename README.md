# thumbnail-proxy
Proxy scripts for cover thumbnails

Beim direkten Aufruf der Cover-Dienste von syndetics.com und books.google.com aus dem Browser eines Primo-Nutzers werden potenziell nutzerspezifische Daten wie IP-Adresse und HTTP-Referrer an die Anbieter übermittelt. Um dies zu vermeiden, können stattdessen die auf einem lokalen Webserver abgelegten PHP-Skripte google_books.php und syndetics.php aufgerufen werden, die im Hintergrund die Cover-Dienste abfragen und die ermittelten Daten an den Browser weiterreichen. 

Voraussetzung ist eine Anpassung der Link Templates für syndetics.com und books.google.com im Primo Back Office, Mapping Table Delivery/Templates:

Syndetics-Template:
Code: syndetics_thumb bzw. syndetics_thumb_exl
Template Code: https://example.com/path/to/cover/syndetics.php?isbn={{addata/isbn}}

Google Books-Template:
Code: google_thumb
Template Code: https://example.com/path/to/cover/google_books.php?isbn={{addata/isbn}}&oclc={{addata/oclcid}}&lccn={{addata/lccn}}&callback=updateGBSCover
