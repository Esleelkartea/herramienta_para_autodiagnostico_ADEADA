<?php
/****************************************************************************************************/
/* include: mejoras.php
/* Theme: adeada
/* Descripción: Muestra el calculo de las mejoras de un cuestionario
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
		$id_encuesta = $_GET['id_encuesta'];
		
		$strElem = "<ul class='informe2'>";
		$strElem = $strElem."<li><a href='?page_id=8&id_encuesta=".$id_encuesta."'>Revisar el diagn&oacute;stico</a></li>";
		$strElem = $strElem."<li><a href='?page_id=118&id_encuesta=".$id_encuesta."'>Puntuaci&oacute;n</a></li>";
		$strElem = $strElem."<li><a href='?page_id=120&id_encuesta=".$id_encuesta."'>Posibles Mejoras</a></li>";
		$strElem = $strElem."<li><a href='?page_id=122&id_encuesta=".$id_encuesta."'>Puntos Fuertes</a></li>";
		$strElem = $strElem."<li><a href='?page_id=183&id_encuesta=".$id_encuesta."'>Comparativa</a></li>";
		$strElem = $strElem."</ul>";
		echo $strElem;		
		
		$sql = "SELECT adeada_encuestas.id_encuesta, adeada_preguntas.id_pregunta, adeada_resultados.puntos, adeada_resultados.resultado FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_preguntas.id_pregunta = adeada_respuestas.id_pregunta INNER JOIN adeada_resultados ON adeada_preguntas.id_pregunta = adeada_resultados.id_pregunta WHERE adeada_resultados.puntos = adeada_respuestas.puntos AND adeada_encuestas.estado = '1' AND adeada_encuestas.id_encuesta = ".$id_encuesta." AND adeada_respuestas.puntos < 5 ORDER BY adeada_respuestas.puntos";
		$resultEncuestas = $wpdb->get_results($sql);
		echo "<div class='informe'><ul>";
		if($resultEncuestas){
			foreach ($resultEncuestas as $rEncuestas) {
        	    echo "<li>".$rEncuestas->resultado."</li>";
			}
		}
		echo "</ul></div>";
   
?>