<?php
/****************************************************************************************************/
/* include: grafico1.php
/* Theme: adeada
/* Descripción: Muestra el gráfico de la comparativa en el tiempo de los cuestionarios de un usuario
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
	if (!(( current_user_can('gestionar_datos') ) && ($pagRes == 0))){
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
		
		$puntosTotales = $wpdb->get_var($wpdb->prepare("SELECT sum(puntos*peso) as puntos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_respuestas.id_encuesta = ".$id_encuesta));
		$puntosMedia = $wpdb->get_var($wpdb->prepare("SELECT (P.puntos/N.num) AS media FROM (SELECT count(*) AS num FROM adeada_encuestas WHERE estado = '1') AS N, (SELECT sum(puntos*peso) as puntos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1') AS P"));
		$puntosArea = $wpdb->get_row("SELECT estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10 GROUP BY adeada_respuestas.id_encuesta) AS Est, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20 GROUP BY adeada_respuestas.id_encuesta) As Per, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30 GROUP BY adeada_respuestas.id_encuesta) AS Rec , (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40 GROUP BY adeada_respuestas.id_encuesta) AS Pro, (SELECT adeada_respuestas.id_encuesta,sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE adeada_respuestas.id_encuesta = ".$id_encuesta." and estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43 GROUP BY adeada_respuestas.id_encuesta) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta");
		$puntosAreaMedia = $wpdb->get_row("SELECT (estrategia/N.num) AS mediaEst,(personas/N.num) AS mediaPer,(recursos/N.num) AS mediaRec,(procesos/N.num) AS mediaPro,(resultados/N.num) AS mediaRes FROM (SELECT count(*) AS num FROM adeada_encuestas WHERE estado = '1') AS N,(SELECT sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10) AS Est, (SELECT sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20) As Per, (SELECT sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30) AS Rec , (SELECT sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40) AS Pro, (SELECT sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43) AS Res");		
		$puntosPreguntas = $wpdb->get_results("SELECT puntos*peso as puntos,adeada_preguntas.id_pregunta FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' and adeada_respuestas.id_encuesta = ".$id_encuesta);
		$puntosPreguntasMedia = $wpdb->get_results("SELECT (sum(puntos*peso)/(SELECT count(*) AS num FROM adeada_encuestas WHERE estado = '1')) AS media,adeada_preguntas.id_pregunta FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE estado = '1' GROUP BY adeada_preguntas.id_pregunta");

        	$dataStr1 = "['puntos',".round($puntosTotales).",".round($puntosMedia)."]";
        		
        	$dataStr2 = "['estrategia',".round($puntosArea->estrategia).",".round($puntosAreaMedia->mediaEst)."],";
        	$dataStr2 = $dataStr2."['personas',".round($puntosArea->personas).",".round($puntosAreaMedia->mediaPer)."],";
        	$dataStr2 = $dataStr2."['recursos',".round($puntosArea->recursos).",".round($puntosAreaMedia->mediaRec)."],";
        	$dataStr2 = $dataStr2."['procesos',".round($puntosArea->procesos).",".round($puntosAreaMedia->mediaPro)."],";
        	$dataStr2 = $dataStr2."['resultados',".round($puntosArea->resultados).",".round($puntosAreaMedia->mediaRes)."]";
        	
        	$cont = 0;
        	foreach ($puntosPreguntas as $pp) {
        		$dataStr3 = $dataStr3."['".($cont+1)."',".round($pp->puntos).",".round($puntosPreguntasMedia[$cont]->media)."],";
        		$cont++;
        	}
        	$dataStr3 = substr($dataStr3, 0, -1);
        	        		
?> 
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		google.load('visualization', '1', {'packages':['corechart']});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'texto');
		  data.addColumn('number', 'resultado');
		  data.addColumn('number', 'media');
		  data.addRows([
		  <?php echo $dataStr1;?>
		  ]);
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_1'));
		  chart.draw(data, {width: 400, height: 170, title: 'tu resultado frente a media del cuestionario', vAxes:[{maxValue:400}]});		  
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'texto');
		  data.addColumn('number', 'resultado');
		  data.addColumn('number', 'media');
		  data.addRows([
		  <?php echo $dataStr2;?>
		  ]);
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_2'));
		  chart.draw(data, {width: 400, height: 170, title: 'tu resultado frente a media por areas', vAxes:[{maxValue:135}]});	
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'texto');
		  data.addColumn('number', 'resultado');
		  data.addColumn('number', 'media');
		  data.addRows([
		  <?php echo $dataStr3;?>
		  ]);
		  var chart = new google.visualization.LineChart(document.getElementById('chart_div_3'));
		  chart.draw(data, {width: 800, height: 170, title:'tu resultado frente a media por preguntas'});		  	  	  	  
		}
		</script>
		<div id="chart_div_1" style="display:table-cell"></div>
		<div id="chart_div_2" style="display:table-cell"></div>
		<div id="chart_div_3"></div>

<?php 
	}
?>