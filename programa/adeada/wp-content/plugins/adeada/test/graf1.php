<?php

		include("pChart2/class/pData.class.php");
		include("pChart2/class/pDraw.class.php");
		include("pChart2/class/pImage.class.php");		
		
		$DataSet = new pData();

		$sql = "SELECT Est.id_usuario,Est.estado,Est.id_encuesta,Est.fec_alta,estrategia,personas,recursos,procesos,resultados FROM (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as estrategia FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 1 and id_pregunta <= 10 group by id_encuesta) AS Est, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as personas FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 11 and id_pregunta <= 20 group by id_encuesta) As Per, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as recursos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 21 and id_pregunta <= 30 group by id_encuesta) AS Rec , (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as procesos FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 31 and id_pregunta <= 40 group by id_encuesta) AS Pro, (SELECT adeada_encuestas.id_usuario,estado,fec_alta,adeada_respuestas.id_encuesta,sum(puntos) as resultados FROM adeada_encuestas INNER JOIN adeada_respuestas ON adeada_encuestas.id_encuesta = adeada_respuestas.id_encuesta WHERE id_usuario = ".get_current_user_id( )." and estado = '1' and id_pregunta >= 41 and id_pregunta <= 43 group by id_encuesta) AS Res WHERE Per.id_encuesta = Est.id_encuesta AND Per.id_encuesta = Rec.id_encuesta AND Per.id_encuesta = Pro.id_encuesta AND Per.id_encuesta = Res.id_encuesta";
        //$sql = "SELECT count(*) as num, encuestador FROM encuestas group by encuestador";
        $resultEncuestas = $wpdb->get_results($sql); 
        $filas = array();
        $columnas = array(6);
        $indexArr = 0;
        if($resultEncuestas){
			foreach ($resultEncuestas as $rEncuestas){
        		$columnas[0] = $rEncuestas->fec_alta;
        		$columnas[1] = $rEncuestas->estrategia;
				$columnas[2] = $rEncuestas->personas;
				$columnas[3] = $rEncuestas->recursos;
				$columnas[4] = $rEncuestas->procesos;
				$columnas[5] = $rEncuestas->resultados;
        		$filas[$indexArr] = $columnas;
        		$indexArr++;
        	}
        }
        
		for ($i=0;$i<$indexArr;$i++){
			$DataSet->addPoints(array($filas[$i][1],$filas[$i][2],$filas[$i][3],$filas[$i][4],$filas[$i][5]),$filas[$i][0]);
			$DataSet->setAxisName(0,"Valores");
		}
		$DataSet->addPoints(array("estrategia","personas","recursos","procesos","resultados"),"Fechas");
		$DataSet->setSerieDescription("Fechas","Fecha");
		$DataSet->setAbscissa("Fechas");		

		
 /* Create the pChart object */
 $myPicture = new pImage(700,230,$DataSet);
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 $myPicture->setFontProperties(array("FontName"=>"wp-content/plugins/adeada/test/pChart2/fonts/pf_arma_five.ttf","FontSize"=>6));

 /* Draw the scale  */
 $myPicture->setGraphArea(50,30,680,200);
 $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart($settings);

 /* Write the chart legend */
 $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
 
  $myPicture->Render("holas.png");
		
?> 
<img src='holas.png'>
