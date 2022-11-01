<div class="widget-section global-padding">
    <small class="global-subtitle">Secciones Populares</small>
    <div class="widget-wrap is-tags" sstyle="display: flex; justify-content: center;">
        <?php foreach ($data['componentes']['listaetiquetas']['content'] as $tag) {
            // dep($tag);
        ?>
            <a href="<?= $tag['tag_slug'] ?>" class="item global-image-orientation global-radius">
                <h2 class="item-title"><?= $tag['tag_name'] ?></h2>
                <div class="widget-image global-image">
                    <img src="<?= $tag['tag_img'] ?>" alt="<?= $tag['tag_name'] ?>" />
                </div>
            </a>
        <?php
        } ?>
        <!-- <a href="tag/architecture/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Architecture</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a>
        <a href="tag/design/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Design</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a>
        <a href="tag/modern/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Modern</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a>
        <a href="tag/concepts/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Concepts</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a>
        <a href="tag/review/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Review</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a>
        <a href="tag/story/index.html" class="item global-image-orientation global-radius">
            <h2 class="item-title">Story</h2>
            <div class="widget-image global-image">
                <img src="https://via.placeholder.com/187x31" alt="" />
            </div>
        </a> -->
    </div>
</div>