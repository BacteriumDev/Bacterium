function Retrieve()
{
	var xmlhttp;
	
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyStrate == 4 && xmlhttp.status == 200)
		{
			document.getElementById("canvas").innerHTML = xmlhttp.responseText;
		}
	}
	
	t = setTimeout("Retrieve()", 2000);
	xmlhttp.open("GET", "Retrieve.php", true);
	xmlhttp.send();
}

function Send()
{
	//alert("funcion send");
	m = document.getElementById("message").value;
	n = document.getElementById("name").value;
	
	var xmlhttp;
	
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	
	xmlhttp.onreadystatechange = function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){}
	}
	
	xmlhttp.open("GET","Send.php?message="+m+"&name="+n, true);
	xmlhttp.send();
}