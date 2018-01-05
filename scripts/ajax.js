function retrieveURL(url) {
      alert("inside retriveURL");
    if (window.XMLHttpRequest) { // Non-IE browsers
          req = new XMLHttpRequest();

      req.onreadystatechange = processStateChange;

      try {

        req.open("GET", url, true);

      } catch (e) {

        alert(e);

      }

      req.send(null);

    } else if (window.ActiveXObject) { // IE

      req = new ActiveXObject("Microsoft.XMLHTTP");

      if (req) {

        req.onreadystatechange = processStateChange;

        req.open("POST", url, true);

        req.send();

      }

    }

  }



  function processStateChange() {

    if (req.readyState == 4) { // Complete

      if (req.status == 200) { // OK response
             alert("status 200")
      //  document.getElementById("table").innerHTML = req.responseText;

      } else {

        alert("Problem: Invalid Session " );

      }

    }

  }