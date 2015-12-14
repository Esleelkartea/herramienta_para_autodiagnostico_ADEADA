<?php
/****************************************************************************************************/
/* include: puntuacion.php
/* Theme: adeada
/* Descripción: Muestra el cálculo de la puntuación de un cuestionario
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
				
		//$puntosEstrategia = 0;$puntosPersonas = 0;$puntosRecursos = 0;$puntosProcesos = 0;$puntosResultados = 0;
		//$mylink = $wpdb->get_row("SELECT estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta  WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10) AS Est, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta  WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20) As Per, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta  WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30) AS Rec , (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta  WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40) AS Pro, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta  WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta");
		
		//puntos ponderados por area
		$mylink = $wpdb->get_row("SELECT estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10 GROUP BY adeada_respuestas.id_encuesta) AS Est, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20 GROUP BY adeada_respuestas.id_encuesta) As Per, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30 GROUP BY adeada_respuestas.id_encuesta) AS Rec , (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40 GROUP BY adeada_respuestas.id_encuesta) AS Pro, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43 GROUP BY adeada_respuestas.id_encuesta) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta");
		$strTabla = $strTabla."<td style='background:#ddd'>resultado</td>";
		$strTabla = $strTabla."<td>".round($mylink->estrategia)."</td>";
		$strTabla = $strTabla."<td>".round($mylink->personas)."</td>";
		$strTabla = $strTabla."<td>".round($mylink->recursos)."</td>";
		$strTabla = $strTabla."<td>".round($mylink->procesos)."</td>";
		$strTabla = $strTabla."<td>".round($mylink->resultados)."</td>";
			
		//puntos ponderados totales		
		$puntosTotales = 0;
		$puntosTotales = $wpdb->get_var($wpdb->prepare("SELECT sum(puntos*peso) as puntos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_respuestas.id_encuesta = ".$id_encuesta));
		$strTabla = $strTabla."<td>".round($puntosTotales)."</td>";
		
		//media de puntos ponderados por area
		$mylink = $wpdb->get_row("SELECT (estrategia/N.num) AS mediaEst,(personas/N.num) AS mediaPer,(recursos/N.num) AS mediaRec,(procesos/N.num) AS mediaPro,(resultados/N.num) AS mediaRes FROM (SELECT count(*) AS num FROM adeada_encuestas WHERE estado = '1') AS N,(SELECT sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10) AS Est, (SELECT sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20) As Per, (SELECT sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30) AS Rec , (SELECT sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40) AS Pro, (SELECT sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43) AS Res");
		
		//media de puntos ponderados totales
		$puntosMedia = $wpdb->get_var($wpdb->prepare("SELECT (P.puntos/N.num) AS media FROM (SELECT count(*) AS num FROM adeada_encuestas WHERE estado = '1') AS N, (SELECT sum(puntos*peso) as puntos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1') AS P"));		
		
		$strTabla =  "<p>&nbsp;</p><table><tr><th style='background:#ddd'>media</th><th>Estrategia (".round($mylink->mediaEst).")</th><th>Personas (".round($mylink->mediaPer).")</th><th>Recursos (".round($mylink->mediaRec).")</th><th>Procesos (".round($mylink->mediaPro).")</th><th>Resultados (".round($mylink->mediaRes).")</th><th>Total (".round($puntosMedia).")</th></tr><tr>".$strTabla."</tr></table>";
		echo $strTabla;
		

		if ($puntosTotales < 100){
			echo "<blockquote>Su empresa est&aacute; realizando la reflexi&oacute;n estrat&eacute;gica inicial en materia de gesti&oacute;n excelente. Probablemente usted ha descubierto muchos puntos en los que hasta ahora no ha reparado o no los ha tenido en cuenta en la gesti&oacute;n. Tome nota de todas esas cuestiones, analice sus puntos fuertes y sus &aacute;reas de mejora y comience el camino hacia la gesti&oacute;n excelente. Eso le costar&aacute; un esfuerzo y una dedicaci&oacute;n, pero merece la pena.</blockquote>";
		}
		if (($puntosTotales >= 100) && ($puntosTotales < 200)){
			echo "<div class='informe3'><img src='wp-content/plugins/adeada/test/images/bronce.jpg'/><br/>Su empresa ha alcanzado un <strong>Nivel B&aacute;sico: Iniciaci&oacute;n a la Excelencia</strong></div>";
			echo "<blockquote>&iexcl;Enhorabuena! Su empresa tiene las bases para avanzar con firmeza por la senda de la excelencia. Probablemente usted ha descubierto algunos puntos en los que hasta ahora no ha reparado o no los ha tenido en cuenta en la gesti&oacute;n. Analice sus puntos fuertes y sus &aacute;reas de mejora y siga avanzando en su proceso de mejora continua con el objetivo de llegar al Nivel Medio: 'Taller Excelente'. Eso le costar&aacute; un esfuerzo y una dedicaci&oacute;n, pero merece la pena.</blockquote>";
		}
		if (($puntosTotales >= 200) && ($puntosTotales < 300)){
			echo "<div class='informe3'><img src='wp-content/plugins/adeada/test/images/plata.jpg'/><br/>Su empresa ha alcanzado un <strong>Nivel Medio: Taller Excelente</strong></div>";
			echo "<blockquote>&iexcl;Enhorabuena! Su empresa es un 'Taller Excelente'. Aunque no haya utilizado hasta ahora la metodolog&iacute;a EFQM, usted conoce perfectamente las &aacute;reas de gesti&oacute;n de su negocio, dispone de procedimientos y m&eacute;todos de trabajo debidamente documentados y, como consecuencia, ha obtenido resultados positivos econ&oacute;micos, de atenci&oacute;n al cliente y de personas, mantenidos en el tiempo. Las &aacute;reas de mejora le dar&aacute;n la pista para avanzar en el camino de la mejora continua</blockquote>";
		}	
		if ($puntosTotales >= 300){
			echo "<div class='informe3'><img src='wp-content/plugins/adeada/test/images/oro.jpg'/><br/>Su empresa ha alcanzado un <strong>Nivel Superior: Taller Excelente Premium</strong></div>";			
			echo "<blockquote>&iexcl;Enhorabuena! Pocos talleres han alcanzado este nivel. Usted conoce perfectamente perfectamente las &aacute;reas de gesti&oacute;n de su negocio, dispone de procedimientos y m&eacute;todos de trabajo debidamente documentados y, como consecuencia, ha obtenido resultados positivos econ&oacute;micos, de atenci&oacute;n al cliente y de personas, mantenidos en el tiempo. Su pr&oacute;ximo paso ser&iacute;a implantar EFQM en su empresa. </blockquote>";
		}	
   
?>