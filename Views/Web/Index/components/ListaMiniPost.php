<small class="loop-subtitle global-subtitle">publicaciones anteriores</small>
<div class="loop-wrap">
    <?php foreach ($data['componentes']['listaminipost']['content'] as $value) {
    ?>
        <article class="item">
            <div class="item-image global-image global-image-orientation global-radius">
                <a href="we-are-stronger-as-a-group-than-an-individual-2/index.html" class="global-link" aria-label="We are stronger as a group than an individual"></a>
                <img srcset="
                      <?php echo $value['pos_img'] ?> 300w,
                      <?php echo $value['pos_img'] ?> 600w
                    " sizes="(max-width:480px) 300px, 600px" src="<?php echo $value['pos_img'] ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>" />
            </div>
            <div class="item-content">
                <div class="item-tags global-tags">
                    <?php
                    foreach ($value['pos_tag'] as $item) {
                    ?>
                        <a href="<?php echo $item['tag_slug'] ?>"><?php echo $item['tag_name'] ?></a>
                    <?php
                    }
                    ?>
                </div>
                <h2 class="item-title">
                    <a href="<?php echo $value['pos_slug'] ?>"><?php echo $value['pos_name'] ?></a>
                </h2>
                <p class="item-excerpt global-excerpt">
                    <?php echo $value['pos_extract'] ?>
                </p>
                <div class="global-meta">
                    <div class="global-meta-content">
                        by
                        <a href="<?php echo urls_amigables($value['usu_nombre']) ?>"><?php echo $value['usu_nombre'] ?></a>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>
</div>

<div class="pagination-section">
    <a href="page/2/index.html" aria-label="Mostrar más"></a>
    <button class="global-button">Mostrar más</button>
</div>