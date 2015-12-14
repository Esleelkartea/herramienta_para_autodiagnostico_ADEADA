var $T = jQuery.noConflict();
$T(document).ready(function(){  
	$T("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)  
	$T("#menu-principal li a").click(function() { //When trigger is clicked...  
		//Following events are applied to the subnav itself (moving subnav up and down)  
		$T(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click  
		$T(this).parent().hover(function() {  
		}, function(){  
			$T(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up  
		});  

	//Following events are applied to the trigger (Hover events for the trigger)  
	}).hover(function() {  
		$T(this).addClass("subhover"); //On hover over, add class "subhover"  
	}, function(){  //On Hover Out  
		$T(this).removeClass("subhover"); //On hover out, remove class "subhover"  
	});  
	
	// Mostrar u ocultar ventana de acceso
	$T("#acceso-conectarse").click(function() {
		$T("#ventana-login").slideDown('fast').show(); //mostrar
		//document.getElementById("loginUsuario").focus();
	});
	$T("#link-cerrar-ventana-login").click(function() {
		$T("#ventana-login").slideUp('slow').show(); //ocultar
	});
	
	// Mostrar u ocultar ventana de registro
	$T("#acceso-registrarse").click(function() {
		$T("#ventana-registro").slideDown('fast').show(); //mostrar
		//document.getElementById("loginRegistro").focus();
	});
	$T("#link-cerrar-ventana-registro").click(function() {
		$T("#ventana-registro").slideUp('slow').show(); //ocultar
	});
	
	// Validar registro
	$T("#link-validar-registro").click(function() {
		if(document.getElementById("loginRegistro").value == "") {
			alert("No se ha indicado mail de registro");
			document.getElementById("loginRegistro").focus();
		} else if(document.getElementById("passRegistro").value == "") {
			alert("No se ha indicado clave de registro");
			document.getElementById("passRegistro").focus();
		} else if(document.getElementById("passRegistro").value != document.getElementById("passRegistroRep").value) {
			alert("La clave indicada no coincide con su réplica");
			document.getElementById("passRegistro").focus();
		} else if(document.getElementById("nombreRegistro").value == "") {
			alert("No se ha indicado nombre de registro");
			document.getElementById("nombreRegistro").focus();
		} else {
			document.getElementById("accion").value = "registrar";
			document.forms["principal"].submit();
		}
	});
	
	// Login
	$T("#link-validar-usuario").click(function() {
		if(document.getElementById("loginUsuario").value == "") {
			alert("No se ha indicado usuario");
			document.getElementById("loginUsuario").focus();
		} else if(document.getElementById("passUsuario").value == "") {
			alert("No se ha indicado clave");
			document.getElementById("passUsuario").focus();
		} else {
			document.getElementById("accion").value = "entrar";
			document.forms["principal"].submit();
		}
	});
	
	
	// Logout
	/*
	$T("#acceso-logout").click(function() {
		if(confirm("¿Deseas cerrar la sesión?")) {
			document.getElementById("accion").value = "salir";
			document.forms["principal"].submit();
		}
	});
	*/
	
});
