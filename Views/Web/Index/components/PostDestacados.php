<small class="global-subtitle">PUBLICACIONES DESTACADAS</small>
<div class="featured-section global-radius is-gray-accent">
    <div class="global-cover is-featured" style="background-image: 
    url(<?php
        if (isset($data['imgBackDes']) && !empty($data['imgBackDes'])) {
            echo path_recursos() . $data['imgBackDes']['img_url'];
        } else {
            echo path_img_404();
        }
        ?>);">
    </div>

    <small class="featured-subtitle">Recomendación del Editor</small>
    <h2 class="featured-title">Comienza con nuestras mejores historias</h2>
    <div class="featured-content items-3 global-dynamic-color">
        <?php foreach ($data['componentes']['postdestacados']['content'] as $value) { ?>
            <article class="item">
                <a href="<?php echo path_post() . $value['pos_slug'] ?>" class="global-link" aria-label="<?php echo $value['pos_name'] ?>"></a>
                <div class="item-image global-image global-image-orientation global-radius">
                    <img src="<?php echo path_recursos() . $value['pos_img']; ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>">
                </div>
                <div class="item-content">
                    <h2 class="item-title">
                        <a href="<?php echo path_post() . $value['pos_slug'] ?>"><?php echo $value['pos_name'] ?></a>
                    </h2>
                    <div class="global-meta">
                        <div class="global-meta-content">
                            by
                            <a href="<?php echo path_author() . urls_amigables($value['usu_nombre']) ?>"><?php echo $value['usu_nombre'] ?></a>
                        </div>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
    <?php
    /*<div class="featured-button-wrap">
        <a href="featured/index.html" class="featured-button">See all featured posts →</a>
    </div>*/
    ?>
</div>