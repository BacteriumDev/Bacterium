	var posiciones_Mov = {};
	var jugadorAI = 1;
	var fichasObtenidas = new Array();
//funcion que se convoca al pedir ayuda del movimiento optimo del usuario
	function movimientoInteligente(numJug,numProf){

		posiciones_Mov = {};
		fichasObtenidas = new Array();
		
		var profitFichas;

		var ficha;
		var dir;
		var profit = -1;
		for (i=0;i<8;i++){
			for(j=0;j<8;j++){
				fichasObtenidas = new Array();
				if(document.getElementsByName("jugador"+i+j)[0].value == numJug){
					//console.log(numJug+" es objetivo");
					
					dir = document.getElementsByName("direccion"+i+j)[0].value;
					
					//console.log("Vieja direccion -> "+dir);
					if(dir == 1)
					{
						dir = 2;
					}else if(dir == 2)
					{
						dir = 3;
					}else if(dir == 3)
					{
						dir = 4;
					}else if(dir == 4)
					{
						dir = 1;
					}
					//console.log("Nueva direccion -> "+dir);
					
					var newProfit = contagio_AI(i,j,dir,numProf);					
					//console.log(newProfit);
					if (profit <= newProfit && jugadorAI == 1){
						profit = newProfit;
						ficha = document.getElementById("bac"+i+j);
						profitFichas = fichasObtenidas;
					}
					if (profit < newProfit && jugadorAI == 2){
						profit = newProfit;
						ficha = document.getElementById("bac"+i+j);
						profitFichas = fichasObtenidas;
					}
					
				}
			}
		}
		console.log(profit);
		if (profit == 0 && jugadorAI == 1){
			return 0;
		}
		fichasObtenidas = profitFichas;
		return ficha;
	}

	function contagio_AI(i,j,pos,profundidad)
	{
		var profit = 0;		

		num1 = parseInt(i);
		num2 = parseInt(j);
		posiciones_Mov["pos"+num1+num2] = true;
		//posiciones_CPU["pos"+num1+num2] = false;
		if(pos == 1)
		{
			//alert("contagio arriba");
			if ("pos"+(num1-1)+num2 in posiciones_Mov){
			}else{
			profit += rec_contagio_AI(num1-1,num2,pos,profundidad);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 2)
		{
			//alert("contagio derecha");
			if ("pos"+num1+(num2+1) in posiciones_Mov){
			}else{
			profit += rec_contagio_AI(num1,num2+1,pos,profundidad);}
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 3)
		{
			//alert("contagio abajo");
			if ("pos"+(num1+1)+num2 in posiciones_Mov){
			}else{
			profit += rec_contagio_AI(num1+1,num2,pos,profundidad);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 4)
		{
			//alert("contagio izquierda");
			if ("pos"+num1+(num2-1) in posiciones_Mov){
			}else{
			profit += rec_contagio_AI(num1,num2-1,pos,profundidad);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_arriba(num1-1,num2);
		}
		//console.log(profit);
		return profit;

	}

	function rec_contagio_AI(i,j,pos,profundidad)
	{
		//alert("entrando");
		//verificar direccion de flecha
		//
	
		//alert("entrando a contagio rec" + i + j + poscontagiado);
		
		//verificar posicion valida
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			
			//alert("entrando a contagio rec bac"+i+j);
		
			//document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".png";
			//document.getElementsByName("jugador"+i+j)[0].value = 1;
			
			num1 = parseInt(i);
			num2 = parseInt(j);
			if (document.getElementsByName("jugador"+num1+num2)[0].value == jugadorAI){return 0;}
			var profitMod = 1;
			if (document.getElementsByName("jugador"+num1+num2)[0].value == 2 && jugadorAI == 1 || document.getElementsByName("jugador"+num1+num2)[0].value == 1 && jugadorAI == 2 && '<?php echo $nivel;?>' == 3){
			
				profitMod = 2;			
			}
			if (document.getElementsByName("jugador"+num1+num2)[0].value == 1 && jugadorAI == 2 && '<?php echo $nivel;?>' == 1){
				profitMod = 0.2;
			}
			//console.log(i,j);
			//posiciones["pos"+num1+num2] = true;
			//if("pos"+num1+num2 in posiciones){
			//}else{
			//posiciones_CPU["pos"+i+j] = false;
			fichasObtenidas.push(document.getElementById("bac"+num1+num2));
			console.log(profundidad);
			if (profundidad <= 0){
				return profitMod;
			}
			return contagio_AI(num1,num2,dir,profundidad-1)+profitMod;
			//}			
		}
		return 0;
	}
	
	function doSetTimeout(src,element){
		setTimeout(function(){resetImg(src,element);},400);
	}

	function getMovement(){
		
		jugadorAI = 1;
		var ficha = movimientoInteligente(1,100);
		//console.log(fichasObtenidas);
		if (ficha == 0){
			alert("No se encontro un movimiento optimo, por favor mueva una ficha cualquiera");
		}else{
		//var ficha = document.getElementById("bac00");
		//document.getElementById("bac00").style.color = "magenta";
		//alert(ficha);
		
		var srcMove = highlightFicha(ficha,"blue");
		var src;
		//setTimeout(function(){resetImg(src,ficha);},400);
		//timer = setInterval('resetImg("0","0",ficha)',400);
		//ficha.style.opacity = 0.5;
		var element = null;
		var fuentes = new Array();
		for (var i = 0; i < fichasObtenidas.length; i++){
			element = fichasObtenidas[i];
			src = highlightFicha(element,"yellow");
			fuentes.push(src);
			
			//doSetTimeout(src,element);
			//window.setTimeout(function(){resetImg(src,element);},400);
			//var interval = setInterval(function(){	src = highlightFicha(element);								resetImg(src,element);								clearInterval(interval);},400);
		}
		window.setTimeout(function(){
			for (var i = 0; i < fichasObtenidas.length; i++){
				element = fichasObtenidas[i];
				src = fuentes[i];
				resetImg(src,element);
			}
			resetImg(srcMove,ficha);
		},500);
		}
	}
	function highlightFicha(ficha,color){
		var src = ficha.src;
		ficha.src = tilesetPath+"empty2.PNG";
		ficha.style.backgroundColor = color;
		return src;
	}

	function resetImg(src,ficha){
		//var dir = document.getElementsByName("direccion"+x+y)[0].value;
		ficha.src = src;
		ficha.style.backgroundColor = "white";
	}
