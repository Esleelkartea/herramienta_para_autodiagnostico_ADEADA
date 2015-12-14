function IsNumeric(expression)
{
	return (String(expression).search(/^\d+$/) != -1);
}

function IsDecimal(expression)
{
	return (String(expression).search(/^\d+(\.\d+)?$/) != -1);
}

///////////meodologia

function verMetodologia(seccion){
	document.getElementById("capaIntroduccion").style.display = "none";
	document.getElementById("capaEstrategia").style.display = "none";
	document.getElementById("capaPersonas").style.display = "none";
	document.getElementById("capaRecursos").style.display = "none";
	document.getElementById("capaProcesos").style.display = "none";
	document.getElementById("capaResultados").style.display = "none";
	//Effect.Appear(seccion);
	document.getElementById(seccion).style.display = "block";			
}

//////////indicadores

function envioIndicador(){
	if (validarIndicador()){
		document.getElementById("formIndicador").action = "?page_id=140";
		document.getElementById("formIndicador").submit();	
	}
	return true;
}

function validarIndicador(){
	var x=document.forms["formIndicador"]["ventas"].value;
	if (x==null || x=="" || !IsDecimal(x)){
		alerta("Debe rellenar las ventas o dar un valor valido");
		return false;
	}
	x=document.forms["formIndicador"]["facturas"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el n&ordm; de facturas o dar un valor valido");
		return false;
	}	
	x=document.forms["formIndicador"]["costes"].value;
	if (x==null || x=="" || !IsDecimal(x)){
		alerta("Debe rellenar los costes o dar un valor v&aacute;lido");
		return false;
	}	
	x=document.forms["formIndicador"]["clientes"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el n&ordm; de clientes o dar un valor v&aacute;lido");
		return false;
	}	
	x=document.forms["formIndicador"]["quejas"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el n&ordm; de quejas o dar un valor v&aacute;lido");
		return false;
	}		
	x=document.forms["formIndicador"]["sugerencias"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el n&ordm; de sugerencias o dar un valor v&aacute;lido");
		return false;
	}	
	x=document.forms["formIndicador"]["absentismo"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el nivel de absentismo o dar un valor v&aacute;lido");
		return false;
	}	
	x=document.forms["formIndicador"]["rotacion"].value;
	if (x==null || x=="" || !IsNumeric(x)){
		alerta("Debe rellenar el nivel de rotaci(oacute;n o dar un valor v&aacute;lido");
		return false;
	}		
	alerta("");   	  	  	    
	return true; 	
}

/////////cuestionario

function verContenido(capa,estado){
	if (estado)
		document.getElementById(capa).style.display = "block";
	else
		document.getElementById(capa).style.display = "none";
}

function calculoIco(num,ico){
	var caso1 = "";//"url(wp-content/plugins/adeada/test/images/centro_verde.gif) no-repeat";
	var caso2 = "url(wp-content/plugins/adeada/test/images/centro_naranja.gif) no-repeat";
	var caso3 = "url(wp-content/plugins/adeada/test/images/centro_verde.gif) no-repeat";
	if (num == 0)
		document.getElementById(ico).style.background = caso1;
	if ((num > 0) && (num < 5))
		document.getElementById(ico).style.background = caso2;	
	if (num == 5)
		document.getElementById(ico).style.background = caso3;		
}

function calculoIco2(num,ico){
	var caso1 = "url(wp-content/plugins/adeada/test/images/sector_"+num+".gif) no-repeat";
	document.getElementById(ico).style.background = caso1;	
}

