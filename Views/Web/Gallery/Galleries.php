<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <div class="post-header">
        <div class="post-header-wrap global-padding is-center">
            <div class="post-header-content">
                <h1 class="post-title global-title">Yawar Galerias</h1>
            </div>
        </div>
    </div>
    <div class="custom-archive global-padding">
        <small class="global-subtitle">Explora nuestras galerias
            <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                <button class="global-button global-button-sm" onclick="newGal(this,event)">nuevo</button>
            <?php } ?>
        </small>
        <div class="loop-wrap is-tags">
            <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                <div class="custom-archive-item item new-tag" style="max-width: 200px; display: none;">
                    <form onsubmit="saveGal(this,event)">
                        <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                        <div class="item-image global-image global-image-orientation global-radius">
                            <input accept="image/*" name="img" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                            <img class="new-tag-img" src="https://via.placeholder.com/200x140" alt="Nueva imagen">
                        </div>
                        <div class="item-content">
                            <h2 class="item-title"><a href="#"><input name="newgal" type="text" placeholder="Nuevo galeria"></a></h2>
                            <button style="max-width: 50px;" class="global-button global-button-sm" type="submit">crear</button>
                        </div>
                    </form>
                </div>
            <?php }
            foreach ($data['galleries'] as $gallery) {
            ?>
                <div class="custom-archive-item item">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <a href="<?php echo path_gallery() . $gallery['ga_slug']; ?>" class="global-link" aria-label="<?php echo  $gallery['ga_name']; ?>"></a>
                        <img src="<?php echo path_recursos() . $gallery['ga_img_port'] ?>" alt="<?php echo  $gallery['ga_name']; ?>">
                    </div>
                    <div class="item-content">
                        <h2 class="item-title"><a href="<?php echo path_gallery() . $gallery['ga_slug']; ?>"><?php echo  $gallery['ga_name']; ?></a></h2>
                        <small class="d-none"><?php echo  $gallery['idgalery']; ?> Posts</small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>