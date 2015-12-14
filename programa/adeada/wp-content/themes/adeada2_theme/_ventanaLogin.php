<?php
/****************************************************************************************************/
/* include: _ventanaLogin.php
/* Theme: tarificador
/* Descripción: ventana para el acceso
/*
/* Control de versiones:
/* --------------------------------------------------------------------
/* Autor					Fecha				Acción                                                                          
/*
/* Digital5 S.L.		30/06/2011	Creación               
/*
/****************************************************************************************************/
?>

				<div id="ventana-login">
					<div class="cerrar-ventana"><a id="link-cerrar-ventana-login">[ x ]</a></div>
					<div class="contenido-ventana">
						<p>
						<input type="text" class="obligatiorio usuario-login" id="loginUsuario"  name="loginUsuario" value="" />
						email:
						</p>
						<p>
						<input type="password" class="obligatiorio usuario-clave" id="passUsuario"  name="passUsuario" value="" />
						clave:
						</p>
						<p><a href="#" id="link-validar-usuario" class="validar-login">validar &gt;&gt;</a></p>
						<?php 
							/*
							$args = array (
								'echo' => true,
								'redirect' => get_permalink(), 
								'form_id' => 'loginform',
								'label_username' => __( 'Username' ),
								'label_password' => __( 'Password' ),
								'label_remember' => __( 'Remember Me' ),
								'label_log_in' => __( 'Log In' ),
								'id_username' => 'user_login',
								'id_password' => 'user_pass',
								'id_remember' => 'rememberme',
								'id_submit' => 'wp-submit',
								'remember' => true,
								'value_username' => NULL,
								'value_remember' => false,
							);
							wp_login_form($args);
							*/
							//login_with_ajax();
						?>
					</div>
				</div>