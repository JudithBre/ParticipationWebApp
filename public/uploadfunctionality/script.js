//****various jshint configs****
// jshint esversion: 8
// jshint browser: true
// jshint node: true
// jshint -W117
// jshint -W083
"use strict";

// Senden eines Assets an den Server
function sendAsset(){
  let goAsset = new XMLHttpRequest();
  let myData = document.getElementByID("name").value;
  let myFile = document.getElementByID("Draft").value;
  let myCheck = document.getElementByID("checkbox").value;
  let myPost = "myData"+encodeURIComponent(myData) + myFile + myCheck;

  // Event Handler fuer die Response vom Server
  goAsset.onload = function () {
    if (goAsset.status === 200) {
      // Dateien wurden hochgeladen

      document.querySelector("#result").innerHTML = goAsset.responseText;
      uploadButton.innerHTML = 'Upload';

    } else {
      document.querySelector("#result").innerHTML = "Fehler beim Upload " + goAsset.responseText;
    }
  };

  goAsset.open("POST", "http://giv-project10.uni-muenster.de/api/asset", true);
  goAsset.send(myPost);
}
