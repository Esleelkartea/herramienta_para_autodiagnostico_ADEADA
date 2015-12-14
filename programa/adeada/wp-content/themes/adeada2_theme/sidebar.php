<?php
/**
 * @package XiiWeb
 * @subpackage BlackXii_Theme
 */
$altura = ALTURA + 50;
$mensaje = __('Lanzamiento en Otoño del 2011','xiiweb');
$propio = queSoy();
$claves = get_post_custom($propio['id']);
define('MENSAJE',$claves['mensaje'][0] ? $claves['mensaje'][0] : __('Lanzamiento en Otoño del 2011','xiiweb'));
?>
<div id="sidebar" style="height:<?php echo $altura;?>px;">
	<div id="sidebar-sup">
		<div id="idiomas">
			<?php echo qtrans_generateLanguageSelectCode('both'); ?>
			<?php echo getIdiomas(false,true); // Creado por David Calvo el 30/09/2010 ?>
		</div>
	</div>
	
	<div id="empresas" class="tablon">
		<div id="digital5">
			<a href="http://www.digital5.es"><img border="0" alt="Digital5 S.L." title="Digital5 S.L." src="wp-includes/images/xii/logos/logo_digital5.png"></a>
		</div>
		<div id="delirium">
			<a href="http://www.deliriumstudios.com/"><img border="0" alt="DELIRIUM STUDIOS" title="DELIRIUM STUDIOS" src="wp-includes/images/xii/logos/logo_delirium.png"></a>
		</div>
	</div>
	<div id="apoyo" class="tablon">
		<div id="apoyo-txt">Con el apoyo de</div>
		<div id="apoyo-mc">
			<a href="http://www.mcu.es/"><img border="0" width="130px" alt="Ministerio de cultura" title="Ministerio de cultura" src="wp-includes/images/xii/logos/mc.jpg"></a>
		</div>
		<div id="apoyo-gv">
			<a href="http://www.ejgv.euskadi.net/r53-2283/es/"><img border="0" width="130px" alt="Govierno vasco" title="Govierno vasco" src="wp-includes/images/xii/logos/gv.jpg"></a>
		</div>
	</div>
	<div id="info" class="tablon">
		<div id="info-text">
			<p><?php echo MENSAJE; ?></p>
		</div>
	</div>
	<!-- Opcioens extra -->
	
</div>