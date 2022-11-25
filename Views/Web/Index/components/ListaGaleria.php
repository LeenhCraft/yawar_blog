<div class="special-section global-padding">
    <small class="global-subtitle">tambien podria gustarte nuestra galeria</small>
    <div class="special-wrap">
        <?php
        foreach ($data['componentes']['listagaleria']['content'] as $value) {
        ?>
            <article class="item is-special">
                <div class="item-image global-image global-image-orientation global-radius">
                    <a href="<?php echo path_gallery() . $value['ga_slug'] ?>" class="global-link" aria-label="You have to fight to reach your dream"></a>
                    <img src="<?php echo path_recursos() . 'Webp/' . $value['ga_img'] ?>" loading="lazy" alt="<?php echo $value['ga_name'] ?>">
                </div>
                <div class="item-content">
                    <h2 class="item-title">
                        <a href="<?php echo $value['ga_slug'] ?>"><?php echo $value['ga_name'] ?></a>
                    </h2>
                    <div class="global-meta d-none">
                        <div class="global-meta-content">
                            by
                            <a href="#">Leenh A.</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</div>