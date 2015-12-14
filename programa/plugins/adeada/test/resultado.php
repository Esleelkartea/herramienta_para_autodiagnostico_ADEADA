<?php
/****************************************************************************************************/
/* include: resultado.php
/* Theme: adeada
/* Descripción: Muestra el listado de cuestionarios
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor                    Fecha                Acción
/*
/* Digital5 S.L.        30/06/2011    Creación
/*
/****************************************************************************************************/
?>

<?php

        global $wpdb;
		if (( current_user_can('gestionar_datos') ) && ($pagRes == 0))
			$sql = "SELECT id_encuesta,id_usuario,concepto,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,DATE_FORMAT(fec_mod, '%d-%m-%Y') as fec_mod FROM adeada_encuestas";
		else	
			$sql = "SELECT id_encuesta,id_usuario,concepto,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,DATE_FORMAT(fec_mod, '%d-%m-%Y') as fec_mod FROM adeada_encuestas WHERE id_usuario='".get_current_user_id( )."'";
        $resultEncuestas = $wpdb->get_results($sql);
        $filas = array();
        $columnas = array(52);
        $indexArr = 0;
        if($resultEncuestas){
			foreach ($resultEncuestas as $rEncuestas) {
        	    $columnas[0] = $rEncuestas->id_encuesta;
        		$columnas[1] = get_userdata($rEncuestas->id_usuario)->user_login;
        		$columnas[2] = $rEncuestas->concepto;
        		$columnas[3] = $rEncuestas->estado;
        		$columnas[4] = $rEncuestas->fec_alta;
        		$columnas[5] = $rEncuestas->fec_mod;
        		$sql = "SELECT id_pregunta,id_encuesta,puntos FROM `adeada_respuestas` WHERE id_encuesta='".$rEncuestas->id_encuesta."'";
        		$resultRespuestas = $wpdb->get_results($sql); 
        		$col=6;
        		if($resultRespuestas){
					foreach ($resultRespuestas as $rRespuestas) {
        				//echo " ++++ ".$rRespuestas["puntos"];
        				$columnas[$col] = $rRespuestas->puntos;
        				$col++;
        			}
        		}
        		$filas[$indexArr] = $columnas;
        		$indexArr++;
        	}
        }

		echo "<div id='resultadoTabla'>";
		if (!(( current_user_can('gestionar_datos') ) && ($pagRes == 0)))
			echo "<p>Si desea realizar un nuevo <strong>Autodiagn&oacute;stico</strong> pulse en: <strong><a href='?page_id=8'>Nuevo</a></strong></p>";			
		//echo "<tr><th colspan='3' style='border:0;'>&nbsp;</th><th><a href='?page_id=8'>Nuevo</a></th></tr>";
        echo "<table><tr><th>Fecha alta</th><th>Fecha Fin</th><th>Estado</th><th>Diagn&oacute;sticos</th><th>Puntuaci&oacute;n</th><th>Areas de Mejora</th><th>Puntos Fuertes</th><th>Comparativa</th></tr>";
        for ($i=0;$i<$indexArr;$i++){
        	echo "<tr>";
			echo "<td>".$filas[$i][4]."</td>";
			echo "<td>".$filas[$i][5]."</td>";
			$contResp = 0;
        	for ($j=0;$j<49;$j++)//6+43
				if ($filas[$i][$j] != null)
					$contResp++;
			$strCompletado = "Completo";
			$strAccion = "Revisar";
			if ($filas[$i][3] == 1){
				echo "<td>".$strCompletado."</td>";		
				echo "<td><div><a href='?page_id=8&id_encuesta=".$filas[$i][0]."'>".$strAccion."</a></div></td>";			
				echo "<td><div><a href='?page_id=118&id_encuesta=".$filas[$i][0]."'>Ver</a></div></td>";
				echo "<td><div><a href='?page_id=120&id_encuesta=".$filas[$i][0]."'>Ver</a></div></td>";
				echo "<td><div><a href='?page_id=122&id_encuesta=".$filas[$i][0]."'>Ver</a></div></td>";
				echo "<td><div><a href='?page_id=183&id_encuesta=".$filas[$i][0]."'>Ver</a></div></td>";
			}
			else{
				$strCompletado = round($contResp*100/43)."%";
				$strAccion = "Continuar";	
				echo "<td>".$strCompletado."</td>";		
				echo "<td><div><a href='?page_id=8&id_encuesta=".$filas[$i][0]."'>".$strAccion."</a></div></td>";
				echo "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
			}
        	echo "</tr>";	
        }
        echo "</table>";
		echo "</div>";
?>

