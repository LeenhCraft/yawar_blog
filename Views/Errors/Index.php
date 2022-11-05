<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <div class="custom-error custom-wrap">
        <div class="custom-container">
            <div class="custom-error-content custom-content">
                <h1>404</h1>
                <p class="global-excerpt">Pagina no encontrada</p>
                <a href="/" class="global-button">Volver al inicio</a>
            </div>
        </div>
    </div>
    <div class="loop-section global-padding">
        <small class="global-subtitle">MIRA LAS ÚLTIMAS PUBLICACIONES</small>
        <div class="loop-wrap">
            <?php
            foreach ($data['postrandom'] as $post) {
            ?>
                <article class="item">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <a href="<?php echo path_post() . $post['pos_slug'] ?>" class="global-link" aria-label="<?php echo $post['pos_name'] ?>"></a>
                        <img srcset="<?php echo $post['pos_img'] ?> 300w, 
			 <?php echo $post['pos_img'] ?> 600w" sizes="(max-width:480px) 300px, 600px" src="<?php echo $post['pos_img'] ?>" loading="lazy" alt="<?php echo $post['pos_name'] ?>">
                    </div>
                    <div class="item-content">
                        <div class="item-tags global-tags">
                            <?php
                            foreach ($post['pos_tag'] as $item) {
                            ?>
                                <a href="<?php echo path_tag() . $item['tag_slug'] ?>"><?php echo $item['tag_name'] ?></a>
                            <?php
                            }
                            ?>
                        </div>
                        <h2 class="item-title"><a href="<?php echo path_post() . $post['pos_slug'] ?>"><?php echo $post['pos_name'] ?></a></h2>
                        <p class="item-excerpt global-excerpt">
                            <?php echo $post['pos_extract'] ?>
                        </p>
                        <div class="global-meta">
                            <div class="global-meta-content">
                                by
                                <a href="<?php echo path_author().$post['usu_nombre'] ?>"><?php echo $post['usu_nombre'] ?></a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
            }
            ?>
        </div>
    </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>