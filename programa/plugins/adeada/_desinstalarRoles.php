<?php
/****************************************************************************************************/
/* Pantalla: _desinstalarRoles.php
/* Plugin: tarificador
/* Descripción: include para la desinstalación de roles y capacidades del plugin
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		25/05/2011	Creación               
/*
/****************************************************************************************************/
global $wp_roles;
$wp_roles->remove_cap('administrator','gestionar_encuestas');
$wp_roles->remove_cap('administrator','gestionar_datos');
$wp_roles->remove_role(THIS_PREFIX.'datos');
$wp_roles->remove_role(THIS_PREFIX.'empresa');