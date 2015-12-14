<?php
/****************************************************************************************************/
/* include: acciones.php
/* Theme: tarificador
/* Descripción: gestor de las acciones del tema
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor                    Fecha                Acción
/*
/* Digital5 S.L.        30/06/2011    Creación
/*
/****************************************************************************************************/

// Comprobar un mail
function es_email($email){
    $mail_correcto = false;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
        if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
            //miro si tiene caracter .
            if (substr_count($email,".")>= 1){
                //obtengo la terminacion del dominio
                $term_dom = substr(strrchr ($email, '.'),1);
                //compruebo que la terminación del dominio sea correcta
                if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                    //compruebo que lo de antes del dominio sea correcto
                    $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                    $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                    if ($caracter_ult != "@" && $caracter_ult != ".") $mail_correcto = true;
                }
            }
        }
    }
    return $mail_correcto;
}

// Registro de usuario, basado en ()register_new_user
function registrar_usuario($parametros) {
    $errors = new WP_Error();
    if($parametros['email'] == NULL) {
        $errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.' ) );
        //return $errors;
    }
    if(!es_email($parametros['email'])) {
        $errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.' ) );
        //return $errors;
    }
    if(email_exists($parametros['email'])) {
        $errors->add( 'email_exists', __( '<strong>ERROR</strong>: This email is already registered, please choose another one.' ) );
        //return $errors;
    }
    if($parametros['nombre'] == NULL) {
        $errors->add( 'empty_username', __( '<strong>ERROR</strong>: Please enter a username.' ) );
        //return $errors;
    }
    if($parametros['empresa'] == NULL) {
        $errors->add( 'empty_empresa',  '<strong>ERROR</strong>: Por favor introduce una empresa.'  );
    }	
	if ( $errors->get_error_code() )
		return $errors;
    $user_pass = ($parametros['clave'] == NULL) ? wp_generate_password( 12, false) : $parametros['clave'];
    $user_id = wp_create_user($parametros['nombre'],$user_pass,$parametros['email']);
    if(!$user_id) {
        $errors->add( 'registerfail', sprintf( __( '<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !' ), get_option( 'admin_email' ) ) );
        return $errors;
    }
    update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.
    wp_new_user_notification( $user_id, $user_pass );

	//actualizo la empresa
	global $wpdb;
	$sql = "update wp_users set empresa = '".$parametros['empresa']."' where ID = '".$user_id."'";	
	$result = $wpdb->query($sql); 
	if ($result === false) {
		$errors->add( 'empty_empresa',  '<strong>ERROR</strong>: No se ha asignado la empresa.'  );
	}

    return $user_id;
}

$accion = ($_POST['accion']) ? $_POST['accion'] : NULL;
switch($accion) {
    case 'registrar':
        $email = $_POST['loginRegistro'];
        $clave = $_POST['passRegistro'];
        $nombre = $_POST['nombreRegistro'];
		$empresa = $_POST['empresaRegistro'];
        $args = array (
            'email' => $email,
            'clave' => $clave,
            'nombre' => $nombre,
			'empresa' => $empresa,
        );
        $registrarResultadoError = registrar_usuario($args);
		if ( !is_wp_error($registrarResultadoError) ) 
			$registrarResultadoBueno = __('Registration complete. Please check your e-mail.');
        break;
    case 'entrar':
        $log = $_POST['log'];
        $pwd = $_POST['pwd'];
        $recordar = ($_POST['recordarUsuario']) ? $_POST['recordarUsuario'] : true;
        $args = array (
            'user_login' => $log,
            'user_password' => $pwd
        );
        $user = wp_signon( $args, false );
        if ( is_wp_error($user) ) {
			$userdata = get_user_by('login', $log);
			if ( !$userdata )
				$entrarResultadoError = __('<strong>ERROR</strong>: Invalid username or incorrect password.');
			else
				if ( !wp_check_password($pwd, $userdata->user_pass, $userdata->ID) )
					$entrarResultadoError = sprintf( __( '<strong>ERROR</strong>: The password you entered for the username <strong>%1$s</strong> is incorrect.' ),$log);
			//$entrarResultadoError = 'Error: '.$user->get_error_message().'<br/>';
		}
        else 
			wp_set_current_user($user->ID);
        break;
    case 'salir':
        wp_logout();
        break;
}



