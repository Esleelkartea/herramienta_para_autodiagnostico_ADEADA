<?php
/*
      Theme Name: Tarificador
      Theme URI: www.digital5.es
      Version: 1.0
      Author: David Calvo
*/
/****************************************************************************************************/
/* include: menu.php
/* Theme: tarificador
/* Descripción: menú principal del tema
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		28/06/2011	Creación               
/*
/****************************************************************************************************/
$argumentos = array(
	'child_of' => 0, // Para mostrar las subpáginas del id indicado, con 0 es sin restricción. A diferencia de parent, muestra las hijas de las hijas.
	'sort_order' => 'ASC',
	'sort_column' => 'menu_order', // Orden
	'hierarchical' => 1, // Con 1 o true muestra las subpáginas indentadas
	'exclude' => '', // Id de páginas excluidas en array o string separado pro comas
	'include' => '', // Id de páginas incluidas en array o string separado pro comas
	'meta_key' => 'menu', // Solo se muestran las páginas que tengan esta 'meta Field'
	'meta_value' => '', // Solo se muestran las páginas que tengan este valor en sus 'meta Fields'
	'authors' => '', // Solo se muestran las páginas del autor indicado
	'parent' => 0, // Muestra las páginas cuyo padre sea el id indicado, -1 sin restricción, 0 solo las páginas raiz
	'exclude_tree' => '', // Al contrario de child_of, exlcuye las hijas del id indicado, incluido las subhijas.
	'number' => '', // Indica el número máximo de páginas a mostrar
	'offset' => 0, // Indica el número de páginas que se salta en la consulta
);

if ( current_user_can( 'gestionar_datos', $user_id ) ) { 
	$argumentos['include']= $argumentos['include'].',19';
}
if ( current_user_can( 'gestionar_encuestas', $user_id ) ) { 
	$argumentos['include']= $argumentos['include'].',8,45';
}

$paginas = get_pages($argumentos);
?>
<div id="menu">
	<div id="menu-inside">
		<div id="menu-derecha">
			<div id="menu-derecha-busqueda">
				<input type="text" class="texto-busqueda" value="" size="24" maxlength="50" />
				<a href="javascript:alert('buscar');">
				<img border="0" id="img-lupa" src="<?php bloginfo('template_url'); ?>/images/iconos/lupa.gif" alt="lupa" title="buscar" />
				</a>
			</div>
		</div>
		<ul id="menu-principal">
			<?php	foreach($paginas as $pagina): ?>
			<?php
				$argumentos = array(
					'child_of' => $pagina->ID,
					'sort_order' => 'ASC',
					'sort_column' => 'menu_order',
				);
				$hijas = get_pages($argumentos);
				if(is_array($hijas) && count($hijas) > 0) {
			?>
			<li class="menu-ready">
				<a href="#"><?php echo $pagina->post_title; ?></a>
				<ul class="subnav">
					<?php foreach($hijas as $hija) { ?>
					<li class="menu-ready"><a href="<?php echo get_page_link($hija->ID); ?>"><?php echo $hija->post_title; ?></a></li>
					<?php } ?>
				</ul>
			</li>
			<?php
				} else {
			?>
			<li class="menu-ready"><a href="<?php echo get_page_link($pagina->ID); ?>"><?php echo $pagina->post_title; ?></a></li>
			<?php
				}
			endforeach;
			?>
		</ul>
	</div>
</div>
