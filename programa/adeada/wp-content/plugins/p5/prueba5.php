<?php
/*
Plugin Name: prueba5_nombre
Plugin URI: http://www.orbere.com
Description: comentario
Author: Alberto Valdeolmillos
Version: 1.0
Author URI: http://www.orbere.com
*/

// This just echoes the chosen line, we'll position it later
function prueba5_saludo5() {
	echo "Hola buenas_ 44444";
}

function prueba5_saludo_instala(){
	global $wpdb;
	$table_name = $wpdb->prefix."saludos";
	$sql = "CREATE TABLE $table_name (id mediumint(9) NOT NULL AUTO_INCREMENT,saludo tinytext NOT NULL,PRIMARY KEY (id));";
	$wpdb->query($sql);
	$sql = "INSERT INTO $table_name (saludo) VALUES ('Hola que tall')";
	$wpdb->query($sql);	
}

function prueba5_saludo_desinstala(){
	global $wpdb;
	$table_name = $wpdb->prefix."saludos";
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);	
}

function prueba5_saludo_panel(){
	echo "<h1>---{$_POST['saludo_inserta']}</h1>";
	global $wpdb;
	$table_name = $wpdb->prefix."saludos";
	if (isset($_POST['saludo_inserta'])){
		$sql = "INSERT INTO $table_name (saludo) VALUES ('{$_POST['saludo_inserta']}')";
		$wpdb->query($sql);	
	}	
	include('template/panel.html');
}

function prueba5_saludo_add_menu(){
	if (function_exists('add_options_page')){
		add_options_page('prueba5','prueba5',8,basename(__FILE__),'prueba5_saludo_panel');
	}
}

if (function_exists('add_action')){
	add_action('admin_menu','prueba5_saludo_add_menu');
}


// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'prueba5_saludo5' );

add_action('activate_p5/prueba5.php','prueba5_saludo_instala');
add_action('deactivate_p5/prueba5.php','prueba5_saludo_desinstala');

?>