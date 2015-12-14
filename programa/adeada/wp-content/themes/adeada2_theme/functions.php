<?php
/*
      Theme Name: Tarificador
      Theme URI: www.digital5.es
      Version: 1.0
      Author: David Calvo
*/
function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) $end = strpos($link, '"',$offset);
	if ($end) $link = substr_replace($link, '', $offset, $end-$offset);
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

/*
Plugin Name: Limit Posts
Plugin URI: http://labitacora.net/comunBlog/limit-post.phps
Description: Limits the displayed text length on the index page entries and generates a link to a page to read the full content if its bigger than the selected maximum length. 
Usage: the_content_limit($max_charaters, $more_link)
Version: 1.1
Author: Alfonso Sanchez-Paus Diaz y Julian Simon de Castro
Author URI: http://labitacora.net/
License: GPL
Download URL: http://labitacora.net/comunBlog/limit-post.phps
Make: 
    In file index.php 
    replace the_content() 
    with the_content_limit(1000, "more")
*/
function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

   if (strlen($_GET['p']) > 0) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo "&nbsp;<a href='";
        the_permalink();
        echo "' title='".$more_link_text."'>"."..."."</a>";
        /*
				echo "<br/>";
        echo "<a href='";
        the_permalink();
        echo "'>".$more_link_text."</a></p>";
				*/
				echo "</p>";
   }
   else {
      echo $content;
   }
}


if ( ! function_exists( 'tarificador_comment' ) ) :
/**
* Me permite personalizar el formato de comentarios:
*/
function tarificador_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comentario-autor">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'xiiweb' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comentario-autor -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'xiiweb' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'xiiweb' ), get_comment_date('d/m/Y'),  get_comment_time('H:i') ); ?></a><?php edit_comment_link( __( '(Editar)', 'xiiweb' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'xiiweb' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'xiiweb'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;