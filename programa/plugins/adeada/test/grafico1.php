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
		//$sql = "SELECT Est.id_usuario,Est.estado,Est.id_encuesta,Est.fec_alta,estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 1 and id_pregunta <= 10 group by id_encuesta) AS Est, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 11 and id_pregunta <= 20 group by id_encuesta) As Per, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 21 and id_pregunta <= 30 group by id_encuesta) AS Rec , (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 31 and id_pregunta <= 40 group by id_encuesta) AS Pro, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 41 and id_pregunta <= 43 group by id_encuesta) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta";
		$sql = "SELECT Est.id_usuario,Est.estado,Est.id_encuesta,Est.fec_alta,estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_encuestas.id_usuario,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and adeada_preguntas.id_pregunta >= 1 and adeada_preguntas.id_pregunta <= 10 group by id_encuesta) AS Est, (SELECT adeada_encuestas.id_usuario,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and adeada_preguntas.id_pregunta >= 11 and adeada_preguntas.id_pregunta <= 20 group by id_encuesta) As Per, (SELECT adeada_encuestas.id_usuario,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and adeada_preguntas.id_pregunta >= 21 and adeada_preguntas.id_pregunta <= 30 group by id_encuesta) AS Rec , (SELECT adeada_encuestas.id_usuario,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and adeada_preguntas.id_pregunta >= 31 and adeada_preguntas.id_pregunta <= 40 group by id_encuesta) AS Pro, (SELECT adeada_encuestas.id_usuario,estado,DATE_FORMAT(fec_alta, '%d-%m-%Y') as fec_alta,adeada_respuestas.id_encuesta,sum(puntos*peso) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta INNER JOIN adeada_preguntas ON adeada_respuestas.id_pregunta = adeada_preguntas.id_pregunta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and adeada_preguntas.id_pregunta >= 41 and adeada_preguntas.id_pregunta <= 43 group by id_encuesta) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta";
        $resultEncuestas = $wpdb->get_results($sql); 
        $filas = array();
        $columnas = array(6);
        $indexArr = 0;
        if($resultEncuestas){
			foreach ($resultEncuestas as $rEncuestas){
        		$columnas[0] = $rEncuestas->fec_alta;
        		$columnas[1] = round($rEncuestas->estrategia);
				$columnas[2] = round($rEncuestas->personas);
				$columnas[3] = round($rEncuestas->recursos);
				$columnas[4] = round($rEncuestas->procesos);
				$columnas[5] = round($rEncuestas->resultados);
        		$filas[$indexArr] = $columnas;
        		$indexArr++;
        	}
        }
        $dataStr = "";
        for ($i=0;$i<$indexArr;$i++){
        		$dataStr = $dataStr."['".$filas[$i][0]."',".$filas[$i][1].",".$filas[$i][2].",".$filas[$i][3].",".$filas[$i][4].",".$filas[$i][5]."],";
        }		
		$dataStr = substr($dataStr, 0, -1);
?> 
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		google.load('visualization', '1', {'packages':['corechart']});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'fec_alta');
		  data.addColumn('number', 'estrategia');
		  data.addColumn('number', 'personas');
		  data.addColumn('number', 'recursos');
		  data.addColumn('number', 'procesos');
		  data.addColumn('number', 'resultados');
		  data.addRows([<?php echo $dataStr;?>]);
		  <?php if ($indexArr < 2){?>
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		  <?php }else{?>
		  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		  <?php } ?>
		  chart.draw(data, {width: 800, height: 170});
		}
		</script>
		<div id="chart_div"></div>

<?php 
	}
?>