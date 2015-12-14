<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: prueba
Plugin URI: http://www.orbere.com
Description: comentario
Author: Alberto Valdeolmillos
Version: 1.0
Author URI: http://www.orbere.com
*/

function hello_dolly_get_lyric2() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Hola Buenas
El diseño general de la aplicación será 
un tema personalizado sencillo pero basado 
en los estándares actuales Web. Lo realmente 
importante es decidir el diseño que tendrán 
los cuestionarios a la hora de mostrase al usuario. 
Ha de ser un cuestionario que de mucha información 
en poco espacio y a su vez sea agradable de responder.
";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dolly2() {
	$chosen = hello_dolly_get_lyric2();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dolly2' );

// We need some CSS to position the paragraph
function dolly_css2() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
		color:#6633dd;
		border:solid 1px red;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css2' );

?>