function calculoPorcentajes(){
	var numRespEstrategia = 0;var numRespPersonas = 0;var numRespRecursos = 0;var numRespProcesos = 0;var numRespResultados = 0;var numRespEstF1 = 0;var numRespEstF2 = 0;var numRespPerF1 = 0;var numRespPerF2 = 0;var numRespRecF1 = 0;var numRespRecF2 = 0;var numRespProF1 = 0;var numRespProF2 = 0;
	for (var num=1; num<=43; num++)
		if (!document.forms["formEnvio"]["resp_"+num][11].checked){
			if (num >=1  && num <=10) numRespEstrategia++;
			if (num >=1  && num <=5) numRespEstF1++;
			if (num >=6  && num <=10) numRespEstF2++;
			if (num >=11  && num <=20) numRespPersonas++;
			if (num >=11  && num <=15) numRespPerF1++;
			if (num >=16  && num <=20) numRespPerF2++;
			if (num >=21  && num <=30) numRespRecursos++;
			if (num >=21  && num <=25) numRespRecF1++;
			if (num >=26  && num <=30) numRespRecF2++;
			if (num >=31  && num <=40) numRespProcesos++;
			if (num >=31  && num <=35) numRespProF1++;
			if (num >=36  && num <=40) numRespProF2++;
			if (num >=41  && num <=43) numRespResultados++;
		}
		
	var restoNRes=0;
	if (numRespResultados > 0)
		restoNRes=1;
	
	document.getElementById("numRespEstrategia").value = numRespEstrategia*10+"%";	
	document.getElementById("numRespEstF1").value = "";//numRespEstF1*10+"%";
	document.getElementById("numRespEstF2").value = "";//numRespEstF2*10+"%";
	document.getElementById("numRespPersonas").value = numRespPersonas*10+"%";
	document.getElementById("numRespPerF1").value = "";//numRespPerF1*10+"%";
	document.getElementById("numRespPerF2").value = "";//numRespPerF2*10+"%";
	document.getElementById("numRespRecursos").value = numRespRecursos*10+"%";
	document.getElementById("numRespRecF1").value = "";//numRespRecF1*10+"%";
	document.getElementById("numRespRecF2").value = "";//numRespRecF2*10+"%";
	document.getElementById("numRespProcesos").value = numRespProcesos*10+"%";
	document.getElementById("numRespProF1").value = "";//numRespProF1*10+"%";
	document.getElementById("numRespProF2").value = "";//numRespProF2*10+"%";
	document.getElementById("numRespResultados").value = numRespResultados*33+restoNRes+"%";	

	calculoIco(numRespEstF1,"bEstF1_ico");
	calculoIco(numRespEstF2,"bEstF2_ico");
	calculoIco(numRespPerF1,"bPerF1_ico");
	calculoIco(numRespPerF2,"bPerF2_ico");
	calculoIco(numRespRecF1,"bRecF1_ico");
	calculoIco(numRespRecF2,"bRecF2_ico");
	calculoIco(numRespProF1,"bProF1_ico");
	calculoIco(numRespProF2,"bProF2_ico");
	calculoIco2(numRespEstrategia,"bEstrategia_ico");
	calculoIco2(numRespPersonas,"bPersonas_ico");
	calculoIco2(numRespRecursos,"bRecursos_ico");
	calculoIco2(numRespProcesos,"bProcesos_ico");
	calculoIco2(numRespResultados*3+restoNRes,"bResultados_ico");
}


