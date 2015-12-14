<?php
/*
      Theme Name: Tarificador
      Theme URI: www.digital5.es
      Version: 1.0
      Author: David Calvo
*/
/****************************************************************************************************/
/* include: _footer.php
/* Theme: tarificador
/* Descripción: pie del tema
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		28/06/2011	Creación               
/*
/****************************************************************************************************/
?>
<div id="footer">
	<div id="footer-inside">
		<div id="footer-empresa">
			<p>Copyright Seguros SVG @ 2011</p>
			<p>Tfno 902 54 55 56</p>
			<ul>
				<li><a href="<?php get_option('home'); ?>faq/aviso-legal/">Aviso legal</a></li>
				<li><a href="<?php get_option('home'); ?>faq/mapa-web/">Mapa Web</a></li>
			</ul>
		</div>
		<div id="footer-seguros">
			<p>Seguros para toda una vida</p>
			<ul>
				<li><a href="<?php get_option('home'); ?>seguros/coche/">Seguros de automóvil</a></li>
				<li><a href="<?php get_option('home'); ?>seguros/moto/">Seguros de moto</a></li>
				<li><a href="<?php get_option('home'); ?>seguros/accidentes/">Seguros de accidentes</a></li>
				<li><a href="<?php get_option('home'); ?>seguros/hogar/">Seguros del hogar</a></li>
			</ul>
		</div>
		<div id="footer-novedades">
			<p>Últimas noticias y novedades</p>
			<ul>
			<?php
			$argumentos = array(
				'numberposts'     => 4,
				'offset'          => 0,
				'category'        => 'pie',
				'orderby'         => 'post_date',
				'order'           => 'DESC',
				'post_type'       => 'post',
				'post_status'     => 'publish',
			);
			$entradas = get_posts($argumentos);
			if(!is_array($entradas) || count($entradas) == 0) {
			?>
				<li>Sin novedades</li>
			<?php
			} else {
				global $post;
				foreach($entradas as $post) {
					setup_postdata($post);
			?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php
				}
			}
			?>
			</ul>
		</div>
		<div id="footer-social">
			<p>Síguenos en:</p>
			<ul>
				<li><a href="<?php get_option('home'); ?>seguros/noticias/">Nuestro Blog</a></li>
				<li><a href="javascript('seguir en facebook');">Facebook</a></li>
				<li><a href="javascript('seguir en twitter');">Twitter</a></li>
				<li><a href="javascript('seguir en rss');">RSS</a></li>
			</ul>
		</div>
	</div>
</div>
