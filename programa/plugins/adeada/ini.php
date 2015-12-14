<?php
/*
Plugin Name: plugin_adeada
Plugin URI: http://www.orbere.com
Description: comentario
Author: Alberto Valdeolmillos
Version: 1.0
Author URI: http://www.orbere.com
*/

function adeada_saludo() {
	echo "Hola buenas_ 44445";
}

function adeada_instala(){
	//include('_instalarRoles.php');
	global $wpdb;
	$sql = "alter table wp_users ENGINE=innoDB;";
	$wpdb->query($sql);	
	
	$sql = "
CREATE TABLE IF NOT EXISTS `adeada_indicadores` (
  `id_indicador` mediumint(8) unsigned NOT NULL auto_increment,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `ventas` float DEFAULT NULL,
  `facturas` mediumint(8) unsigned DEFAULT NULL, 
  `costes` float DEFAULT NULL,
  `satisfaccion_clientes` mediumint(8) unsigned DEFAULT NULL,
  `clientes` mediumint(8) unsigned DEFAULT NULL,
  `quejas` mediumint(8) unsigned DEFAULT NULL,
  `satisfaccion_personal` mediumint(8) unsigned DEFAULT NULL,
  `sugerencias` mediumint(8) unsigned DEFAULT NULL, 
  `absentismo` mediumint(8) unsigned DEFAULT NULL,
  `rotacion` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY  (`id_indicador`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	
	$sql = "
ALTER TABLE `adeada_indicadores`
  ADD CONSTRAINT `adeada_indicadores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `wp_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
    ";
	$wpdb->query($sql);		
	
	$sql = "
CREATE TABLE IF NOT EXISTS `adeada_encuestas` (
  `id_encuesta` mediumint(8) unsigned NOT NULL auto_increment,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `concepto` enum('0','1') NOT NULL default '0',
  `estado` enum('0','1','2') NOT NULL default '0',
  `fec_alta` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `fec_mod` timestamp,
  PRIMARY KEY  (`id_encuesta`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	
	$sql = "
ALTER TABLE `adeada_encuestas`
  ADD CONSTRAINT `adeada_encuestas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `wp_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
    ";
	$wpdb->query($sql);	
	$sql = "  
CREATE TABLE IF NOT EXISTS `adeada_areas` (
  `id_area` mediumint(8) unsigned NOT NULL auto_increment,
  `nombre` varchar(40) default NULL,
  `concepto` enum('0','1') NOT NULL default '0',
  `orden` mediumint(8) unsigned default '0',  
  `descripcion` text,
  PRIMARY KEY  (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	
	
	$sql = " 	
INSERT INTO `adeada_areas` (`id_area`, `nombre`, `concepto`, `orden`, `descripcion`) VALUES
(1, 'estrategia_fase1', '0', 0, 'area de estrategia'),
(2, 'estrategia_fase2', '0', 0, 'area de estrategia'),
(3, 'personas_fase1', '0', 0, 'area de personas'),
(4, 'personas_fase2', '0', 0, 'area de personas'),
(5, 'recursos_fase1', '0', 0, 'area de recursos'),
(6, 'recursos_fase2', '0', 0, 'area de recursos'),
(7, 'procesos_fase1', '0', 0, 'area de procesos'),
(8, 'procesos_fase2', '0', 0, 'area de procesos'),
(9, 'resultados', '0', 0, 'area de resultados');
    ";
	$wpdb->query($sql);	
	
	$sql = "
CREATE TABLE IF NOT EXISTS `adeada_preguntas` (
  `id_pregunta` mediumint(8) unsigned NOT NULL auto_increment,
  `id_area` mediumint(8) unsigned NOT NULL,
  `id_indicador` mediumint(8) unsigned default NULL,
  `indicador` enum('global','area','pregunta') default NULL,
  `tipo` varchar(40) default NULL,
  `pregunta` text,
  `descripcion` text,
  `opciones` enum('sino_2/6','sino_2/10','porcent','0_10') default NULL,
  `peso` float NOT NULL,
  PRIMARY KEY  (`id_pregunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	

	$sql = "
ALTER TABLE `adeada_preguntas`
  ADD CONSTRAINT `adeada_preguntas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `adeada_areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adeada_preguntas_ibfk_2` FOREIGN KEY (`id_indicador`) REFERENCES `adeada_preguntas` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;  
    ";
    	$wpdb->query($sql);
    	
	$sql = " 		
INSERT INTO `adeada_preguntas` (`id_area`, `id_indicador`, `indicador`, `tipo`, `pregunta`, `descripcion`, `opciones`, `peso`) VALUES
(1,NULL,NULL,NULL,'�Tiene identificados los grupos de inter�s de su empresa?','Se entiende por grupos de inter�s todas aquellas personas y entidades vinculadas a la empresa o que influyen en ella, como pueden ser los clientes, los empleados, los proveedores, la competencia, etc�tera.','0_10',2.2),
(1,NULL,NULL,NULL,'�Ha definido la misi�n de su empresa?','Define el negocio al que se dedica la organizaci�n, las necesidades que cubren con sus productos y servicios, el mercado en el cual se desarrolla la empresa y la imagen p�blica de la empresa u organizaci�n. La misi�n de la empresa es la respuesta a la pregunta: �Para qu� existe la empresa?','0_10',2.2),
(1,NULL,NULL,NULL,'�Y la visi�n a medio y largo plazo?','Define y describe la situaci�n futura que desea tener la empresa. El prop�sito de la visi�n es guiar, controlar y alentar a la empresa en su conjunto para alcanzar el estado deseable a medio y largo plazo. Responde a la pregunta: �C�mo queremos que sea la empresa en los pr�ximos a�os?','0_10',2.2),
(1,NULL,NULL,NULL,'�Ha identificado los valores que identifican a su empresa?','Definen el conjunto de principios, creencias, reglas que regulan la gesti�n de la empresa.','0_10',2.2),
(1,NULL,NULL,NULL,'�Ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas?',' ','0_10',2.2),
(2,NULL,NULL,NULL,'�Conoce las expectativas de tienen los grupos de inter�s de su empresa?',' ','0_10',2.2),
(2,NULL,NULL,NULL,'�Analiza el comportamiento de la competencia?',' ','0_10',2.2),
(2,NULL,NULL,NULL,'�Tiene definidas sus l�neas estrat�gicas?','Principales l�neas de actuaci�n que surgen tras el an�lisis de fortalezas, debilidades, amenazas y oportunidades. Deben tener objetivos identificados.','0_10',2.2),
(2,NULL,NULL,NULL,'�Sus l�neas estrat�gicas se desarrollan en Planes Operativos con objetivos anuales?','Concretan las acciones precisas para desarrollar las l�neas estrat�gicas de la empresa. Deben tener objetivos anuales concretos','0_10',2.2),
(2,NULL,NULL,NULL,'�Realiza habitualmente acciones de b�squeda de nuevos mercados?',' ','0_10',2.2),
(3,NULL,NULL,NULL,'�Conoce cu�les son las necesidades de personal a lo largo de todo el a�o?',' ','0_10',2.2),
(3,NULL,NULL,NULL,'�Tiene realizada una descripci�n de puestos de trabajo en la que se indiquen funciones y responsabilidades de cada uno?',' ','0_10',2.2),
(3,NULL,NULL,NULL,'�Ha elaborado un procedimiento sistem�tico para la selecci�n del personal?',' ','0_10',2.2),
(3,NULL,NULL,NULL,'�Tiene establecido un Plan de Acogida para integrar al nuevo personal?','Documento donde se recoge lo que es la empresa, su actividad, su planteamiento estrat�gico, su organigrama y dem�s informaci�n que sirve para que un nuevo empleado conozca c�mo funciona la empresa y pueda integrarse con facilidad.','0_10',2.2),
(3,NULL,NULL,NULL,'�Dispone de Planes de Seguridad y Salud Laboral?',' ','0_10',2.2),
(4,NULL,NULL,NULL,'�Tiene definido un Plan de Formaci�n basado en una previa detecci�n de necesidades?',' ','0_10',2.2),
(4,NULL,NULL,NULL,'�Se ha establecido un m�todo de evaluaci�n del desempe�o del personal?','Mecanismos y t�cnicas que sirven para medir si el trabajo de una persona en su puesto de trabajo es mediocre, regular o excelente.','0_10',2.2),
(4,NULL,NULL,NULL,'�Hay medidas definidas para el reconocimiento y la promoci�n de las personas?',' ','0_10',2.2),
(4,NULL,NULL,NULL,'�Se mide de forma sistem�tica y peri�dica la satisfacci�n del personal?',' ','0_10',2.2),
(4,NULL,NULL,NULL,'�Ha establecido medidas de conciliaci�n de la vida laboral y familiar?',' ','0_10',2.2),
(5,NULL,NULL,NULL,'�Dispone de un Cuadro de Previsi�n de Tesorer�a mes a mes?',' ','0_10',2.2),
(5,NULL,NULL,NULL,'�Utiliza indicadores para conocer la salud financiera de su negocio?',' ','0_10',2.2),
(5,NULL,NULL,NULL,'�Dispone de un sistema para evaluar la productividad de las inversiones?',' ','0_10',2.2),
(5,NULL,NULL,NULL,'�Controla el resultado econ�mico que le producen sus proveedores?',' ','0_10',2.2),
(5,NULL,NULL,NULL,'�Dispone de un procedimiento de compras?',' ','0_10',2.2),
(6,NULL,NULL,NULL,'�Conoce los stocks m�ximos y m�nimos que debe tener almacenados?',' ','0_10',2.2),
(6,NULL,NULL,NULL,'�Dispone de un sistema inform�tico que le permite tener informaci�n suficiente para tomar decisiones de gesti�n?',' ','0_10',2.2),
(6,NULL,NULL,NULL,'�Tiene establecido un sistema de amortizaci�n de sus equipos?',' ','0_10',2.2),
(6,NULL,NULL,NULL,'�Es capaz de mantener el taller limpio, bien equipado y en orden?',' ','0_10',2.2),
(6,NULL,NULL,NULL,'�Realiza gesti�n mediambiental de sus res�duos?',' ','0_10',2.2),
(7,NULL,NULL,NULL,'�Dispone de un Mapa de Procesos?','Es un gr�fico donde se recogen los procesos que se dan en la empresa y las interrelaciones entre ellos.','0_10',2.2),
(7,NULL,NULL,NULL,'�Est�n establecidos los canales de comunicaci�n dentro de la empresa?','Qui�n debe informar de qu� a qui�n dentro de la empresa para que se lleven a cabo los procesos de forma efectiva.','0_10',2.2),
(7,NULL,NULL,NULL,'�Tiene bases de datos de sus clientes actuales y potenciales?',' ','0_10',2.2),
(7,NULL,NULL,NULL,'�Cumple los preceptos de la Ley Org�nica de Protecci�n de Datos (LOPD)?',' ','0_10',2.2),
(7,NULL,NULL,NULL,'�Tiene elaborado un Plan de Comunicaci�n?','Documento donde se recogen las inversiones que se van a realizar a lo largo del a�o en publicidad y comunicaci�n con el cliente en los diversos medios posibles.','0_10',2.2),
(8,NULL,NULL,NULL,'�Dise�a nuevos servicios para sus clientes?',' ','0_10',2.2),
(8,NULL,NULL,NULL,'�Tiene establecido un protocolo de atenci�n al cliente?','Procedimiento dise�ado para saber c�mo actuar en la mayor parte de los casos posibles de relaci�n con el cliente, buscando siempre su m�xima satisfacci�n.','0_10',2.2),
(8,NULL,NULL,NULL,'�Informa al cliente de las condiciones de contrataci�n: horarios, precios, medios de pago, garant�as�?',' ','0_10',2.2),
(8,NULL,NULL,NULL,'�Tiene una encuesta de satisfacci�n del cliente y analiza sus respuestas?',' ','0_10',2.2),
(8,NULL,NULL,NULL,'�Ofrece un servicio post-venta?',' ','0_10',2.2),
(9,NULL,NULL,NULL,'�Ha obtenido resultados satisfactorios en los indicadores de gesti�n del negocio en los �ltimos tres a�os?',' ','0_10',2.2),
(9,NULL,NULL,NULL,'�Ha obtenido resultados satisfactorios en los indicadores de satisfacci�n de sus clientes en los �ltimos tres a�os?',' ','0_10',2.2),
(9,NULL,NULL,NULL,'�Ha obtenido resultados satisfactorios en los indicadores de satisfacci�n de sus empleados en los �ltimos tres a�os?',' ','0_10',2.2);
    ";
	$wpdb->query(utf8_encode($sql));	
	
    	
	
/*	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 1, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene identificados los grupos de inter�s de su empresa?'), 'descripcion' => utf8_encode('Se entiende por grupos de inter�s todas aquellas personas y entidades vinculadas a la empresa o que influyen en ella, como pueden ser los clientes, los empleados, los proveedores, la competencia, etc�tera.'),'opciones' => '0_10','peso' => 2.2 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );		
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 1, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha definido la misi�n de su empresa?'), 'descripcion' => utf8_encode('Define el negocio al que se dedica la organizaci�n, las necesidades que cubren con sus productos y servicios, el mercado en el cual se desarrolla la empresa y la imagen p�blica de la empresa u organizaci�n. La misi�n de la empresa es la respuesta a la pregunta: �Para qu� existe la empresa?'),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 1, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Y la visi�n a medio y largo plazo?'), 'descripcion' => utf8_encode('Define y describe la situaci�n futura que desea tener la empresa. El prop�sito de la visi�n es guiar, controlar y alentar a la empresa en su conjunto para alcanzar el estado deseable a medio y largo plazo. Responde a la pregunta: �C�mo queremos que sea la empresa en los pr�ximos a�os?'),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 1, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha identificado los valores que identifican a su empresa?'), 'descripcion' => utf8_encode('Definen el conjunto de principios, creencias, reglas que regulan la gesti�n de la empresa.'),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 1, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 2, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Conoce las expectativas de tienen los grupos de inter�s de su empresa?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 2, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Analiza el comportamiento de la competencia?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.367 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 2, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene definidas sus l�neas estrat�gicas?'), 'descripcion' => utf8_encode('Principales l�neas de actuaci�n que surgen tras el an�lisis de fortalezas, debilidades, amenazas y oportunidades. Deben tener objetivos identificados.'),'opciones' => '0_10','peso' => 0.734 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 2, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Sus l�neas estrat�gicas se desarrollan en Planes Operativos con objetivos anuales?'), 'descripcion' => utf8_encode('Concretan las acciones precisas para desarrollar las l�neas estrat�gicas de la empresa. Deben tener objetivos anuales concretos'),'opciones' => '0_10','peso' => 0.734 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 2, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Realiza habitualmente acciones de b�squeda de nuevos mercados?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 3, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Conoce cu�les son las necesidades de personal a lo largo de todo el a�o?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 3, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene realizada una descripci�n de puestos de trabajo en la que se indiquen funciones y responsabilidades de cada uno?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 3, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha elaborado un procedimiento sistem�tico para la selecci�n del personal?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 3, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene establecido un Plan de Acogida para integrar al nuevo personal?'), 'descripcion' => utf8_encode('Documento donde se recoge lo que es la empresa, su actividad, su planteamiento estrat�gico, su organigrama y dem�s informaci�n que sirve para que un nuevo empleado conozca c�mo funciona la empresa y pueda integrarse con facilidad.'),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 3, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de Planes de Seguridad y Salud Laboral?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 1.1 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 4, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene definido un Plan de Formaci�n basado en una previa detecci�n de necesidades?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 1.1 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 4, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Se ha establecido un m�todo de evaluaci�n del desempe�o del personal?'), 'descripcion' => utf8_encode('Mecanismos y t�cnicas que sirven para medir si el trabajo de una persona en su puesto de trabajo es mediocre, regular o excelente.'),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 4, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Hay medidas definidas para el reconocimiento y la promoci�n de las personas?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 4, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Se mide de forma sistem�tica y peri�dica la satisfacci�n del personal?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 4, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha establecido medidas de conciliaci�n de la vida laboral y familiar?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 5, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de un Cuadro de Previsi�n de Tesorer�a mes a mes?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 5, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Utiliza indicadores para conocer la salud financiera de su negocio?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 5, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de un sistema para evaluar la productividad de las inversiones?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 5, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Controla el resultado econ�mico que le producen sus proveedores?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 5, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de un procedimiento de compras?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 6, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Conoce los stocks m�ximos y m�nimos que debe tener almacenados?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.734  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 6, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de un sistema inform�tico que le permite tener informaci�n suficiente para tomar decisiones de gesti�n?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 6, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene establecido un sistema de amortizaci�n de sus equipos?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 6, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Es capaz de mantener el taller limpio, bien equipado y en orden?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 6, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Realiza gesti�n mediambiental de sus res�duos?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55  ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 7, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dispone de un Mapa de Procesos?'), 'descripcion' => utf8_encode('Es un gr�fico donde se recogen los procesos que se dan en la empresa y las interrelaciones entre ellos.'),'opciones' => '0_10','peso' => 1.1 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 7, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Est�n establecidos los canales de comunicaci�n dentro de la empresa?'), 'descripcion' => utf8_encode('Qui�n debe informar de qu� a qui�n dentro de la empresa para que se lleven a cabo los procesos de forma efectiva.'),'opciones' => '0_10','peso' => 1.1 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 7, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene bases de datos de sus clientes actuales y potenciales?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 7, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Cumple los preceptos de la Ley Org�nica de Protecci�n de Datos (LOPD)?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 7, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene elaborado un Plan de Comunicaci�n?'), 'descripcion' => utf8_encode('Documento donde se recogen las inversiones que se van a realizar a lo largo del a�o en publicidad y comunicaci�n con el cliente en los diversos medios posibles.'),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 8, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Dise�a nuevos servicios para sus clientes?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 8, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene establecido un protocolo de atenci�n al cliente?'), 'descripcion' => utf8_encode('Procedimiento dise�ado para saber c�mo actuar en la mayor parte de los casos posibles de relaci�n con el cliente, buscando siempre su m�xima satisfacci�n.'),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 8, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Informa al cliente de las condiciones de contrataci�n: horarios, precios, medios de pago, garant�as�?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 8, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Tiene una encuesta de satisfacci�n del cliente y analiza sus respuestas?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 8, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ofrece un servicio post-venta?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 0.55 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 9, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha obtenido resultados satisfactorios en los indicadores de gesti�n del negocio en los �ltimos tres a�os?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 4.5 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 9, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha obtenido resultados satisfactorios en los indicadores de satisfacci�n de sus clientes en los �ltimos tres a�os?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 4.5 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );
	$wpdb->insert( 'adeada_preguntas', array( 'id_area' => 9, 'id_indicador' => 0, 'indicador' => NULL, 'tipo' => NULL, 'pregunta' => utf8_encode('�Ha obtenido resultados satisfactorios en los indicadores de satisfacci�n de sus empleados en los �ltimos tres a�os?'), 'descripcion' => utf8_encode(' '),'opciones' => '0_10','peso' => 4.5 ), array( '%d', '%d', '%s','%s','%s', '%s', '%s', '%f' ) );	
*/
		
	$sql = "  
CREATE TABLE IF NOT EXISTS `adeada_respuestas` (
  `id_respuesta` mediumint(8) unsigned NOT NULL auto_increment,
  `id_pregunta` mediumint(8) unsigned NOT NULL,
  `id_encuesta` mediumint(8) unsigned NOT NULL,
  `fec_mod` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `puntos` mediumint(8) unsigned DEFAULT NULL,
  `respuesta` varchar(40) default NULL,
  PRIMARY KEY  (`id_respuesta`),
  KEY `id_pregunta` (`id_pregunta`),
  KEY `id_encuesta` (`id_encuesta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	
	$sql = "
ALTER TABLE `adeada_respuestas`
  ADD CONSTRAINT `adeada_respuestas_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `adeada_preguntas` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adeada_respuestas_ibfk_2` FOREIGN KEY (`id_encuesta`) REFERENCES `adeada_encuestas` (`id_encuesta`) ON DELETE CASCADE ON UPDATE CASCADE;  
    ";
	$wpdb->query($sql);	
	
	$sql = "  
CREATE TABLE IF NOT EXISTS `adeada_resultados` (
  `id_resultado` mediumint(8) unsigned NOT NULL auto_increment,
  `id_pregunta` mediumint(8) unsigned NOT NULL,
  `puntos` mediumint(8) unsigned DEFAULT NULL, 
  `resultado` text,
  PRIMARY KEY  (`id_resultado`),
  KEY `id_pregunta` (`id_pregunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
	$wpdb->query($sql);	
	$sql = "
ALTER TABLE `adeada_resultados`
  ADD CONSTRAINT `adeada_resultados_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `adeada_preguntas` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;
    ";
	$wpdb->query($sql);		
	
	$sql = " 	
INSERT INTO `adeada_resultados` (`id_pregunta`, `puntos`, `resultado`) VALUES
(1, 0, 'La empresa no tiene identificados sus grupos de inter�s'),
(1, 1, 'La empresa tiene identificados sus grupos de inter�s de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(1, 2, 'La empresa tiene identificados sus grupos de inter�s de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(1, 3, 'La empresa tiene identificados sus grupos de inter�s de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(1, 4, 'La empresa tiene identificados sus grupos de inter�s de forma documentada, pero no es una acci�n revisada ni mejorada'),
(1, 5, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(1, 6, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(1, 7, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(1, 8, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(1, 9, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(1, 10, 'La empresa tiene debidamente identificados sus grupos de inter�s'),
(2, 0, 'La empresa no tiene definida su misi�n'),
(2, 1, 'La empresa tiene definida su misi�n de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(2, 2, 'La empresa tiene definida su misi�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(2, 3, 'La empresa tiene definida su misi�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(2, 4, 'La empresa tiene definida su misi�n de forma documentada, pero no es una acci�n revisada ni mejorada'),
(2, 5, 'Se ha definido la misi�n de la empresa'),
(2, 6, 'Se ha definido la misi�n de la empresa'),
(2, 7, 'Se ha definido la misi�n de la empresa'),
(2, 8, 'Se ha definido la misi�n de la empresa'),
(2, 9, 'Se ha definido la misi�n de la empresa'),
(2, 10, 'Se ha definido la misi�n de la empresa'),
(3, 0, 'La empresa no tiene definida su visi�n a medio y largo plazo'),
(3, 1, 'La empresa tiene definida su visi�n a medio y largo plazo de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(3, 2, 'La empresa tiene definida su visi�n a medio y largo plazo de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(3, 3, 'La empresa tiene definida su visi�n a medio y largo plazo de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(3, 4, 'La empresa tiene definida su visi�n a medio y largo plazo de forma documentada, pero no es una acci�n revisada ni mejorada'),
(3, 5, 'Se ha definido su visi�n a medio y largo plazo'),
(3, 6, 'Se ha definido su visi�n a medio y largo plazo'),
(3, 7, 'Se ha definido su visi�n a medio y largo plazo'),
(3, 8, 'Se ha definido su visi�n a medio y largo plazo'),
(3, 9, 'Se ha definido su visi�n a medio y largo plazo'),
(3, 10, 'Se ha definido su visi�n a medio y largo plazo'),
(4, 0, 'La empresa no tiene definidos sus valores'),
(4, 1, 'La empresa tiene definidos sus valores de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(4, 2, 'La empresa tiene definidos sus valores a medio y largo plazo de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(4, 3, 'La empresa tiene definidos sus valores a medio y largo plazo de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(4, 4, 'La empresa tiene definida su definidos sus valores de forma documentada, pero no es una acci�n revisada ni mejorada'),
(4, 5, 'Se han definido los valores que identifican a la empresa'),
(4, 6, 'Se han definido los valores que identifican a la empresa'),
(4, 7, 'Se han definido los valores que identifican a la empresa'),
(4, 8, 'Se han definido los valores que identifican a la empresa'),
(4, 9, 'Se han definido los valores que identifican a la empresa'),
(4, 10, 'Se han definido los valores que identifican a la empresa'),
(5, 0, 'La empresa no ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 1, 'La empresa ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(5, 2, 'La empresa ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(5, 3, 'La empresa ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(5, 4, 'La empresa ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas de forma documentada, pero no es una acci�n revisada ni mejorada'),
(5, 5, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 6, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 7, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 8, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 9, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(5, 10, 'Se ha realizado el an�lisis de fortalezas, debilidades, oportunidades y amenazas'),
(6, 0, 'La empresa no conoce las expectativas de sus grupos de inter�s'),
(6, 1, 'La empresa conoce las expectativas de sus grupos de inter�s de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(6, 2, 'La empresa conoce las expectativas de sus grupos de inter�s de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(6, 3, 'La empresa conoce las expectativas de sus grupos de inter�s de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(6, 4, 'La empresa conoce las expectativas de sus grupos de inter�s de forma documentada, pero no es una acci�n revisada ni mejorada'),
(6, 5, 'Conoce las expectativas de sus grupos de inter�s'),
(6, 6, 'Conoce las expectativas de sus grupos de inter�s'),
(6, 7, 'Conoce las expectativas de sus grupos de inter�s'),
(6, 8, 'Conoce las expectativas de sus grupos de inter�s'),
(6, 9, 'Conoce las expectativas de sus grupos de inter�s'),
(6, 10, 'Conoce las expectativas de sus grupos de inter�s'),
(7, 0, 'La empresa no analiza el comportamiento de la competencia'),
(7, 1, 'La empresa analiza el comportamiento de la competencia de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(7, 2, 'La empresa analiza el comportamiento de la competencia de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(7, 3, 'La empresa analiza el comportamiento de la competencia de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(7, 4, 'La empresa analiza el comportamiento de la competencia de forma documentada, pero no es una acci�n revisada ni mejorada'),
(7, 5, 'Analiza habitualmente el comportamiento de su competencia'),
(7, 6, 'Analiza habitualmente el comportamiento de su competencia'),
(7, 7, 'Analiza habitualmente el comportamiento de su competencia'),
(7, 8, 'Analiza habitualmente el comportamiento de su competencia'),
(7, 9, 'Analiza habitualmente el comportamiento de su competencia'),
(7, 10, 'Analiza habitualmente el comportamiento de su competencia'),
(8, 0, 'La empresa no tiene definidas sus l�neas estrat�gicas'),
(8, 1, 'La empresa tiene definidas sus l�neas estrat�gicas de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(8, 2, 'La empresa tiene definidas sus l�neas estrat�gicas de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(8, 3, 'La empresa tiene definidas sus l�neas estrat�gicas de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(8, 4, 'La empresa tiene definidas sus l�neas estrat�gicas de forma documentada, pero no es una acci�n revisada ni mejorada'),
(8, 5, 'Ha definido correctamente sus l�neas estrat�gicas'),
(8, 6, 'Ha definido correctamente sus l�neas estrat�gicas'),
(8, 7, 'Ha definido correctamente sus l�neas estrat�gicas'),
(8, 8, 'Ha definido correctamente sus l�neas estrat�gicas'),
(8, 9, 'Ha definido correctamente sus l�neas estrat�gicas'),
(8, 10, 'Ha definido correctamente sus l�neas estrat�gicas'),
(9, 0, 'La empresa no dispone de Planes Operativos'),
(9, 1, 'La empresa dispone de Planes Operativos que abordan algunas �reas de la empresa, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(9, 2, 'La empresa dispone de Planes Operativos que abordan la mayor�a de las �reas de la empresa de forma sistem�tica, pero no es una acci�n debidamente documentada, revisada ni mejorada'),
(9, 3, 'La empresa dispone de Planes Operativos que abordan la mayor�a de las �reas de la empresa de forma sistem�tica, pero no es una acci�n debidamente documentada, revisada ni mejorada'),
(9, 4, 'La empresa dispone de Planes Operativos que abordan la mayor�a de las �reas de la empresa de forma documentada, pero no es una acci�n revisada ni mejorada'),
(9, 5, 'Tiene planes operativos con objetivos anuales'),
(9, 6, 'Tiene planes operativos con objetivos anuales'),
(9, 7, 'Tiene planes operativos con objetivos anuales'),
(9, 8, 'Tiene planes operativos con objetivos anuales'),
(9, 9, 'Tiene planes operativos con objetivos anuales'),
(9, 10, 'Tiene planes operativos con objetivos anuales'),
(10, 0, 'La empresa no busca habitualmente nuevos mercados'),
(10, 1, 'La empresa busca nuevos mercados de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(10, 2, 'La empresa busca nuevos mercados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(10, 3, 'La empresa busca nuevos mercados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(10, 4, 'La empresa busca nuevos mercados de forma documentada, pero no es una acci�n revisada ni mejorada'),
(10, 5, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(10, 6, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(10, 7, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(10, 8, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(10, 9, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(10, 10, 'Habitualmente realiza acciones para buscar nuevos mercados'),
(11, 0, 'La empresa desconoce sus necesidades de personal a lo largo del a�o'),
(11, 1, 'La empresa conoce sus necesidades de personal de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(11, 2, 'La empresa conoce sus necesidades de personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(11, 3, 'La empresa conoce sus necesidades de personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(11, 4, 'La empresa conoce sus necesidades de personal de forma documentada, pero no es una acci�n revisada ni mejorada'),
(11, 5, 'Conoce sus necesidades de personal a lo largo del a�o'),
(11, 6, 'Conoce sus necesidades de personal a lo largo del a�o'),
(11, 7, 'Conoce sus necesidades de personal a lo largo del a�o'),
(11, 8, 'Conoce sus necesidades de personal a lo largo del a�o'),
(11, 9, 'Conoce sus necesidades de personal a lo largo del a�o'),
(11, 10, 'Conoce sus necesidades de personal a lo largo del a�o'),
(12, 0, 'La empresa no tiene delimitadas las funciones y responsabilidades de cada trabajador'),
(12, 1, 'La empresa tiene delimitadas las funciones y responsabilidades de cada trabajador de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(12, 2, 'La empresa tiene delimitadas las funciones y responsabilidades de cada trabajador de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(12, 3, 'La empresa tiene delimitadas las funciones y responsabilidades de cada trabajador de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(12, 4, 'La empresa tiene delimitadas las funciones y responsabilidades de cada trabajador de forma documentada, pero no es una acci�n revisada ni mejorada'),
(12, 5, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(12, 6, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(12, 7, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(12, 8, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(12, 9, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(12, 10, 'Ha delimitado las funciones y responsabilidades de cada persona que trabaja en el taller'),
(13, 0, 'La empresa no tiene un m�todo para seleccionar personal'),
(13, 1, 'La empresa tiene un m�todo para seleccionar personal de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(13, 2, 'La empresa tiene un m�todo para seleccionar personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(13, 3, 'La empresa tiene un m�todo para seleccionar personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(13, 4, 'La empresa tiene un m�todo para seleccionar personal de forma documentada, pero no es una acci�n revisada ni mejorada'),
(13, 5, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(13, 6, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(13, 7, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(13, 8, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(13, 9, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(13, 10, 'Tiene un procedimiento para seleccionar personal en el caso de producirse una vacante o incrementarse la plantilla'),
(14, 0, 'La empresa no tiene un Plan de Acogida'),
(14, 1, 'La empresa tiene tiene un Plan de Acogida de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(14, 2, 'La empresa tiene un Plan de Acogida sistem�tico, pero no es una acci�n documentada, revisada ni mejorada'),
(14, 3, 'La empresa tiene un Plan de Acogida sistem�tico, pero no es una acci�n documentada, revisada ni mejorada'),
(14, 4, 'La empresa tiene un Plan de Acogida documentado, pero no es una acci�n revisada ni mejorada'),
(14, 5, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(14, 6, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(14, 7, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(14, 8, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(14, 9, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(14, 10, 'Dispone de un Plan de Acogida para nuevas incorporaciones'),
(15, 0, 'La empresa no dispone de Planes de Seguridad y Salud Laboral'),
(15, 1, 'La empresa dispone de Planes de Seguridad y Salud Laboral de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(15, 2, 'La empresa dispone de Planes de Seguridad y Salud Laboral de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(15, 3, 'La empresa dispone de Planes de Seguridad y Salud Laboral de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(15, 4, 'La empresa dispone de Planes de Seguridad y Salud Laboral de forma documentada, pero no es una acci�n revisada ni mejorada'),
(15, 5, 'Tiene planes de seguridad y salud laboral'),
(15, 6, 'Tiene planes de seguridad y salud laboral'),
(15, 7, 'Tiene planes de seguridad y salud laboral'),
(15, 8, 'Tiene planes de seguridad y salud laboral'),
(15, 9, 'Tiene planes de seguridad y salud laboral'),
(15, 10, 'Tiene planes de seguridad y salud laboral'),
(16, 0, 'La empresa no tiene un Plan de Formaci�n'),
(16, 1, 'La empresa hace formaci�n de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(16, 2, 'La empresa hace formaci�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(16, 3, 'La empresa hace formaci�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(16, 4, 'La empresa hace formaci�n de forma documentada, pero no es una acci�n revisada ni mejorada'),
(16, 5, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(16, 6, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(16, 7, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(16, 8, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(16, 9, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(16, 10, 'Ha definido un Plan de Formaci�n previa detecci�n de necesidades'),
(17, 0, 'La empresa no eval�a el desempe�o del personal'),
(17, 1, 'La empresa eval�a el desempe�o del personal de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(17, 2, 'La empresa eval�a el desempe�o del personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(17, 3, 'La empresa eval�a el desempe�o del personal de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(17, 4, 'La empresa eval�a el desempe�o del personal de forma documentada, pero no es una acci�n revisada ni mejorada'),
(17, 5, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(17, 6, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(17, 7, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(17, 8, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(17, 9, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(17, 10, 'Dispone de un procedimiento para evaluar el desempe�o del personal'),
(18, 0, 'No se han definido medidas para el reconocimiento y la promoci�n de los empleados'),
(18, 1, 'Se han definido medidas para el reconocimiento y la promoci�n de los empleados de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(18, 2, 'Se han definido medidas para el reconocimiento y la promoci�n de los empleados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(18, 3, 'Se han definido medidas para el reconocimiento y la promoci�n de los empleados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(18, 4, 'Se han definido medidas para el reconocimiento y la promoci�n de los empleados de forma documentada, pero no es una acci�n revisada ni mejorada'),
(18, 5, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(18, 6, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(18, 7, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(18, 8, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(18, 9, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(18, 10, 'Se han arbitrado medidas para reconocer y promocionar a las personas que trabajan en el taller'),
(19, 0, 'No se mide la satisfacci�n del personal'),
(19, 1, 'Se mide la satisfacci�n del personal de los empleados de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(19, 2, 'Se mide la satisfacci�n del personal de los empleados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(19, 3, 'Se mide la satisfacci�n del personal de los empleados de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(19, 4, 'Se mide la satisfacci�n del personal de forma documentada, pero no es una acci�n revisada ni mejorada'),
(19, 5, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(19, 6, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(19, 7, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(19, 8, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(19, 9, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(19, 10, 'Hay mecanismos de medici�n de la satisfacci�n del personal'),
(20, 0, 'No se han establecido medidas de conciliaci�n de la vida laboral y la familiar'),
(20, 1, 'Se han establecido medidas de conciliaci�n de la vida laboral y la familiar de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(20, 2, 'Se han establecido medidas de conciliaci�n de la vida laboral y la familiar de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(20, 3, 'Se han establecido medidas de conciliaci�n de la vida laboral y la familiar de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(20, 4, 'Se han establecido medidas de conciliaci�n de la vida laboral y la familiar de forma documentada, pero no es una acci�n revisada ni mejorada'),
(20, 5, 'Su empresa permite conciliar la vida laboral con la familiar'),
(20, 6, 'Su empresa permite conciliar la vida laboral con la familiar'),
(20, 7, 'Su empresa permite conciliar la vida laboral con la familiar'),
(20, 8, 'Su empresa permite conciliar la vida laboral con la familiar'),
(20, 9, 'Su empresa permite conciliar la vida laboral con la familiar'),
(20, 10, 'Su empresa permite conciliar la vida laboral con la familiar'),
(21, 0, 'La empresa no dispone de un Cuadro de Previsi�n de Tesorer�a'),
(21, 1, 'La empresa dispone de un Cuadro de Previsi�n de Tesorer�a de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(21, 2, 'La empresa dispone de un Cuadro de Previsi�n de Tesorer�a sistem�tico, pero no es una acci�n documentada, revisada ni mejorada'),
(21, 3, 'La empresa dispone de un Cuadro de Previsi�n de Tesorer�a sistem�tico, pero no es una acci�n documentada, revisada ni mejorada'),
(21, 4, 'La empresa dispone de un Cuadro de Previsi�n de Tesorer�a documentado, pero no es una acci�n revisada ni mejorada'),
(21, 5, 'Dispone de un cuadro de tesorer�a mes a mes'),
(21, 6, 'Dispone de un cuadro de tesorer�a mes a mes'),
(21, 7, 'Dispone de un cuadro de tesorer�a mes a mes'),
(21, 8, 'Dispone de un cuadro de tesorer�a mes a mes'),
(21, 9, 'Dispone de un cuadro de tesorer�a mes a mes'),
(21, 10, 'Dispone de un cuadro de tesorer�a mes a mes'),
(22, 0, 'No se utilizan indicadores para conocer la salud financiera del negocio'),
(22, 1, 'Se utilizan indicadores para conocer la salud financiera del negocio de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(22, 2, 'Se utilizan indicadores para conocer la salud financiera del negocio de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(22, 3, 'Se utilizan indicadores para conocer la salud financiera del negocio de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(22, 4, 'Se utilizan indicadores para conocer la salud financiera del negocio de forma documentada, pero no es una acci�n revisada ni mejorada'),
(22, 5, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(22, 6, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(22, 7, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(22, 8, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(22, 9, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(22, 10, 'Utiliza indicadores adecuados para conocer la salud financiera de su negocio'),
(23, 0, 'No se utilizan mecanismos para evaluar la productividad de las inversiones'),
(23, 1, 'Se utilizan mecanismos para evaluar la productividad de las inversiones de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(23, 2, 'Se utilizan mecanismos para evaluar la productividad de las inversiones de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(23, 3, 'Se utilizan mecanismos para evaluar la productividad de las inversiones de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(23, 4, 'Se utilizan mecanismos para evaluar la productividad de las inversiones de forma documentada, pero no es una acci�n revisada ni mejorada'),
(23, 5, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(23, 6, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(23, 7, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(23, 8, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(23, 9, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(23, 10, 'Dispone de un sistema para evaluar la productividad de las inversiones'),
(24, 0, 'No se eval�a el rendimiento econ�mico que producen los proveedores'),
(24, 1, 'Se eval�a el rendimiento econ�mico que producen los proveedores de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(24, 2, 'Se eval�a el rendimiento econ�mico que producen los proveedores de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(24, 3, 'Se eval�a el rendimiento econ�mico que producen los proveedores de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(24, 4, 'Se eval�a el rendimiento econ�mico que producen los proveedores de forma documentada, pero no es una acci�n revisada ni mejorada'),
(24, 5, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(24, 6, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(24, 7, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(24, 8, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(24, 9, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(24, 10, 'Valora econ�micamente los resultados que le proporcionan sus proveedores'),
(25, 0, 'No se dispone de un procedimiento para las compras'),
(25, 1, 'Se dispone de un procedimiento para las compras de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(25, 2, 'Se dispone de un procedimiento para las compras de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(25, 3, 'Se dispone de un procedimiento para las compras de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(25, 4, 'Se dispone de un procedimiento para las compras de forma documentada, pero no es una acci�n revisada ni mejorada'),
(25, 5, 'Las compras est�n debidamente procedimentadas'),
(25, 6, 'Las compras est�n debidamente procedimentadas'),
(25, 7, 'Las compras est�n debidamente procedimentadas'),
(25, 8, 'Las compras est�n debidamente procedimentadas'),
(25, 9, 'Las compras est�n debidamente procedimentadas'),
(25, 10, 'Las compras est�n debidamente procedimentadas'),
(26, 0, 'No se conocen los stocks m�nimo y m�ximo que deben almacenarse'),
(26, 1, 'Se conocen los stocks m�nimo y m�ximo que deben almacenarse de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(26, 2, 'Se conocen los stocks m�nimo y m�ximo que deben almacenarse de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(26, 3, 'Se conocen los stocks m�nimo y m�ximo que deben almacenarse de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(26, 4, 'Se conocen los stocks m�nimo y m�ximo que deben almacenarse de forma documentada, pero no es una acci�n revisada ni mejorada'),
(26, 5, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(26, 6, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(26, 7, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(26, 8, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(26, 9, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(26, 10, 'Tiene identificados los stocks m�ximos y m�nimos que debe haber en el almac�n del taller'),
(27, 0, 'Los datos de gesti�n no est�n informatizados'),
(27, 1, 'Los datos de gesti�n est�n informatizados parcialmente, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(27, 2, 'Los datos de gesti�n est�n informatizados sistem�ticamente, pero no es una acci�n documentada, revisada ni mejorada'),
(27, 3, 'Los datos de gesti�n est�n informatizados sistem�ticamente, pero no es una acci�n documentada, revisada ni mejorada'),
(27, 4, 'Los datos de gesti�n est�n informatizados sistem�ticamente y de forma documentada, pero no es una acci�n revisada ni mejorada'),
(27, 5, 'Tiene debidamente informatizada la gesti�n del negocio'),
(27, 6, 'Tiene debidamente informatizada la gesti�n del negocio'),
(27, 7, 'Tiene debidamente informatizada la gesti�n del negocio'),
(27, 8, 'Tiene debidamente informatizada la gesti�n del negocio'),
(27, 9, 'Tiene debidamente informatizada la gesti�n del negocio'),
(27, 10, 'Tiene debidamente informatizada la gesti�n del negocio'),
(28, 0, 'La empresa no amortiza sus equipos'),
(28, 1, 'La empresa amortiza sus equipos de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(28, 2, 'La empresa amortiza sus equipos de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(28, 3, 'La empresa amortiza sus equipos de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(28, 4, 'La empresa amortiza sus equipos de forma documentada, pero no es una acci�n revisada ni mejorada'),
(28, 5, 'Tiene planificada la amortizaci�n de sus inversiones'),
(28, 6, 'Tiene planificada la amortizaci�n de sus inversiones'),
(28, 7, 'Tiene planificada la amortizaci�n de sus inversiones'),
(28, 8, 'Tiene planificada la amortizaci�n de sus inversiones'),
(28, 9, 'Tiene planificada la amortizaci�n de sus inversiones'),
(28, 10, 'Tiene planificada la amortizaci�n de sus inversiones'),
(29, 0, 'El taller est� sucio, desordenado y mal equipado'),
(29, 1, 'El taller se limpia, ordena y equipa, pero no de forma sistem�tica, documentada, revisada ni mejorada'),
(29, 2, 'El taller se limpia, ordena y equipa de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(29, 3, 'El taller se limpia, ordena y equipa de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(29, 4, 'El taller se limpia, ordena y equipa de forma sistem�tica y  documentada, pero no es una acci�n revisada ni mejorada'),
(29, 5, 'Mantiene el taller limpio, bien equipado y en orden'),
(29, 6, 'Mantiene el taller limpio, bien equipado y en orden'),
(29, 7, 'Mantiene el taller limpio, bien equipado y en orden'),
(29, 8, 'Mantiene el taller limpio, bien equipado y en orden'),
(29, 9, 'Mantiene el taller limpio, bien equipado y en orden'),
(29, 10, 'Mantiene el taller limpio, bien equipado y en orden'),
(30, 0, 'La empresa no gestiona sus residuos con criterios medioambientales'),
(30, 1, 'La empresa gestiona sus residuos con criterios medioambientales de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(30, 2, 'La empresa gestiona sus residuos con criterios medioambientales de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(30, 3, 'La empresa gestiona sus residuos con criterios medioambientales de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(30, 4, 'La empresa gestiona sus residuos con criterios medioambientales de forma documentada, pero no es una acci�n revisada ni mejorada'),
(30, 5, 'Realiza gesti�n medioambiental de sus res�duos'),
(30, 6, 'Realiza gesti�n medioambiental de sus res�duos'),
(30, 7, 'Realiza gesti�n medioambiental de sus res�duos'),
(30, 8, 'Realiza gesti�n medioambiental de sus res�duos'),
(30, 9, 'Realiza gesti�n medioambiental de sus res�duos'),
(30, 10, 'Realiza gesti�n medioambiental de sus res�duos'),
(31, 0, 'La empresa no dispone de Mapa de Procesos'),
(31, 1, 'Algunos procesos est�n definidos de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(31, 2, 'La mayor�a de los procesos est�n definidos de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(31, 3, 'La mayor�a de los procesos est�n definidos de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(31, 4, 'Los procesos de la empresa est�n recogidos en un Mapa de Procesos sistem�tico y documentado, pero no es una acci�n revisada ni mejorada'),
(31, 5, 'La empresa dispone de un mapa de procesos'),
(31, 6, 'La empresa dispone de un mapa de procesos'),
(31, 7, 'La empresa dispone de un mapa de procesos'),
(31, 8, 'La empresa dispone de un mapa de procesos'),
(31, 9, 'La empresa dispone de un mapa de procesos'),
(31, 10, 'La empresa dispone de un mapa de procesos'),
(32, 0, 'No se han establecido los canales de comunicaci�n dentro de la empresa'),
(32, 1, 'Se han establecido los canales de comunicaci�n dentro de la empresa de forma puntual, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(32, 2, 'Se han establecido los canales de comunicaci�n dentro de la empresa de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(32, 3, 'Se han establecido los canales de comunicaci�n dentro de la empresa de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(32, 4, 'Se han establecido los canales de comunicaci�n dentro de la empresa de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(32, 5, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(32, 6, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(32, 7, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(32, 8, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(32, 9, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(32, 10, 'Est�n establecidos los canales de comunicaci�n dentro de la empresa'),
(33, 0, 'No se dispone de bases de datos de clientes'),
(33, 1, 'Se dispone de los datos de algunos clientes, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(33, 2, 'Se dispone de una base de datos de clientes de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(33, 3, 'Se dispone de una base de datos de clientes de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(33, 4, 'Se dispone de una base de datos de clientes de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(33, 5, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(33, 6, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(33, 7, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(33, 8, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(33, 9, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(33, 10, 'Dispone de bases de datos de sus clientes actuales y potenciales'),
(34, 0, 'No se ha implementado la Ley Org�nica de Protecci�n de Datos (LOPD)'),
(34, 1, 'Se est� en proceso de implementaci�n de la Ley Org�nica de Protecci�n de Datos (LOPD), pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(34, 2, 'Se est� en proceso de implementaci�n de la Ley Org�nica de Protecci�n de Datos (LOPD) pero a�n no es una acci�n documentada, revisada ni mejorada'),
(34, 3, 'Se est� en proceso de implementaci�n de la Ley Org�nica de Protecci�n de Datos (LOPD) pero a�n no es una acci�n documentada, revisada ni mejorada'),
(34, 4, 'Se ha implementado la Ley Org�nica de Protecci�n de Datos (LOPD) de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(34, 5, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(34, 6, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(34, 7, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(34, 8, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(34, 9, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(34, 10, 'Tiene implantada la Ley Org�nica de Protecci�n de Datos'),
(35, 0, 'No se ha definido un Plan de Comunicaci�n'),
(35, 1, 'Se ha definido un Plan de Comunicaci�n, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(35, 2, 'Se ha definido un Plan de Comunicaci�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(35, 3, 'Se ha definido un Plan de Comunicaci�n de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(35, 4, 'Se ha definido un Plan de Comunicaci�n de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(35, 5, 'Dispone de un Plan de Comunicaci�n'),
(35, 6, 'Dispone de un Plan de Comunicaci�n'),
(35, 7, 'Dispone de un Plan de Comunicaci�n'),
(35, 8, 'Dispone de un Plan de Comunicaci�n'),
(35, 9, 'Dispone de un Plan de Comunicaci�n'),
(35, 10, 'Dispone de un Plan de Comunicaci�n'),
(36, 0, 'No se dise�an nuevos servicios para los clientes'),
(36, 1, 'Se dise�an nuevos servicios para los clientes, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(36, 2, 'Se dise�an nuevos servicios para los clientes de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(36, 3, 'Se dise�an nuevos servicios para los clientes de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(36, 4, 'Se dise�an nuevos servicios para los clientes de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(36, 5, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(36, 6, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(36, 7, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(36, 8, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(36, 9, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(36, 10, 'Habitualmente dise�a nuevos productos y servicios para sus clientes'),
(37, 0, 'La empresa no ha dise�ado un Protocolo de Atenci�n al Cliente'),
(37, 1, 'La empresa tiene algunas directrices de Atenci�n al Cliente, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(37, 2, 'La empresa ha dise�ado un Protocolo de Atenci�n al Cliente de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(37, 3, 'La empresa ha dise�ado un Protocolo de Atenci�n al Cliente de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(37, 4, 'La empresa ha dise�ado un Protocolo de Atenci�n al Cliente de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(37, 5, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(37, 6, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(37, 7, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(37, 8, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(37, 9, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(37, 10, 'Dispone de un Protocolo de Atenci�n al Cliente conocido por todas las personas del taller'),
(38, 0, 'No se informa a los clientes sobre las condiciones de contrataci�n de sus servicios'),
(38, 1, 'Se informa a los clientes sobre las condiciones de contrataci�n de sus servicios, pero no es una acci�n sistem�tica, documentada, revisada ni mejorada'),
(38, 2, 'Se informa a los clientes sobre las condiciones de contrataci�n de sus servicios de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(38, 3, 'Se informa a los clientes sobre las condiciones de contrataci�n de sus servicios de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(38, 4, 'Se informa a los clientes sobre las condiciones de contrataci�n de sus servicios de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(38, 5, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(38, 6, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(38, 7, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(38, 8, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(38, 9, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(38, 10, 'Informa debidamente a sus clientes de las condiciones de contrataci�n'),
(39, 0, 'No se utiliza una encuesta de satisfacci�n de los clientes'),
(39, 1, 'Se utiliza una encuesta de satisfacci�n de los clientes, pero no se explotan sus datos de forma sistem�tica, documentada, revisada ni mejorada'),
(39, 2, 'Se utiliza una encuesta de satisfacci�n de los clientes de sus servicios de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(39, 3, 'Se utiliza una encuesta de satisfacci�n de los clientes de sus servicios de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(39, 4, 'Se utiliza una encuesta de satisfacci�n de los clientes de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(39, 5, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(39, 6, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(39, 7, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(39, 8, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(39, 9, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(39, 10, 'Tiene una encuesta de satisfacci�n de clientes y analiza sus respuestas'),
(40, 0, 'No se ofrece servicio post-venta'),
(40, 1, 'Se ofrece un servicio post-venta, pero no de forma sistem�tica, documentada, revisada ni mejorada'),
(40, 2, 'Se ofrece un servicio post-venta de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(40, 3, 'Se ofrece un servicio post-venta de forma sistem�tica, pero no es una acci�n documentada, revisada ni mejorada'),
(40, 4, 'Se ofrece un servicio post-venta de forma sistem�tica y documentada, pero no es una acci�n revisada ni mejorada'),
(40, 5, 'Ofrece un adecuado servicio post-venta'),
(40, 6, 'Ofrece un adecuado servicio post-venta'),
(40, 7, 'Ofrece un adecuado servicio post-venta'),
(40, 8, 'Ofrece un adecuado servicio post-venta'),
(40, 9, 'Ofrece un adecuado servicio post-venta'),
(40, 10, 'Ofrece un adecuado servicio post-venta'),
(41, 0, 'No dispone de datos o �stos son negativos en los indicadores de gesti�n del negocio en los �ltimos tres a�os'),
(41, 1, 'Dispone de pocos datos positivos en los indicadores de gesti�n del negocio en los �ltimos tres a�os'),
(41, 2, 'Sus datos econ�micos son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(41, 3, 'Sus datos econ�micos son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(41, 4, 'Sus datos econ�micos son positivos y se han establecido objetivos, aunque no se han superado ni se han comparado con otras empresas'),
(41, 5, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(41, 6, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(41, 7, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(41, 8, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(41, 9, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(41, 10, 'En los �ltimos tres a�os ha obtenido resultados econ�micos positivos'),
(42, 0, 'No dispone de datos o �stos son negativos en los indicadores relacionados con la satisfacci�n de los clientes en los �ltimos tres a�os'),
(42, 1, 'Dispone de pocos datos positivos en los indicadores relacionados con la satisfacci�n de los clientes en los �ltimos tres a�os'),
(42, 2, 'Sus datos de satisfacci�n de clientes son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(42, 3, 'Sus datos de satisfacci�n de clientes son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(42, 4, 'Sus datos de satisfacci�n de clientes son positivos y se han establecido objetivos, aunque no se han superado ni se han comparado con otras empresas'),
(42, 5, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(42, 6, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(42, 7, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(42, 8, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(42, 9, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(42, 10, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de sus clientes'),
(43, 0, 'No dispone de datos o �stos son negativos en los indicadores relacionados con la satisfacci�n del personal en los �ltimos tres a�os'),
(43, 1, 'Dispone de pocos datos positivos en los indicadores relacionados con la satisfacci�n del personal en los �ltimos tres a�os'),
(43, 2, 'Sus datos de satisfacci�n del personal son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(43, 3, 'Sus datos de satisfacci�n del personal son positivos aunque no ha establecido objetivos previos y, por lo tanto, no los ha superado ni los ha comparado con otras empresas'),
(43, 4, 'Sus datos de satisfacci�n del personal son positivos y se han establecido objetivos, aunque no se han superado ni se han comparado con otras empresas'),
(43, 5, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller'),
(43, 6, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller'),
(43, 7, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller'),
(43, 8, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller'),
(43, 9, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller'),
(43, 10, 'En los �ltimos tres a�os ha obtenido resultados positivos en los indicadores relacionados con la satisfacci�n de las personas que trabajan en el taller');
    ";
	$wpdb->query(utf8_encode($sql));		
}

function adeada_desinstala(){
	//include('_desinstalarRoles.php');
	global $wpdb;
	$sql = "alter table wp_users ENGINE=myISAM;";
	$wpdb->query($sql);		
	$sql = "DROP TABLE `adeada_respuestas`";
	$wpdb->query($sql);		
	$sql = "DROP TABLE `adeada_resultados`";	
	$wpdb->query($sql);		
	$sql = "DROP TABLE `adeada_preguntas`";
	$wpdb->query($sql);	
	$sql = "DROP TABLE `adeada_encuestas`";
	$wpdb->query($sql);
	$sql = "DROP TABLE `adeada_indicadores`";
	$wpdb->query($sql);		
	$sql = "DROP TABLE `adeada_areas`";
	$wpdb->query($sql);		
}

function adeada_panel(){
	echo "<h1>---eo</h1>";
}

function adeada_add_menu(){
	if (function_exists('add_options_page')){
		add_options_page('adeada','adeada',8,basename(__FILE__),'adeada_panel');
	}
}

if (function_exists('add_action')){
	add_action('admin_menu','adeada_add_menu');
}

add_action( 'admin_notices', 'adeada_saludo' );

add_action('activate_adeada/ini.php','adeada_instala');
add_action('deactivate_adeada/ini.php','adeada_desinstala');

?>