function pulsar(seccion){
	document.getElementById("bEstF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bEstF2").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bPerF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bPerF2").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bRecF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bRecF2").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bProF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bProF2").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_claro.gif)";
	document.getElementById("bPersonas").style.background="url(wp-content/plugins/adeada/test/images/red_gris_claro.gif)";
	document.getElementById("bEstrategia").style.background="url(wp-content/plugins/adeada/test/images/red_gris_claro.gif)";
	document.getElementById("bRecursos").style.background="url(wp-content/plugins/adeada/test/images/red_gris_claro.gif)";
	document.getElementById("bProcesos").style.background="url(wp-content/plugins/adeada/test/images/red_gris_claro.gif)";
	document.getElementById("bResultados").style.background="url(wp-content/plugins/adeada/test/images/red_gris_claro.gif)";
	//document.getElementById("bInicio").style.background="url(wp-content/plugins/adeada/test/images/cuad_gris_claro.gif)";
	document.getElementById("bEnviar").style.background="url(wp-content/plugins/adeada/test/images/cuad_gris_claro.gif)";
	if ((seccion == "bEstF1") || (seccion == "bEstF2") || (seccion == "bPerF1") || (seccion == "bPerF2") || (seccion == "bRecF1") || (seccion == "bRecF2") || (seccion == "bProF1") || (seccion == "bProF2")){
		document.getElementById(seccion).style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_osc.gif)";	
		if ((seccion == "bEstF1") || (seccion == "bEstF2"))
			document.getElementById("bEstrategia").style.background="url(wp-content/plugins/adeada/test/images/red_gris_osc.gif)";
		if ((seccion == "bPerF1") || (seccion == "bPerF2")) 
			document.getElementById("bPersonas").style.background="url(wp-content/plugins/adeada/test/images/red_gris_osc.gif)";
		if ((seccion == "bRecF1") || (seccion == "bRecF2")) 
			document.getElementById("bRecursos").style.background="url(wp-content/plugins/adeada/test/images/red_gris_osc.gif)";
		if ((seccion == "bProF1") || (seccion == "bProF2")) 
			document.getElementById("bProcesos").style.background="url(wp-content/plugins/adeada/test/images/red_gris_osc.gif)";			
	}		
	if ((seccion == "bPersonas") || (seccion == "bEstrategia") || (seccion == "bRecursos") || (seccion == "bProcesos") || (seccion == "bResultados")){
		document.getElementById(seccion).style.background="url(wp-content/plugins/adeada/test/images/red_gris_osc.gif)";	
		if (seccion == "bEstrategia")
			document.getElementById("bEstF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_osc.gif)";	
		if (seccion == "bPersonas")
			document.getElementById("bPerF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_osc.gif)";	
		if (seccion == "bRecursos")
			document.getElementById("bRecF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_osc.gif)";	
		if (seccion == "bProcesos")
			document.getElementById("bProF1").style.background="url(wp-content/plugins/adeada/test/images/nodo_gris_osc.gif)";				
	}
	//if ((seccion == "bInicio") || (seccion == "bEnviar"))
	if (seccion == "bEnviar")
		document.getElementById(seccion).style.background="url(wp-content/plugins/adeada/test/images/cuad_gris_osc.gif)";						
}

function ver(seccion){
	//document.getElementById("seccion_inicio").style.display = "none";
	document.getElementById("seccion_estrategia_fase1").style.display = "none";
	document.getElementById("seccion_estrategia_fase2").style.display = "none";
	document.getElementById("seccion_personas_fase1").style.display = "none";
	document.getElementById("seccion_personas_fase2").style.display = "none";
	document.getElementById("seccion_recursos_fase1").style.display = "none";
	document.getElementById("seccion_recursos_fase2").style.display = "none";
	document.getElementById("seccion_procesos_fase1").style.display = "none";
	document.getElementById("seccion_procesos_fase2").style.display = "none";
	document.getElementById("seccion_resultados").style.display = "none";
	//Effect.Appear(seccion);
	document.getElementById(seccion).style.display = "block";			
}
function listado(){
	window.location.href = "?page_id=45";
}
function envio(){
	if (validar()){
		document.getElementById("estado_cuestinario").value = "1";
		document.getElementById("formEnvio").action = "?page_id=38";
		document.getElementById("formEnvio").submit();	
	}
	return true;
}
function envioTemp(){
	document.getElementById("formEnvio").action = "?page_id=38";
	document.getElementById("formEnvio").submit();	
	return true;
}
function alerta(msg){
	document.getElementById("mensaje").innerHTML = msg;
	document.getElementById("mensaje").style.display = "block";
	if (msg == "")
		document.getElementById("mensaje").style.display = "none";
}
function validarRadios(num){
	var valido = true;
	var radioPulsado = false; 
	//for (i=0; i<document.forms["formEnvio"]["resp_"+num].length; i++)
	//  if (document.forms["formEnvio"]["resp_"+num][i].checked==true)
	//    radioPulsado = true; 
	if (document.forms["formEnvio"]["resp_"+num][11].checked==false)
		radioPulsado = true;
	if ( radioPulsado == false)  
	  {
	  alerta("Debe dar una respuesta a la pregunta "+num);
	  valido = false;
	  }
	return valido;  	
}
function validar_seccion_inicio(){
	/*var x=document.forms["formEnvio"]["nombreempresa"].value
	if (x==null || x=="")
	  {
	  alerta("Debe rellenar el nombre de empresa");
	  return false;
	  }
	x=document.forms["formEnvio"]["nombre"].value 
	if (x==null || x=="")
	  {
	  alerta("Debe rellenar su nombre");
	  return false;
	  }
	x=document.forms["formEnvio"]["p_email"].value; 
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	  {
	  alerta("Dirección de e-mail no válida");
	  return false;
	  }
	alerta(""); */
	return true;  
}
function validar_seccion_estrategia_fase1(){	 
	for (var i=1;i<=5;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  
}
function validar_seccion_estrategia_fase2(){	 
	for (var i=6;i<=10;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  
}
function validar_seccion_personas_fase1(){	  	
	for (var i=11;i<=15;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_personas_fase2(){	  	
	for (var i=16;i<=20;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_recursos_fase1(){	  	
	for (var i=21;i<=25;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_recursos_fase2(){	  	
	for (var i=26;i<=30;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_procesos_fase1(){	  	
	for (var i=31;i<=35;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_procesos_fase2(){	  	
	for (var i=36;i<=40;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar_seccion_resultados(){	  	
	for (var i=41;i<=43;i++)
	  if (!validarRadios(i))
	     return false;
	alerta("");      
	return true;  	  	  	 
}
function validar(){
	if (!validar_seccion_inicio())
	  return false;
	if (!validar_seccion_estrategia_fase1())
	  return false;
	if (!validar_seccion_estrategia_fase2())
	  return false;	  
	if (!validar_seccion_personas_fase1())
	  return false;
	if (!validar_seccion_personas_fase2())
	  return false;	  
	if (!validar_seccion_recursos_fase1())
	  return false;
	if (!validar_seccion_recursos_fase2())
	  return false;	  
	if (!validar_seccion_procesos_fase1())
	  return false;
	if (!validar_seccion_procesos_fase2())
	  return false;	  
	if (!validar_seccion_resultados())
	  return false;	  
	alerta("");   	  	  	    
	return true; 	
}