<?php headerWeb('HeaderWeb', $data); ?>
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
</style>
<main class="global-main">
    <div class="container">
        <div class="loop-wrap">
            <?php foreach ($data['posts'] as $value) {
            ?>
                <article class="item">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <a href="<?php echo path_post() . $value['pos_slug'] ?>" class="global-link" aria-label="We are stronger as a group than an individual"></a>
                        <img src="<?php echo path_recursos() . 'Webp/' . $value['pos_img']; ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>">
                    </div>
                    <div class="item-content">
                        <?php
                        if (isset($_SESSION['_cf'])) {
                        ?>
                            <div class="global-tags mb-4">
                                <?php
                                if ($value['pos_publicar'] == 0) {
                                    $text =  $value['pos_publicar'] == 1 ? 'Publicado' : 'No publicado';
                                ?>
                                    <span class="py-3 px-4 bg-theme global-border" style="font-size: 1.2rem;"><?php echo $text ?></span>
                                <?php
                                }
                                ?>
                                <?php
                                if ($value['pos_status'] == 0) {
                                    $text =  $value['pos_status'] == 1 ? 'Activo' : 'Inactivo';
                                ?>
                                    <span class="py-3 px-4 bg-theme global-border" style="font-size: 1.2rem;"><?php echo $text ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="item-tags global-tags">
                            <?php
                            foreach ($value['pos_tag'] as $item) {
                            ?>
                                <a href="<?php echo path_tag() . $item['tag_slug'] ?>"><?php echo $item['tag_name'] ?></a>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 class="item-title">
                            <a href="<?php echo path_post() . $value['pos_slug'] ?>"><?php echo $value['pos_name'] ?></a>
                        </h2>
                        <p class="item-excerpt global-excerpt">
                            <?php echo $value['pos_extract'] ?>
                        </p>
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
        <div class="pagination-section">
            <a class="global-button" href="<?php echo base_url() . 'posts/pagina/2' ?>">Siguiente pagina</a>
            <!-- <button class="global-button">Mostrar más</button> -->
        </div>
    </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>