<div class="widget-section global-padding">
    <small class="global-subtitle">Secciones Populares</small>
    <div class="widget-wrap is-tags" sstyle="display: flex; justify-content: center;">
        <?php foreach ($data['componentes']['listaetiquetas']['content'] as $tag) {
            // dep($tag);
        ?>
            <a href="<?= path_tag() . $tag['tag_slug'] ?>" class="item global-image-orientation global-radius">
                <h2 class="item-title"><?= $tag['tag_name'] ?></h2>
                <div class="widget-image global-image">
                    <img src="<?php echo path_recursos() . $tag['tag_img'] ?>" alt="<?php echo $tag['tag_name'] ?>" />
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</div>