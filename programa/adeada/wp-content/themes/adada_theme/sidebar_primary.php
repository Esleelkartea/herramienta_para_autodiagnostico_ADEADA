<?php if ( is_sidebar_active('primary_widget_area') ) : ?>

		<div id="capaCero">	
			<?php include('acciones.php'); ?>
			
			<?php 		
			global $current_user;
			$verLogReg = "block";
			$strSaludo = "";
			if ($current_user->display_name != null){
				$verLogReg = "none";
				$strSaludo = __( 'Hi', 'login-with-ajax' ) . " " . $current_user->display_name; 
			?>
			<div id="saludo">
			<span><?php echo $strSaludo;?></span>
			<a id="wp-logout" href="<?php echo wp_logout_url(home_url()) ?>"  onclick="document.getElementById('capaLogout').style.display='none';">(desconectar)</a>
			</div>
			<?php 
			} 
			?>	
			
			<div id="logreg" style="display:<?php echo $verLogReg?>">
			<a href="#" onclick="document.getElementById('fade').style.display='block';document.getElementById('capaLogin').style.display='block';document.getElementById('capaRegistro').style.display='none';document.getElementById('capaError').style.display='none';">login</a>
			<a href="#" onclick="document.getElementById('fade').style.display='block';document.getElementById('capaRegistro').style.display='block';document.getElementById('capaLogin').style.display='none';document.getElementById('capaError').style.display='none';">registrar</a>
			</div>
			<?php 
			$strMensaje = "";
			//error usurio 
			if ($entrarResultadoError) 
				$strMensaje = $entrarResultadoError;	
			
			//error registro
			if (is_wp_error($registrarResultadoError)) {
				//echo 'ERRORES con '.count($registrarResultadoError).' errores<br/>';
				$error_string = $registrarResultadoError->get_error_message();
				$strMensaje = $error_string;
				//foreach($registrarResultadoError as $cod => $error) {
				//	echo 'ERROR '.$cod.': '.count($error).'<br/>';
				//}
			}
			else
				if ($registrarResultadoBueno)
					$strMensaje = $registrarResultadoBueno;
					
			$estiloMensaje="none";
			if (strlen($strMensaje)>0)
				$estiloMensaje="block";
			?>			
		
		</div>	
		<div id="primary" class="widget-area">	
			<div id="fade" class="black_overlay"></div>		
			<div id="capaLogin" style="display:none;">
			<div class="cerrar"><a href="#" onclick="document.getElementById('fade').style.display='none';document.getElementById('capaLogin').style.display='none';">cerrar</a></div>
			<?php 
			//$str = "redirect=http://".$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			//wp_login_form($str);
			?>
			<form name="entrarform" id="entrarform" action="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" method="post">
				<p>
					<label><?php _e('Username') ?><br />
					<input type="text" name="log" id="log" class="input" size="20" tabindex="10" /></label>
				</p>
				<p>
					<label><?php echo _e('Password') ?><br />
					<input type="text" name="pwd" id="pwd" class="input" size="25" tabindex="20" /></label>
				</p>				
				<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Log In'); ?>" tabindex="100" /></p>
				<input name="recordarUsuario" type="checkbox" id="recordarUsuario" value="forever" /> <label><?php _e( 'Remember Me' ) ?></label>
				<input type="hidden" name="accion" value="entrar" />
			</form>				
			</div>
			<div id="capaRegistro" style="display:none;">
			<div class="cerrar"><a href="#" onclick="document.getElementById('fade').style.display='none';document.getElementById('capaRegistro').style.display='none';">cerrar</a></div>
			<form name="registrarform" id="registrarform" action="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" method="post">
				<p>
					<label><?php _e('Username') ?><br />
					<input type="text" name="nombreRegistro" id="nombreRegistro" class="input" size="20" tabindex="10" /></label>
				</p>
				<p>
					<label><?php _e('E-mail') ?><br />
					<input type="text" name="loginRegistro" id="loginRegistro" class="input" size="25" tabindex="20" /></label>
				</p>
				<p>
					<label><?php echo _e('Password') ?><br />
					<input type="text" name="passRegistro" id="passRegistro" class="input" size="25" tabindex="20" /></label>
				</p>
				<p>
					<label><?php echo Empresa ?><br />
					<input type="text" name="empresaRegistro" id="empresaRegistro" class="input" size="25" tabindex="20" /></label>
				</p>					
				<p id="reg_passmail"><?php _e('A password will be e-mailed to you.') ?></p>
				<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register'); ?>" tabindex="100" /></p>
				<input type="hidden" name="accion" value="registrar" />
			</form>
			</div>
			
			
            <!--<ul class="xoxo">-->
                <?php //dynamic_sidebar('primary_widget_area'); ?>
            <!--</ul>-->
        </div><!-- #primary .widget-area -->
		

<?php endif; ?>      
