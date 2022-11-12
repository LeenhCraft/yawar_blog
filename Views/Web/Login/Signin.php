<?php headerWeb('HeaderLogin', $data); ?>
<div class="custom-wrap">
    <div class="custom-container">
        <div class="custom-logo-wrap">
            <div class="custom-logo global-logo is-header">
                <a href="<?php echo base_url(); ?>" class="is-logo"><img src="https://via.placeholder.com/85x34" alt="<?php echo NOMBRE_EMPRESA ?>" /></a>
            </div>
        </div>
        <div class="custom-content">
            <form id="frmLogin" onsubmit="inisiar_sesion(this,event)"><?php /* el form debe tener la clase "error" para mostrar el div con el error*/ ?>
                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                <div class="form">
                    <h1 class="custom-title text-capitalize">bienvenido!</h1>
                    <input type="email" id="txtusuario" name="txtusuario" placeholder="Ingresa tu email" />
                    <input type="password" id="txtpass" name="txtpass" placeholder="Contraseña" autocomplete="off">
                    <button class="global-button" type="submit">
                        Iniciar Sesión
                    </button>
                    <div>
                        <small class="alert-loading global-alert">Procesando su petición</small>
                        <small class="alert-error global-alert">Ocurrio un error al tratar de iniciar sesión <br>por favor intentelo más tarde</small>
                    </div>
                </div>
                <div class="alert-success d-none">
                    <h2 class="global-title">Bienvenido!</h2>
                    <p>
                        Redireccionando.
                    </p>
                </div>
                <small class="global-question">
                    <span>¿Aún no tienes una cuenta?</span>
                    <a href="<?php echo base_url() . 'Signup'; ?>">Crear Cuenta</a>
                </small>
            </form>
        </div>
    </div>
    <div class="custom-image global-bg-image" style="background-image: url(https://via.placeholder.com/2000x2500);"></div>
</div>
<?php footerWeb('FooterLogin', $data); ?>