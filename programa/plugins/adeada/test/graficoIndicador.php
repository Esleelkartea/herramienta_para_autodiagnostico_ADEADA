<?php
/****************************************************************************************************/
/* include: graficoIndicador.php
/* Theme: adeada
/* Descripción: Muestra el gráfico de la comparativa respecto a la media de los indicadores de un usuario
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
		$id_usuario = get_current_user_id( );		
		

		$mediaIndicadores = $wpdb->get_results("SELECT ventas*100/media.mediaVentas AS ventas, facturas*100/media.mediaFacturas AS facturas, costes*100/media.mediaCostes AS costes, satisfaccion_clientes*100/media.mediaSatisfaccion_clientes AS satisfaccion_clientes, clientes*100/media.mediaClientes AS clientes, quejas*100/media.mediaQuejas AS quejas, satisfaccion_personal*100/media.mediaSatisfaccion_personal AS satisfaccion_personal, sugerencias*100/media.mediaSugerencias AS sugerencias, absentismo*100/media.mediaAbsentismo AS absentismo, rotacion*100/media.mediaRotacion AS rotacion FROM (SELECT sum(ventas)/count(ventas) as mediaVentas, sum(facturas)/count(facturas) as mediaFacturas, sum(costes)/count(costes) as mediaCostes, sum(satisfaccion_clientes)/count(satisfaccion_clientes) as mediaSatisfaccion_clientes, sum(clientes)/count(clientes) as mediaClientes, sum(quejas)/count(quejas) as mediaQuejas, sum(satisfaccion_personal)/count(satisfaccion_personal) as mediaSatisfaccion_personal, sum(sugerencias)/count(sugerencias) as mediaSugerencias, sum(absentismo)/count(absentismo) as mediaAbsentismo, sum(rotacion)/count(rotacion) as mediaRotacion FROM adeada_indicadores) AS media,adeada_indicadores WHERE id_usuario = ".$id_usuario);

		$dataStr1 = "['ventas',".round($mediaIndicadores[0]->ventas,2)."],";
		$dataStr1 = $dataStr1."['facturas',".round($mediaIndicadores[0]->facturas,2)."],";
		$dataStr1 = $dataStr1."['costes',".round($mediaIndicadores[0]->costes,2)."],";
		$dataStr1 = $dataStr1."['satisfaccion_clientes',".round($mediaIndicadores[0]->satisfaccion_clientes,2)."],";
		$dataStr1 = $dataStr1."['clientes',".round($mediaIndicadores[0]->clientes,2)."],";
		$dataStr1 = $dataStr1."['quejas',".round($mediaIndicadores[0]->quejas,2)."],";
		$dataStr1 = $dataStr1."['satisfaccion_personal',".round($mediaIndicadores[0]->satisfaccion_personal,2)."],";
		$dataStr1 = $dataStr1."['sugerencias',".round($mediaIndicadores[0]->sugerencias,2)."],";
		$dataStr1 = $dataStr1."['absentismo',".round($mediaIndicadores[0]->absentismo,2)."],";
		$dataStr1 = $dataStr1."['rotacion',".round($mediaIndicadores[0]->rotacion,2)."]";
        	
		//echo $dataStr1;
        	        		
?> 
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		google.load('visualization', '1', {'packages':['corechart']});
		google.setOnLoadCallback(drawChart);
		function drawChart() {
		  var data = new google.visualization.DataTable();
		  data.addColumn('string', 'texto');
		  data.addColumn('number', 'resultado');
		  data.addRows([
		  <?php echo $dataStr1;?>
		  ]);
		  var formatter = new google.visualization.NumberFormat({suffix: '%'});
		  formatter.format(data, 1);		    
		  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_1'));
		  chart.draw(data, {width: 800, height: 270, title: 'tu resultado frente a la media'});		  	  	  	  
		}
		</script>
		<div id="chart_div_1" style="display:table-cell"></div>

<?php 
	}
?>