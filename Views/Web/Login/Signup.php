<?php headerWeb('HeaderLogin', $data); ?>
<div class="custom-wrap">
    <div class="custom-container">
        <div class="custom-logo-wrap">
            <div class="custom-logo global-logo is-header">
                <a href="<?php echo base_url(); ?>" class="is-logo">
                <img src="<?php echo isset($data['logo']['img_url']) ? path_recursos() . 'Webp/' . $data['logo']['img_url'] : 'https://via.placeholder.com/85x35' ?>" alt="<?php echo NOMBRE_EMPRESA ?>">
                </a>
            </div>
        </div>
        <div class="custom-content">
            <form id="frmCreate" onsubmit="registrar_usuario(this,event)">
                <input type="hidden" name="_token" value="<?php echo $data['csrf']; ?>">
                <div class="form">
                    <h1 class="custom-title">Crear Cuenta</h1>
                    <input type="text" name="txtnombre" id="txtnombre" placeholder="Nombre" autocomplete="off">
                    <input type="password" name="txtpass" id="txtpass" placeholder="Contraseña" autocomplete="off">
                    <input type="email" name="txtemail" id="txtemail" placeholder="Email" autocomplete="off">
                    <button class="global-button" type="submit">Continue</button>
                    <div>
                        <small class="alert-loading global-alert">Processing your application</small>
                        <small class="alert-error global-alert">There was an error sending the email</small>
                    </div>
                </div>
                <div class="alert-success d-none">
                    <h2 class="global-title">Excelente!</h2>
                    <p>
                        Por favor revise su bandeja de entrada y haga clic en el enlace para confirmar su registro.
                    </p>
                    <a href="<?php echo base_url() ?>" class="global-button">Volver al Inicio</a>
                </div>
                <small class="global-question"><span>¿Ya tienes una cuenta?</span>
                    <a href="<?php echo base_url() . 'Signin'; ?>">Iniciar Session</a></small>
            </form>

        </div>
    </div>
    <div class="custom-image global-bg-image" style="background-image: url(<?php echo isset($data['imgSignup']['img_url']) ?  path_recursos() . 'Webp/' . $data['imgSignup']['img_url'] : media() . 'svg/upload.svg' ?>);"></div>
</div>
<?php footerWeb('FooterLogin', $data); ?>