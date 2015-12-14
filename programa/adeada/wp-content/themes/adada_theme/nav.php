<?php
/**
 * @package XiiWeb
 * @subpackage BlackXii_Theme
 */
$argumentos = array(
    'child_of' => 0, // Para mostrar las subp�ginas del id indicado, con 0 es sin restricci�n. A diferencia de parent, muestra las hijas de las hijas.
    'sort_order' => 'ASC',
    'sort_column' => 'menu_order', // Orden
    'hierarchical' => 1, // Con 1 o true muestra las subp�ginas indentadas
    'exclude' => '', // Id de p�ginas excluidas en array o string separado pro comas
    'include' => '5,93,97', // Id de p�ginas incluidas en array o string separado pro comas
    'meta_key' => 'menu', // Solo se muestran las p�ginas que tengan esta 'meta Field'
    'meta_value' => '', // Solo se muestran las p�ginas que tengan este valor en sus 'meta Fields'
    'authors' => '', // Solo se muestran las p�ginas del autor indicado
    'parent' => 0, // Muestra las p�ginas cuyo padre sea el id indicado, -1 sin restricci�n, 0 solo las p�ginas raiz
    'exclude_tree' => '', // Al contrario de child_of, exlcuye las hijas del id indicado, incluido las subhijas.
    'number' => '', // Indica el n�mero m�ximo de p�ginas a mostrar
    'offset' => 0, // Indica el n�mero de p�ginas que se salta en la consulta
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

