    <div id="header">
	
        <div id="masthead">
            <div id="branding">
                <div id="blog-title">
					<span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span>
					<a href="http://www.ejgv.euskadi.net"><img src="wp-content/themes/adada_theme/images/logoGV.gif"/></a>
					<a href="http://www.spri.es"><img src="wp-content/themes/adada_theme/images/logoSPRI.png"/></a>
				</div>
            </div><!-- #branding -->
        </div><!-- #masthead -->
		
		<?php include('sidebar_primary.php'); ?>
        <div id="access">	
			<?php //wp_page_menu( 'sort_column=menu_order' ); ?>	
			<?php include('nav.php');?>
        </div><!-- #access -->		
		
    </div><!-- #header -->
	
	<div id="capaError" style="display:<?php echo $estiloMensaje?>" onclick='this.style.display="none"'>		
		<?php echo $strMensaje;?>
	</div>
	<div id="mensaje" onclick="this.style.display='none'"></div>