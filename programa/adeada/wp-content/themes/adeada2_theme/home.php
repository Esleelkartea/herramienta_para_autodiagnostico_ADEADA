<?php
/*
Template Name: home
*/
/****************************************************************************************************/
/* Pantalla: home.php
/* Theme: tarificador
/* Descripción: template para la página de inicio
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		29/06/2011	Creación               
/*
/****************************************************************************************************/
include('acciones.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/plugins/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/plugins/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/plugins/jcarousel/lib/jquery.jcarousel.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/plugins/jcarousel/skins/tango/skin.css" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<script type="text/javascript">
	$T(document).ready(function() {
			$T('#mycarousel').jcarousel({
				wrap: 'circular',
				visible: 6,
				scroll: 1
			});
	});
	</script>
	<style type="text/css">
	/**
	* Sobreescribimos para ajustarlo a lo que queremos.
	*/
	 
	.jcarousel-skin-tango .jcarousel-container {
    background: #E6E6E6;
    border: 1px solid #343434;
	}
	 
	.jcarousel-skin-tango .jcarousel-container-horizontal {
		width: 90%;
		height: 120px;
		margin:0 auto;
	}

	.jcarousel-skin-tango .jcarousel-clip-horizontal {
		width: 100%;
		height: 120px;
	}
	
	.jcarousel-skin-tango .jcarousel-item  {
		width: 80px;
		height: 120px;
	}
	
	.jcarousel-skin-tango .jcarousel-next-horizontal {
    top: 63px;
	}
	
	.jcarousel-skin-tango .jcarousel-prev-horizontal {
    top: 63px;
	}

	</style>
</head>
<body>
<div id="page">
<form name="principal" method="post">
<?php get_header(); ?>
<?php get_template_part('menu'); ?>
<?php get_template_part('mainHome'); ?>
<div class="float-sep"></div>
<?php get_footer(); ?>
</form>
</div>
</body>
</html>
