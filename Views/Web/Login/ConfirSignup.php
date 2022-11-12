<?php headerWeb('HeaderLogin', $data); ?>
<div class="custom-wrap">
    <div class="custom-container">
        <div class="custom-logo-wrap">
            <div class="custom-logo global-logo is-header">
                <a href="<?php echo base_url(); ?>" class="is-logo"><img src="https://via.placeholder.com/85x34" alt="<?php echo NOMBRE_EMPRESA ?>" /></a>
            </div>
        </div>
        <div class="custom-content">
            <div class="alert-success">
                <h2 class="global-title">Excelente!</h2>
                <p>
                    <?php echo $data['text'] ?>
                </p>
                <a href="<?php echo base_url() ?>" class="global-button">Volver al Inicio</a>
            </div>
        </div>
    </div>
    <div class="custom-image global-bg-image" style="background-image: url(https://via.placeholder.com/2000x2500);"></div>
</div>
<?php footerWeb('FooterLogin', $data); ?>