<?php
/*
Plugin Name: prueba2
Plugin URI: http://www.orbere.com
Description: comentario
Author: Alberto Valdeolmillos
Version: 1.0
Author URI: http://www.orbere.com
*/

// This just echoes the chosen line, we'll position it later
function hello_dolly3() {
	echo "<p id='dolly'>Hola buenas</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dolly3' );

?>