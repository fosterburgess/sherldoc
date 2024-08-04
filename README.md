# sherldoc

Web service endpoint to scan a document for

* existence of keyword or phrase
* absence of keyword or phrase


## requirements

Local executable jre and pdfbox.jar - paths 
are set in the config/pdfbox.php

jre should be installed in docker-compose process.

grab pdfbox
```
wget https://dlcdn.apache.org/pdfbox/3.0.2/pdfbox-app-3.0.2.jar
```
and copy to ./resources folder

if .env is missing, copy .env.example to .env

app expects to use embedded sqlite, nothing more. 

## example
```bash
curl -X POST -F file=@resources/sample1.pdf \
-F 'checks={"ensure_missing":
["perpetuity","prohibited", "free software"],
"ensure_existing":
["GNU", "license", "free software", "idaho"]}
' http://localhost:8088/api/scan 
```

## limits

Currently accepts only PDF files, and has not 
been extensively tested.

Not much in the way of error handling.



