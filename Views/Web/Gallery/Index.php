<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <article class="post-section">
        <div class="post-wrap global-padding">
            <div class="post-content">
                <h2 id="gallery">Galeria <?php echo $data['gallery']['ga_name'] ?></h2>
                <?php
                if (!empty($data['post'])) {
                ?>
                    <p class="global-subtitle" style="margin: 0;">Yawar Post asociado.</p>
                    <figure class="kg-card kg-bookmark-card" style="margin-top: 0;"><a class="kg-bookmark-container" href="<?php echo path_post() . $data['post']['pos_slug'] ?>">
                            <div class="kg-bookmark-content">
                                <div class="kg-bookmark-title"><?php echo $data['post']['pos_name'] ?></div>
                                <div class="kg-bookmark-description"><?php echo $data['post']['pos_extract'] ?></div>
                                <div class="kg-bookmark-metadata"><img class="kg-bookmark-icon" src="#" alt=""><span class="kg-bookmark-author">by <?php echo $data['post']['usu_nombre'] ?></span></div>
                            </div>
                            <div class="kg-bookmark-thumbnail"><img src="<?php echo $data['post']['pos_img'] ?>" alt=""></div>
                        </a>
                    </figure>
                <?php
                }
                ?>
                <figure class="kg-card kg-gallery-card kg-width-wide">
                    <div class="kg-gallery-container">
                        <?php
                        if (!empty($data['images'])) {
                        ?>
                            <div class="kg-gallery-row grid-1">
                                <?php
                                $num = count($data['images']);

                                foreach ($data['images'] as $img) {
                                ?>
                                    <div class="kg-gallery-imagee">
                                        <img src="<?php echo $img['img_url'] ?>" alt="<?php echo $data['gallery']['ga_name'] ?>">
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                        <?php
                        } else {
                            echo '<p>No hay imagenes en esta galeria.</p>';
                        }
                        ?>
                    </div>
                </figure>
            </div>
        </div>
    </article>
</main>
<?php footerWeb('FooterWeb', $data); ?>