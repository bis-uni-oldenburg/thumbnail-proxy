# thumbnail-proxy
Proxy-Skripte zum Laden von Cover-Thumbnails
<br>Proxy scripts for cover thumbnails

Beim direkten Aufruf der Cover-Dienste von syndetics.com und books.google.com aus dem Browser eines Primo-Nutzers werden potenziell nutzerspezifische Daten wie IP-Adresse und HTTP-Referrer an die Anbieter übermittelt. Um dies zu vermeiden, können stattdessen die auf einem lokalen Webserver bereitgestellten PHP-Skripte google_books.php und syndetics.php  aufgerufen werden. Diese fragen im Hintergrund die Cover-Dienste ab und reichen die ermittelten Daten an den Browser weiter. 

Voraussetzung ist eine Anpassung der Link Templates für syndetics.com und books.google.com im Primo Back Office, Mapping Table Delivery/Templates:

Syndetics-Template:
<br>Code: syndetics_thumb bzw. syndetics_thumb_exl
<br>Template Code: https://example.com/path/to/cover/syndetics.php?isbn={{addata/isbn}}

Google Books-Template:
<br>Code: google_thumb
<br>Template Code: https://example.com/path/to/cover/google_books.php?isbn={{addata/isbn}}&oclc={{addata/oclcid}}&lccn={{addata/lccn}}&callback=updateGBSCover

Die Link Templates funktionieren sowohl für das alte als auch für das neue Primo-UI.

#######################

When calling the cover services of syndetics.com and books.google.com directly from the browser of a Primo user, potentially user-specific data such as IP address and HTTP referrer are transmitted to the providers. To avoid this, the PHP scripts google_books.php and syndetics.php, provided on a local web server, can be called instead. The scripts request the cover services in the background and forward the retrieved data to the browser. 

Prerequisite is an adaptation of the link templates for syndetics.com and books.google.com in the Primo Back Office, Mapping Table Delivery/Templates:

Syndetics template:
<br>Code: syndetics_thumb resp. syndetics_thumb_exl
<br>Template Code: https://example.com/path/to/cover/syndetics.php?isbn={addata/isbn}}

Google Books template:
<br>Code: google_thumb
<br>Template Code: https://example.com/path/to/cover/google_books.php?isbn={addata/isbn}}&oclc={addata/oclcid}}&lccn={addata/lccn}}&callback=updateGBSCover

The link templates work for both the old and the new primo UI.
