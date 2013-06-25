function goFullscreen(id){
	var element = document.getElementById(id);
	//mozilla	
	if (element.mozRequestFullScreen){
		element.mozRequestFullScreen();
	} else if( element.webkitRequestFullScreen){
		//chrome y safari
		element.webkitRequestFullScreen();
	}
	var rows = element.getElementsByTagName("img");
	//console.log(rows);
	for(var i=0;i<rows.length;i++){
		rows[i].style.width = "100%";
		rows[i].style.height = "100%";
		
	}
}

function salirFullscreen(){
	var element = document.getElementById("partida");
	console.log(element);
	
	if (document.exitFullscreen) {
	    document.exitFullscreen();
	}
	else if (document.mozCancelFullScreen) {
	    document.mozCancelFullScreen();
	}
	else if (document.webkitCancelFullScreen) {
	    document.webkitCancelFullScreen();
	}
	var rows = element.getElementsByTagName("img");
	//console.log(rows);
	for(var i=0;i<rows.length;i++){
		rows[i].style.width = "65px";
		rows[i].style.height = "66px";
		
	}
}

document.addEventListener("fullscreenchange", function () {
    fullscreenState.innerHTML = (document.fullscreen)? "" : "not ";
}, false);

document.addEventListener("mozfullscreenchange", function () {
    fullscreenState.innerHTML = (document.mozFullScreen)? "" : "not ";
}, false);

document.addEventListener("webkitfullscreenchange", function () {
    //fullscreenState.innerHTML = (document.webkitIsFullScreen)? "" : "not ";
	console.log("acaba de cambiar");
	if (document.webkitIsFullScreen){
		console.log("fullscreen");
	}else{
		console.log("normal");
		salirFullscreen();
	}
}, false);
//futile lo de abajo, fullscreen NO se puede cargar automaticamente ...
function eventFire(el, etype){
  if (el.fireEvent) {
    (el.fireEvent('on' + etype));
  } else {
    var evObj = document.createEvent('Events');
    evObj.initEvent(etype, true, false);
    el.dispatchEvent(evObj);
  }
}

function simulate(element, eventName)
{
    var options = extend(defaultOptions, arguments[2] || {});
    var oEvent, eventType = null;

    for (var name in eventMatchers)
    {
        if (eventMatchers[name].test(eventName)) { eventType = name; break; }
    }

    if (!eventType)
        throw new SyntaxError('Only HTMLEvents and MouseEvents interfaces are supported');

    if (document.createEvent)
    {
        oEvent = document.createEvent(eventType);
        if (eventType == 'HTMLEvents')
        {
            oEvent.initEvent(eventName, options.bubbles, options.cancelable);
        }
        else
        {
            oEvent.initMouseEvent(eventName, options.bubbles, options.cancelable, document.defaultView,
            options.button, options.pointerX, options.pointerY, options.pointerX, options.pointerY,
            options.ctrlKey, options.altKey, options.shiftKey, options.metaKey, options.button, element);
        }
        element.dispatchEvent(oEvent);
    }
    else
    {
        options.clientX = options.pointerX;
        options.clientY = options.pointerY;
        var evt = document.createEventObject();
        oEvent = extend(evt, options);
        element.fireEvent('on' + eventName, oEvent);
    }
    return element;
}

function extend(destination, source) {
    for (var property in source)
      destination[property] = source[property];
    return destination;
}

var eventMatchers = {
    'HTMLEvents': /^(?:load|unload|abort|error|select|change|submit|reset|focus|blur|resize|scroll)$/,
    'MouseEvents': /^(?:click|dblclick|mouse(?:down|up|over|move|out))$/
}
var defaultOptions = {
    pointerX: 0,
    pointerY: 0,
    button: 0,
    ctrlKey: false,
    altKey: false,
    shiftKey: false,
    metaKey: false,
    bubbles: true,
    cancelable: true
}

//window.onload = goFullscreen('partida');
