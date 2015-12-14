<?php
/****************************************************************************************************/
/* Pantalla: _instalarRoles.php
/* Plugin: tarificador
/* Descripción: include para la instalación de roles y capacidades del plugin
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		25/05/2011	Creación               
/*
/****************************************************************************************************/

global $wp_roles;
// datos
$capacidades = array (
	'gestionar_encuestas' => true,
	'gestionar_datos' => true,
	'publish_pages' => true,
);
$wp_roles->add_role(THIS_PREFIX.'datos','Gestor de los resultados',$capacidades);

$role = get_role('administrator');
if (empty($role)) {
	update_option("init_check","Es necesario que exista el rol de administrator");
	return;
}
$role->add_cap('gestionar_encuestas',true);
$role->add_cap('gestionar_datos',true);

// empresa
$capacidades = array (
	'gestionar_encuestas' => true,
	'gestionar_datos' => false,
	'publish_pages' => true,
);
$wp_roles->add_role(THIS_PREFIX.'empresa','Puede hacer encuestas',$capacidades);

/*	NOTAS: (http://www.garyc40.com/2010/04/ultimate-guide-to-roles-and-capabilities/)
/*	Los roles se guardan en un campo llamado rs_user_roles de la tabla options.
/*	Los roles se crean con:
global $wp_roles;
$wp_roles->add_role($role, $display_name, $capabilities);
ej.	$result = add_role('basic_contributor', 'Basic Contributor', array(
				'read' => true, // True allows that capability
				'edit_posts' => true,
				'delete_posts' => false, // Use false to explicitly deny
		));
		if (null !== $result) {
				echo 'Yay!  New role created!';
		} else {
				echo 'Oh... the basic_contributor role already exists.';
		}

/*	Se eliminan con:
$wp_roles->remove_role( $role );

/* Se gestionan con:
$role = $wp_roles->get_role('role_name');
$role->add_cap('cap_name',$grant [[true/false]]);

$wp_roles->add_cap( $role, $cap );
$wp_roles->remove_cap( $role, $cap );

/* Se comprueban con:
current_user_can('edit_post', $post_id);
current_user_can($capability);

// get user by user ID
$user = new WP_User( $id );
// or get user by username
$user = new WP_User( null, $name );
ej.
$user = new WP_User($post_author);
$post_status = ( $user->has_cap('publish_posts') ) ? 'publish' : 'pending';


/* Las capacidades por defecto son (http://codex.wordpress.org/Roles_and_Capabilities):
manage_network						
manage_sites						
manage_network_users						
manage_network_themes						
manage_network_options						
activate_plugins						
add_users						
create_users						
delete_plugins						
delete_themes						
delete_users						
edit_files						
edit_plugins						
edit_theme_options						
edit_themes						
edit_users						
export						
import						
install_plugins						
install_themes						
list_users						
manage_options						
promote_users						
remove_users						
switch_themes						
unfiltered_upload						
update_core						
update_plugins						
update_themes						
edit_dashboard						
moderate_comments						
manage_categories						
manage_links						
unfiltered_html						
edit_others_posts						
edit_pages						
edit_others_pages						
edit_published_pages						
publish_pages						
delete_pages						
delete_others_pages						
delete_published_pages						
delete_others_posts						
delete_private_posts						
edit_private_posts						
read_private_posts						
delete_private_pages						
edit_private_pages						
read_private_pages						
edit_published_posts						
upload_files						
publish_posts						
delete_published_posts						
edit_posts						
delete_posts						
read
*/