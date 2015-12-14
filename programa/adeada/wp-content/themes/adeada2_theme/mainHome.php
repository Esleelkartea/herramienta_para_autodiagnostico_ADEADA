<?php
/*
      Theme Name: Tarificador
      Theme URI: www.digital5.es
      Version: 1.0
      Author: David Calvo
*/
/****************************************************************************************************/
/* include: mainHome.php
/* Theme: tarificador
/* Descripción: elemento principal del tema
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		28/06/2011	Creación               
/*
/****************************************************************************************************/
?>
<div id="main">
	<div id="main-inside">
		<div id="content-home">
			<div id="barra-imagenes">
				<ul id="mycarousel" class="jcarousel-skin-tango">
					<li class="jcarousel-item-1"><a href="javascript:alert('prueba');"><img border="0" class="img-carrusel" src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/01.jpg" alt="imagen" /></a></li>
					<li class="jcarousel-item-2"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/02.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-3"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/03.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-4"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/04.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-5"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/05.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-6"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/06.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-7"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/07.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-8"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/08.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-9"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/09.jpg" alt="imagen" /></li>
					<li class="jcarousel-item-10"><img border="0" class="img-carrusel"  src="<?php bloginfo('template_url'); ?>/images/fotos/carousel/10.jpg" alt="imagen" /></li>
				</ul>
			</div>
			<div id="content-home-main">
				<div id="content-home-main-page">
					<?php
					global $post;
					$claves = get_post_custom($post->ID);
					$titulo = ($claves['titulo'][0] != NULL) ? $claves['titulo'][0] : 'Título no encontrado';
					?>
					<div class="titulo-main-page"><h2><?php echo $titulo; ?></h2></div>
					<div class="sep2-main-page"></div>
					<div class="contenido-main-page">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
						<?php edit_post_link(__('Edit this entry.', 'xiiweb'), '<p>', '</p>'); ?>
						<?php endwhile; endif; ?>
					</div>
				</div>
				<div id="content-home-main-news">
					<div class="titulo-main-news"><h2>Últimas noticias</h2></div>
					<div class="sep2-main-news"></div>
					<div class="contenido-main-news">
						<ul>
						<?php
						$argumentos = array(
							'numberposts'     => 5,
							'offset'          => 0,
							'category'        => 'portada',
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
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php the_content_limit(240,__('Read the rest of this entry &raquo;')); ?>
							</li>
						<?php
							}
						}
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
