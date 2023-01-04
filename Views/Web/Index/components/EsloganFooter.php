<div class="footer-content">
    <div class="footer-logo-wrap">
        <div class="global-logo is-footer">
            <a href="<?php echo base_url(); ?>" class="is-logo">
                <img src="<?php echo isset($logo['img_url']) ? path_recursos() . img_logo() . $logo['img_url'] : path_img_404() ?>" alt="<?php echo NOMBRE_EMPRESA ?>">
            </a>
        </div>
        <p class="footer-description">
            <?php echo $data['componentes']['esloganfooter']['content']['sl_name'] ?>
        </p>
    </div>
    <div class="footer-subscribe d-none">
        <a href="<?php echo base_url() . 'Signup'; ?>" class="global-button">Crear Cuenta →</a>
    </div>
</div>