<?php
/*
      Theme Name: Tarificador
      Theme URI: www.digital5.es
      Version: 1.0
      Author: David Calvo
*/
/****************************************************************************************************/
/* include: _header.php
/* Theme: tarificador
/* Descripción: cabecera del tema
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		28/06/2011	Creación               
/*
/****************************************************************************************************/
?>
<input type="hidden" id="accion" name="accion" value="" />
<input type="hidden" id="vengoDe" name="vengoDe" value="<?php echo get_permalink(); ?>" />
<div id="header">
	<div id="header-inside">
		<div id="header-first">
			<div id="header-logo">
				<a href="javascript:alert('Acción del logo.');">
				<img class="img-logo" border="0" src="<?php bloginfo('template_url'); ?>/images/logo.gif" alt="logo" title="<?php bloginfo('description'); ?>" />
				</a>
			</div>
			<div id="header-mensaje"><p>Seguros para toda una vida</p></div>
			<div id="header-tfno"><p>94 555 55 55</p></div>
		</div>
		<div id="header-end">
			<div id="header-idiomas">
				<?php //echo qtrans_generateLanguageSelectCode('both'); ?>
			</div>
			<div id="header-acceso">
				<?php
				if ( is_user_logged_in() ) {
					    echo '<a href="'.wp_logout_url(get_permalink()).'" title="Logout" class="hunderline">Logout</a>';
					} else {
					    echo '<a href="'.wp_login_url( get_permalink() ).'>" title="Login" class="hunderline">Login</a>';
					};

					?>
			
				<?php if (is_user_logged_in()) { ?>
				<p>
				Usuario <?php echo $user_ID; ?> operativo
				<a id="acceso-logout" href="<?php echo wp_logout_url(get_permalink()); ?>" title="Cerrar sesión">[ x ]</a>
				</p>
				
				<?php } else { ?>
				<?php include('_ventanaLogin.php'); ?>
				<?php include('_ventanaRegistro.php'); ?>
				<a id="acceso-conectarse" href="#">conectarse</a>
				<p>o bien</p>
				<a id="acceso-registrarse" href="#">registrarse</a>
				<?php } ?>
			</div>
			<div id="header-social">
				<ul>
					<li>
					<a href="javascript:alert('twitter');">
					twitter
					<img border="0" class="icono-social" src="<?php bloginfo('template_url'); ?>/images/logos/twitter.png" alt="acceso a red social" title="twitter" />
					</a>
					</li>
					<li>
					<a href="javascript:alert('facebook');">
					facebook
					<img border="0" class="icono-social" src="<?php bloginfo('template_url'); ?>/images/logos/facebook.png" alt="acceso a red social" title="facebook" />
					</a>
					</li>
					<li>
					<a href="javascript:alert('rss');">
					rss
					<img border="0" class="icono-social" src="<?php bloginfo('template_url'); ?>/images/logos/rss.png" alt="acceso a red social" title="rss" />
					</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="header-fotos">
			<div class="marco-foto">
				<div class="texto-foto">
					<a href="javascript:alert('Acceso a opción');">TRANSPORTE</a>
				</div>
				<img class="foto-superior" border="0" src="<?php bloginfo('template_url'); ?>/images/fotos/transporte.png" alt="opción superior" title="acceso a transportes" />
			</div>
			<div class="marco-foto">
				<div class="texto-foto">
					<a href="javascript:alert('Acceso a opción');">DEPORTE</a>
				</div>
				<img class="foto-superior" border="0" src="<?php bloginfo('template_url'); ?>/images/fotos/deporte.png" alt="opción superior" title="acceso a deportes" />
			</div>
			<div class="marco-foto">
				<div class="texto-foto">
					<a href="javascript:alert('Acceso a opción');">FAMILIA</a>
				</div>
				<img class="foto-superior" border="0" src="<?php bloginfo('template_url'); ?>/images/fotos/familia.png" alt="opción superior" title="acceso a familia" />
			</div>
			<div class="marco-foto">
				<div class="texto-foto">
					<a href="javascript:alert('Acceso a opción');">MÉDICO</a>
				</div>
				<img class="foto-superior" border="0" src="<?php bloginfo('template_url'); ?>/images/fotos/medico.png" alt="opción superior" title="acceso a médico" />
			</div>
		</div>
	</div>
</div>
