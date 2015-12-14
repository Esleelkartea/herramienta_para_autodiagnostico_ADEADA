<?php
/****************************************************************************************************/
/* include: inicio.php
/* Theme: adeada
/* Descripción: Carga del formulario de encuesta
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

<script>
window.onload = calculoPorcentajes;
</script>

<?php

	function getResultadoEncuesta($id_encuesta){
		$arrRes = Array();
		global $wpdb;
		$sql = "SELECT id_pregunta,id_encuesta,puntos FROM `adeada_respuestas` WHERE id_encuesta='".$id_encuesta."'";
		$resultRespuestas = $wpdb->get_results($sql); 
		$col=1;
		if($resultRespuestas){
			foreach ($resultRespuestas as $rRespuestas) {
				$arrRes[$col] = $rRespuestas->puntos;
				$col++;
			}
		}
		return $arrRes;
	}
	
	function getEstadoEncuesta($id_encuesta){
		global $wpdb;
		$estado = $wpdb->get_var($wpdb->prepare("SELECT estado FROM adeada_encuestas WHERE id_encuesta='".$id_encuesta."'"));
		return $estado;
	}
		
	//inicializacion variables
	$curBloque = "inicio";
	$cont = 1;
	$first = false;
	$paso = -1;
	$arrAreas = array("estrategia_fase1","estrategia_fase2","personas_fase1","personas_fase2","recursos_fase1","recursos_fase2","procesos_fase1","procesos_fase2","resultados","final");
	$arrAreasEstilos = array("bEstF1","bEstF2","bPerF1","bPerF2","bRecF1","bRecF2","bProF1","bProF2","bResultados","bEnviar");
	$numRespEstrategia =0;$numRespPersonas =0;$numRespRecursos =0;$numRespProcesos =0;$numRespResultados =0;$numRespEstF1 =0;$numRespEstF2 =0;$numRespPerF1 =0;$numRespPerF2 =0;$numRespRecF1 =0;$numRespRecF2 =0;$numRespProF1 =0;$numRespProF2 = 0;
	$estado = "0";
	$strEstado = "";
	$bActualizar = false;
	$arrRes = NULL;	
	$strDispSec = "block";
	$strAnterior = "";
?>

<form id="formEnvio"  method="post">

<?php	
	//Para distinguir entre actualizar y nuevo

	if ($_GET['id_encuesta']!=null && $_GET['id_encuesta']!=""){
		$estado = getEstadoEncuesta($_GET['id_encuesta']);
		if ($estado == "1")
			$strEstado = "disabled";
		$arrRes = getResultadoEncuesta($_GET['id_encuesta']);
		for ($i=1;$i<=10;$i++) if ($arrRes[$i] != null) $numRespEstrategia++;
		for ($i=1;$i<=5;$i++) if ($arrRes[$i] != null) $numRespEstF1++;
		for ($i=6;$i<=10;$i++) if ($arrRes[$i] != null) $numRespEstF2++;				
		for ($i=11;$i<=20;$i++) if ($arrRes[$i] != null) $numRespPersonas++;
		for ($i=11;$i<=15;$i++) if ($arrRes[$i] != null) $numRespPerF1++;
		for ($i=16;$i<=20;$i++) if ($arrRes[$i] != null) $numRespPerF2++;				
		for ($i=21;$i<=30;$i++) if ($arrRes[$i] != null) $numRespRecursos++;
		for ($i=21;$i<=25;$i++) if ($arrRes[$i] != null) $numRespRecF1++;
		for ($i=26;$i<=30;$i++) if ($arrRes[$i] != null) $numRespRecF2++;				
		for ($i=31;$i<=40;$i++) if ($arrRes[$i] != null) $numRespProcesos++;
		for ($i=31;$i<=35;$i++) if ($arrRes[$i] != null) $numRespProF1++;
		for ($i=36;$i<=40;$i++) if ($arrRes[$i] != null) $numRespProF2++;				
		for ($i=41;$i<=43;$i++) if ($arrRes[$i] != null) $numRespResultados++;	
		$bActualizar = true;
		echo "<input type='hidden' id='id_encuesta' name='id_encuesta' value='".$_GET['id_encuesta']."' />";
	}
	
	global $wpdb;
	$sql = "SELECT id_pregunta, pregunta, adeada_preguntas.descripcion AS descripcion, opciones, adeada_areas.nombre AS area FROM adeada_preguntas INNER JOIN adeada_areas ON adeada_areas.id_area = adeada_preguntas.id_area ORDER BY id_pregunta";
	$result = $wpdb->get_results($sql);
?>



<input type='hidden' id='estado_cuestinario' name='estado_cuestinario' value='0' />

<div class="menuCuestionario">
<div id="porcentajes">
<input class="porcentajes1" type='text' id='numRespEstrategia' name='numRespEstrategia' value='<?php echo $numRespEstrategia*10 ?>%' />
<input class="porcentajes2" type='text' id='numRespEstF1' name='numRespEstF1' value='' />
<input class="porcentajes2" type='text' id='numRespEstF2' name='numRespEstF2' value='' />
<input class="porcentajes1" type='text' id='numRespPersonas' name='numRespPersonas' value='<?php echo $numRespPersonas*10 ?>%' />
<input class="porcentajes2" type='text' id='numRespPerF1' name='numRespPerF1' value='' />
<input class="porcentajes2" type='text' id='numRespPerF2' name='numRespPerF2' value='' />
<input class="porcentajes1" type='text' id='numRespRecursos' name='numRespRecursos' value='<?php echo $numRespRecursos*10 ?>%' />
<input class="porcentajes2" type='text' id='numRespRecF1' name='numRespRecF1' value='' />
<input class="porcentajes2" type='text' id='numRespRecF2' name='numRespRecF2' value='' />
<input class="porcentajes1" type='text' id='numRespProcesos' name='numRespProcesos' value='<?php echo $numRespProcesos*10 ?>%' />
<input class="porcentajes2" type='text' id='numRespProF1' name='numRespProF1' value='' />
<input class="porcentajes2" type='text' id='numRespProF2' name='numRespProF2' value='' />
<input class="porcentajes1" type='text' id='numRespResultados' name='numRespResultados' value='<?php echo $numRespResultados*33 ?>%' />
</div>

<div id="botonera">
<div id="bInicio" onclick='listado()'><div id="bInicio_ico">In</div></div>
<div class="bFlecha">&nbsp;</div>
<div id="bEstrategia" onclick='ver("seccion_estrategia_fase1");pulsar(this.id)'><div id="bEstrategia_ico">1</div></div>
<div id="bEstF1" onclick='ver("seccion_estrategia_fase1");pulsar(this.id)'><div id="bEstF1_ico">&nbsp;&nbsp;</div></div>
<div id="bEstF2" onclick='ver("seccion_estrategia_fase2");pulsar(this.id)'><div id="bEstF2_ico">&nbsp;&nbsp;</div></div>
<div class="bFlecha">&nbsp;</div>
<div id="bPersonas" onclick='ver("seccion_personas_fase1");pulsar(this.id)'><div id="bPersonas_ico">2</div></div>
<div id="bPerF1" onclick='ver("seccion_personas_fase1");pulsar(this.id)'><div id="bPerF1_ico">&nbsp;&nbsp;</div></div>
<div id="bPerF2" onclick='ver("seccion_personas_fase2");pulsar(this.id)'><div id="bPerF2_ico">&nbsp;&nbsp;</div></div>
<div class="bFlecha">&nbsp;</div>
<div id="bRecursos" onclick='ver("seccion_recursos_fase1");pulsar(this.id)'><div id="bRecursos_ico">3</div></div>
<div id="bRecF1" onclick='ver("seccion_recursos_fase1");pulsar(this.id)'><div id="bRecF1_ico">&nbsp;&nbsp;</div></div>
<div id="bRecF2" onclick='ver("seccion_recursos_fase2");pulsar(this.id)'><div id="bRecF2_ico">&nbsp;&nbsp;</div></div>
<div class="bFlecha">&nbsp;</div>
<div id="bProcesos" onclick='ver("seccion_procesos_fase1");pulsar(this.id)'><div id="bProcesos_ico">4</div></div>
<div id="bProF1" onclick='ver("seccion_procesos_fase1");pulsar(this.id)'><div id="bProF1_ico">&nbsp;&nbsp;</div></div>
<div id="bProF2" onclick='ver("seccion_procesos_fase2");pulsar(this.id)'><div id="bProF2_ico">&nbsp;&nbsp;</div></div>
<div class="bFlecha">&nbsp;</div>
<div id="bResultados" onclick='ver("seccion_resultados");pulsar(this.id)'><div id="bResultados_ico">5</div></div>
<div class="bFlecha">&nbsp;</div>
<?php if ($estado == "0"){?>
<div id="bEnviar" onclick='envio()'><div id="bEnviar_ico">Dg</div></div>
<?php }else{?>
<div id="bEnviar"><div id="bEnviar_ico">Dg</div></div>
<?php } ?>
</div>

<div id="titulares">
<div class="titInicio" >Inicio</div>
<div class="porcentajes1" >Estrategia</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes1" >Personas</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes1" >Recursos</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes1" >Procesos y clientes</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes2" >&nbsp;</div>
<div class="porcentajes1" >Resultados</div>
<div class="porcentajes1" >Diagn&oacute;stico</div>
</div>

</div>

<div style="clear:both;">
</div>


	
<?php	
	foreach ($result as $r) {
						
		switch($r->opciones) {
			case "0_10":
				//$aResp = array(0=>"No",1=>"Puntual",2=>"Sistematico bajo",3=>"Sistematico alto",4=>"Documentado bajo",5=>"Documentado medio",6=>"Documentado alto",7=>"Revisado bajo",8=>"Revisado alto",9=>"Mejorado bajo",10=>"Mejorado alto");
				$aResp = array(0=>"0",1=>"1",2=>"2",3=>"3",4=>"4",5=>"5",6=>"6",7=>"7",8=>"8",9=>"9",10=>"10");
			break;						
		}
		if ($curBloque != $r->area){
			$paso++;
			$curBloqueAnt = $curBloque;
			//echo "ant:".getAreaAnt($curBloque)."---act:".$curBloque."---sig:".getAreaSig($curBloque);
			if ($first){
				//echo "</table><input type='button' onclick='ver(\"seccion_".$r->area."\")' value='++' class='siguiente'/></div>";
				if ($paso > 1)
					$strAnterior = "<a href='#' onclick='alerta(\"\");ver(\"seccion_".$arrAreas[$paso-2]."\");pulsar(\"".$arrAreasEstilos[$paso-2]."\")' class='anterior'><< Anterior</a>";
				echo "</table>".$strAnterior."<a href='#' onclick='ver(\"seccion_".$arrAreas[$paso]."\");pulsar(\"".$arrAreasEstilos[$paso]."\")' class='siguiente'>Siguiente >></a></div>";
				$strDispSec = "none";
			}
			$first = true;
			$curBloque = $r->area;
			echo "<div class='seccion' style='display:".$strDispSec.";' id='seccion_".$curBloque."'>";
			//echo "<input type='button' onclick='alerta(\"\");ver(\"seccion_".$curBloqueAnt."\")' value='--' class='anterior'/>";
			//echo "<span class='paso'>Paso ".$paso."</span>";
			echo "<table>";
			//echo "<tr><th colspan='12' class='titulo'>".$curBloque." --- Paso ".$paso."</th></tr>";
			if ($curBloque == 'resultados'){
				echo "<tr>";
				echo "<th>pregunta</th>";
				echo "<th class='r_no'>No</th>";
				echo "<th class='r_puntual'>Pocos datos</th>";
				echo utf8_encode("<th colspan=2 class='r_sistematico'>Datos satisfactorios sin objetivos</th>");
				echo utf8_encode("<th colspan=3 class='r_documentado'>Resultados satisfactorios con objetivos</th>");
				echo utf8_encode("<th colspan=2 class='r_revisado'>Objetivos superados</th>");
				echo "<th colspan=2 class='r_mejorado'>Resultados positivos y comparaciones</th></tr>";			
			}
			else{
				echo "<tr>";
				echo "<th></th>";
				echo "<th class='r_no'>No se ha hecho nada</th>";
				echo "<th class='r_puntual'>Se ha hecho puntualmente</th>";
				echo utf8_encode("<th colspan=2 class='r_sistematico'>Es sistemático</th>");
				echo utf8_encode("<th colspan=3 class='r_documentado'>Las acciones se documentan</th>");
				echo utf8_encode("<th colspan=2 class='r_revisado'>Los procedimientos se revisan</th>");
				echo "<th colspan=2 class='r_mejorado'>Los procedimientos se mejoran</th></tr>";
				echo "<tr><th>pregunta</th>";
				echo "<th> </th>";
				echo "<th> </th>";
				echo "<th>En algunos casos</th>";
				echo utf8_encode("<th>En la mayoría de los casos</th>");
				echo "<th>En algunos casos</th>";
				echo "<th>En muchos casos</th>";
				echo utf8_encode("<th>En casi todos los casos</th>");
				echo "<th>En algunos casos</th>";
				echo "<th>En casi todos los casos</th>";
				echo "<th>En algunos casos</th>";
				echo "<th>En casi todos los casos</th></tr>";
			}
			
			//echo "<tr><th>pregunta</th>";
			//foreach ($aResp as $valor => $txt) {
			//	echo "<th>".$txt."</th>";
			//}
			//echo "</tr>";			
		}		
			
		$cont++;
		$par = "par";	
		if ($cont%2 == 0)
			$par = "impar";
		$descripcion = "";
		if (strlen($r->descripcion) > 2)
			$descripcion = "<a class=Ntooltip href='#'>NOTA<span>".$r->descripcion."</span></a>";
		echo "<tr class='".$par."'><td class='pregunta'><div>".$r->id_pregunta.". ".$r->pregunta." ".$descripcion."</div></td>";
		$id = "resp_".$r->id_pregunta;
		$bAct = false;
		foreach ($aResp as $valor => $txt) {
			if (($bActualizar) && ($arrRes[$r->id_pregunta] != null) && ($arrRes[$r->id_pregunta] == $valor)){
				echo "<td class='radiobutton'><input type=\"radio\" id=\"".$id."\" name=\"".$id."\" value=\"".$valor."\" checked ".$strEstado." onclick='calculoPorcentajes()'/></td>";
				$bAct = true;
			}
			else
				echo "<td class='radiobutton'><input type=\"radio\" id=\"".$id."\" name=\"".$id."\" value=\"".$valor."\" ".$strEstado." onclick='calculoPorcentajes()'/></td>";
		}
		//check de control para poder enviar siempre un valor en el POST
		if ($bAct)
			echo "<td class='radiobuttoncontrol'><input type=\"radio\" id=\"".$id."\" name=\"".$id."\" value=NULL ".$strEstado."/></td>";
		else
			echo "<td class='radiobuttoncontrol'><input type=\"radio\" id=\"".$id."\" name=\"".$id."\" value=NULL checked ".$strEstado."/></td>";
		echo "</tr>";
	}
	echo "</table><a href='#' onclick='alerta(\"\");ver(\"seccion_".$arrAreas[$paso-1]."\");pulsar(\"".$arrAreasEstilos[$paso-1]."\")' class='anterior'><< Anterior</a>";
	if ($estado == "0")
		echo "<a href='#' id='enviar' onclick='envio()' class='enviar'>Finalizar</a>";
	echo "</div>";

?>
<?php if ($estado == "0"){?>
	<a href='#' id='enviarTemp' name='enviarTemp' onclick='envioTemp()' class='enviar'>Salir de la aplicaci&oacute;n y Continuar m&aacute;s tarde</a>
<?php }?>
<div id='capaEnviarTemp'>&nbsp;</div>
</form>


