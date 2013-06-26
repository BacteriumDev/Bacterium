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

