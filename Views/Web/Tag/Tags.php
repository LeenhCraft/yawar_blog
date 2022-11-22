<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <div class="post-header">
        <div class="post-header-wrap global-padding is-center">
            <div class="post-header-content">
                <h1 class="post-title global-title">Yawar Etiquetas</h1>
            </div>
        </div>
    </div>
    <div class="custom-archive global-padding">
        <small class="global-subtitle">Explora nuestras etiquetas
            <?php
            if (isset($_SESSION['pe'])) {
                if (isset($_SESSION['_cf'])) {
            ?>
                    <button class="global-button global-button-sm" onclick="newTag(this,event)">nuevo</button>
            <?php
                }
            }
            ?>
        </small>
        <div class="loop-wrap is-tags">
            <div class="custom-archive-item item new-tag" style="max-width: 200px; display: none;">
                <form onsubmit="saveTag(this,event)">
                    <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <input accept="image/*" name="img" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                        <img class="new-tag-img" src="https://via.placeholder.com/200x140" alt="Nueva imagen">
                    </div>
                    <div class="item-content">
                        <h2 class="item-title"><a href="#"><input name="newtag" type="text" placeholder="Nuevo etiqueta"></a></h2>
                        <button style="max-width: 50px;" class="global-button global-button-sm" type="submit">crear</button>
                    </div>
                </form>
            </div>
            <?php
            foreach ($data['tags'] as $tag) {
            ?>
                <div class="custom-archive-item item">
                    <div class="item-image global-image global-image-orientation global-radius">
                        <a href="<?php echo path_tag() . $tag['tag_slug']; ?>" class="global-link" aria-label="<?php echo  $tag['tag_name']; ?>"></a>
                        <img src="<?php echo path_recursos() . 'Webp/' . $tag['tag_img'] ?>" alt="<?php echo  $tag['tag_name']; ?>">
                    </div>
                    <div class="item-content">
                        <h2 class="item-title"><a href="<?php echo path_tag() . $tag['tag_slug']; ?>"><?php echo  $tag['tag_name']; ?></a></h2>
                        <small><?php echo  $tag['tag_cantpost']; ?> Posts</small>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>