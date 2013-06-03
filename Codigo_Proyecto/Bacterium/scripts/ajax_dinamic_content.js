function callAjax(url, pageElement, callMessage, errorMessage) {  
    document.getElementById(pageElement).innerHTML = callMessage;  
    try {  
    req = new XMLHttpRequest(); /* e.g. Firefox */  
    } catch(e) {  
      try {  
      req = new ActiveXObject("Msxml2.XMLHTTP");  /* some versions IE */  
      } catch (e) {  
        try {  
        req = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */  
        } catch (E) {  
         req = false;  
        }  
      }  
    }  
    req.onreadystatechange = function() {responseAjax(pageElement, errorMessage);};  
    req.open("GET",url,true);  
    req.send(null);  
 }  
  
function responseAjax(pageElement, errorMessage) {  
  var output = '';  
  if(req.readyState == 4) {  
     if(req.status == 200) {  
        output = req.responseText;  
        document.getElementById(pageElement).innerHTML = output;  
        } else {  
        document.getElementById(pageElement).innerHTML = errorMessage+"\n"+output;  
        }  
     }  
 } 