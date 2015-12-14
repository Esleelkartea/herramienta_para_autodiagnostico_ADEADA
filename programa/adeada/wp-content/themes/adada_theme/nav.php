<?php
/**
 * @package XiiWeb
 * @subpackage BlackXii_Theme
 */
$argumentos = array(
    'child_of' => 0, // Para mostrar las subpáginas del id indicado, con 0 es sin restricción. A diferencia de parent, muestra las hijas de las hijas.
    'sort_order' => 'ASC',
    'sort_column' => 'menu_order', // Orden
    'hierarchical' => 1, // Con 1 o true muestra las subpáginas indentadas
    'exclude' => '', // Id de páginas excluidas en array o string separado pro comas
    'include' => '5,93,97', // Id de páginas incluidas en array o string separado pro comas
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
	$argumentos['include']= $argumentos['include'].',45';
}

$paginas = get_pages($argumentos);
?>
<div id="nav">
<div id="opciones" class="menu">

<ul id="menu">
<?php foreach($paginas as $pagina): ?>
<?php
            $claves = get_post_custom($pagina->ID);
            //$clase = $claves['menu'][0];
			$clase = "";
			if (is_page($pagina->post_title))
				$clase = "activo";			
            $url = get_page_link($pagina->ID);
            $titulo = $pagina->post_title;
            ?>		
<li><div class="<?php echo $clase; ?>"><a href="<?php echo $url; ?>"><?php echo $titulo; ?></a></div></li>
<?php endforeach; ?>
</ul>

</div>
</div>

