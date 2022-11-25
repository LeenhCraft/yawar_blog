<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <div class="post-header">
        <div class="post-header-wrap global-padding is-center is-archive-image">
            <div class="post-header-content custom-content-leenh">
                <?php
                if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                ?>
                    <form id="img" class="formtag" onsubmit="updTag(this,event)">
                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                            <small class="alert-success global-im">Procesando su petición</small>
                            <small class="alert-error global-im"></small>
                        </div>
                    <?php
                }
                    ?>
                    <div class="archive-image global-image" style="position: relative;">
                        <?php
                        if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                        ?>
                            <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                            <input type="hidden" name="_tag" value="<?php echo $data['tag']['idtag'] ?>">
                            <input accept="image/*" name="img" type="file" class="upload-button__input" onchange="updImgTag(this,event)">
                        <?php
                        }
                        ?>
                        <img src="<?php echo path_recursos() . 'Webp/' . $data['tag']['tag_img'] ?>" alt="<?php echo $data['tag']['tag_name'] ?>">
                    </div>
                    <?php
                    if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                    ?>
                        <h1 class="post-title global-title">
                            <input class="text-center" style="max-width: 100%;" type="text" name="tagname" value="<?php echo $data['tag']['tag_name'] ?>">
                        </h1>
                    <?php
                    } else {
                    ?>
                        <h1 class="post-title global-title"><?php echo $data['tag']['tag_name'] ?></h1>
                    <?php
                    }
                    ?>
                    <p class="post-excerpt global-excerpt d-none">descrip</p>
                    <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?></form><?php } ?>
            </div>
        </div>
    </div>
    <div class="loop-section global-padding">
        <small class="global-subtitle"><?php echo $data['tag']['tag_cantpost'] . ' posts' ?></small>
        <div class="loop-wrap">
            <?php
            foreach ($data['posts'] as $post) {
            ?>
                <article class="item">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <a href="<?php echo path_post() . $post['pos_slug'] ?>" class="global-link" aria-label="<?php echo $post['pos_name'] ?>"></a>
                        <img srcset="<?php echo $post['pos_img'] ?> 300w, 
			 <?php echo $post['pos_img'] ?> 600w" sizes="(max-width:480px) 300px, 600px" src="<?php echo $post['pos_img'] ?>" loading="lazy" alt="<?php echo $post['pos_name'] ?>">
                    </div>
                    <div class="item-content">
                        <div class="item-tags global-tags">
                            <?php foreach ($post['pos_tag'] as $tag) {
                            ?>
                                <a href="<?php echo path_tag() . $tag['tag_slug'] ?>"><?php echo $tag['tag_name'] ?></a>
                            <?php
                            } ?>

                        </div>
                        <h2 class="item-title"><a href="<?php echo path_post() . $post['pos_slug'] ?>"><?php echo $post['pos_name'] ?></a></h2>
                        <p class="item-excerpt global-excerpt">
                            <?php echo $post['pos_extract'] ?>
                        </p>
                        <div class="global-meta">
                            <div class="global-meta-content">
                                by
                                <a href="<?php echo path_author() . urls_amigables($post['usu_nombre']) ?>"><?php echo $post['usu_nombre'] ?></a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
            }
            ?>

        </div>
    </div>
    <?php
    if (count($data['posts']) > 0) {
    ?>
        <div class="pagination-section">
            <a href="page/2/index.html" aria-label="Load more"></a>
            <button class="global-button">Load more</button>
        </div>
    <?php
    }
    ?>
</main>
<?php footerWeb('FooterWeb', $data); ?>