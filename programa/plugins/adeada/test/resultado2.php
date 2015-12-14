
<?php

        global $wpdb;
		if (( current_user_can('gestionar_datos') ) && ($pagRes == 0))
			$sql = "SELECT * FROM adeada_encuestas";
		else	
			$sql = "SELECT * FROM adeada_encuestas WHERE id_usuario='".get_current_user_id( )."'";
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
        /*echo "<table>";
        echo "<tr><th>ver</th><th>encuesta</th><th>Usuario</th><th>Concepto</th><th>Estado</th><th>Fecha alta</th><th>Fecha Modificaci&oacute;n</th><th>E1</th><th>E2</th><th>E3</th><th>E4</th><th>E5</th><th>E6</th><th>E7</th><th>E8</th><th>E9</th><th>E10</th><th>P1</th><th>P2</th><th>P3</th><th>P4</th><th>P5</th><th>P6</th><th>P7</th><th>P8</th><th>P9</th><th>P10</th><th>R1</th><th>R2</th><th>R3</th><th>R4</th><th>R5</th><th>R6</th><th>R7</th><th>R8</th><th>R9</th><th>R10</th><th>PR1</th><th>PR2</th><th>PR3</th><th>PR4</th><th>PR5</th><th>PR6</th><th>PR7</th><th>PR8</th><th>PR9</th><th>PR10</th><th>RS1</th><th>RS2</th><th>RS3</th></tr>";
        for ($i=0;$i<$indexArr;$i++){
        	echo "<tr>";
			echo "<td><div><a href='?page_id=8&id_encuesta=".$filas[$i][0]."'>".$filas[$i][0]."</a></div></td>";
        	for ($j=0;$j<49;$j++)//6+43
        		echo "<td>".$filas[$i][$j]."</td>";
        	echo "</tr>";	
        }
        echo "</table>";*/
		echo "<div id='resultadoTabla'><table>";
		//echo "<tr><th colspan='3' style='border:0;'>&nbsp;</th><th><a href='?page_id=8'>Nuevo</a></th></tr>";
        echo "<tr><th>Fecha alta</th><th>Fecha Fin</th><th>Estado</th><th>Acciones</th></tr>";
        for ($i=0;$i<$indexArr;$i++){
        	echo "<tr>";
			echo "<td>".$filas[$i][4]."</td>";
			echo "<td>".$filas[$i][5]."</td>";
			$contResp = 0;
        	for ($j=0;$j<49;$j++)//6+43
				if ($filas[$i][$j] != null)
					$contResp++;
			$strCompletado = "Completo";
			$strAccion = "Ver resultado";
			if ($filas[$i][3] == 0){
				$strCompletado = round($contResp*100/43)."%";
				$strAccion = "Continuar";
			}
			echo "<td>".$strCompletado."</td>";		
			echo "<td><div><a href='?page_id=8&id_encuesta=".$filas[$i][0]."'>".$strAccion."</a></div></td>";
        	echo "</tr>";	
        }
        echo "</table>";
		echo "<p>Si desea realizar un nuevo <strong>Autodiagn&oacute;stico</strong> pulse en: <strong><a href='?page_id=8'>Nuevo</a></strong></p>";
		echo "</div>";
?>

