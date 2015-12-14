<?php
/****************************************************************************************************/
/* include: indicador.php
/* Theme: adeada
/* Descripción: Carga del formulario del indicador
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor                    Fecha                Acción
/*
/* Digital5 S.L.        30/06/2011    Creación
/*
/****************************************************************************************************/
?>

<script src="wp-content/plugins/adeada/test/validar.js"></script>

<?php
$strVentas="";$strFacturas="";$strCostes="";$strSatisfaccionClientes="";$strClientes="";$strQuejas="";$strSatisfaccionPersonal="";$strSugerencias="";$strAbsentismo="";$strRotacion="";
$strIndicador="";
$strUsuario="";
global $wpdb;
$sql = "SELECT * FROM `adeada_indicadores` WHERE id_usuario = '".get_current_user_id( )."'";
$resultRespuestas = $wpdb->get_row($sql); 
if($resultRespuestas){
	$strIndicador = $resultRespuestas->id_indicador;
	$strUsuario = $resultRespuestas->id_usuario;
	$strVentas = $resultRespuestas->ventas;
	$strFacturas = $resultRespuestas->facturas;
	$strCostes = $resultRespuestas->costes;
	$strSatisfaccionClientes = $resultRespuestas->satisfaccion_clientes;
	$strClientes = $resultRespuestas->clientes;
	$strQuejas = $resultRespuestas->quejas;
	$strSatisfaccionPersonal = $resultRespuestas->satisfaccion_personal;
	$strSugerencias = $resultRespuestas->sugerencias;
	$strAbsentismo = $resultRespuestas->absentismo;
	$strRotacion = $resultRespuestas->rotacion;
}

?>

<form id="formIndicador" method="post">
<input type='hidden' id='id_indicador' name='id_indicador' value='<?php echo $strIndicador?>' />
<input type='hidden' id='id_usuario' name='id_usuario' value='<?php echo get_current_user_id( )?>' />
<h1>Econ&oacute;micos</h1>
<div><div>Cifra de ventas del &uacute;ltimo ejercicio</div><input id='ventas' name='ventas' type="text" value="<?php echo $strVentas?>" /></div>
<div><div>N&uacute;mero de facturas emitidas</div><input id='facturas' name='facturas' type="text" value="<?php echo $strFacturas?>" /></div>
<div><div>Costes totales (fijos y variables) del &uacute;ltimo ejercicio</div><input id='costes' name='costes' type="text" value="<?php echo $strCostes?>" /></div>
<h1>De Satisfacci&oacute;n del Cliente</h1>
<div><div>Media de puntuaci&oacute;n (0 a 5) de la encuesta de satisfacci&oacute;n de clientes</div><select id='satisfaccion_clientes' name='satisfaccion_clientes'><option value='0' <?php echo (($strSatisfaccionClientes == 0)?'selected':'')?>>0</option><option value='1' <?php echo (($strSatisfaccionClientes == 1)?'selected':'')?>>1</option><option value='2' <?php echo (($strSatisfaccionClientes == 2)?'selected':'')?>>2</option><option value='3' <?php echo (($strSatisfaccionClientes == 3)?'selected':'')?>>3</option><option value='4' <?php echo (($strSatisfaccionClientes == 4)?'selected':'')?>>4</option><option value='5' <?php echo (($strSatisfaccionClientes == 5)?'selected':'')?>>5</option></select></div>
<div><div>N&uacute;mero de clientes de la base de datos</div><input id='clientes' name='clientes' type="text" value="<?php echo $strClientes?>" /></div>
<div><div>N&uacute;mero de quejas recibidas (documentadas por escrito)</div><input id='quejas' name='quejas' type="text" value="<?php echo $strQuejas?>" /></div>
<h1>De Satisfacci&oacute;n del Personal</h1>
<div><div>Media de puntuaci&oacute;n (0 a 5) de la encuesta de satisfacci&oacute;n de empleados</div><select id='satisfaccion_personal' name='satisfaccion_personal'><option value='0' <?php echo (($strSatisfaccionPersonal == 0)?'selected':'')?>>0</option><option value='1' <?php echo (($strSatisfaccionPersonal == 1)?'selected':'')?>>1</option><option value='2' <?php echo (($strSatisfaccionPersonal == 2)?'selected':'')?>>2</option><option value='3' <?php echo (($strSatisfaccionPersonal == 3)?'selected':'')?>>3</option><option value='4' <?php echo (($strSatisfaccionPersonal == 4)?'selected':'')?>>4</option><option value='5' <?php echo (($strSatisfaccionPersonal == 5)?'selected':'')?>>5</option></select></div>
<div><div>N&uacute;mero de sugerencias aportadas por el personal (documentadas por escrito)</div><input id='sugerencias' name='sugerencias' type="text" value="<?php echo $strSugerencias?>" /></div>
<div><div>Nivel de absentismo (n&ordm; de horas perdidas entre total de horas te&oacute;ricas y por 100)</div><input id='absentismo' name='absentismo' type="text" value="<?php echo $strAbsentismo?>" /></div>
<div><div>Nivel de rotaci&oacute;n (n&ordm; de personas que abandonan la empresa m&aacute;s n&ordm; de personas de nueva incorporaci&oacute;n entre el total de la plantilla y por 100)</div><input id='rotacion' name='rotacion' type="text" value="<?php echo $strRotacion?>" /></div>
<a href='#' id='enviarIndicador' onclick='envioIndicador()' class='enviar'>Guardar</a>
</form>