<div class="footer-content">
    <div class="footer-logo-wrap">
        <div class="global-logo is-footer">
            <a href="<?php echo base_url(); ?>" class="is-logo">
                <img src="<?php echo isset($logo['img_url']) ? path_recursos() . 'Webp/' . $logo['img_url'] : 'https://via.placeholder.com/85x35' ?>" alt="<?php echo NOMBRE_EMPRESA ?>">
            </a>
        </div>
        <p class="footer-description">
            <?php echo $data['componentes']['esloganfooter']['content']['sl_name'] ?>
        </p>
    </div>
    <div class="footer-subscribe">
        <a href="membership/index.html" class="global-button">Become a subscriber →</a>
        <small>Get all the latest posts delivered straight to your
            inbox.</small>
    </div>
</div>