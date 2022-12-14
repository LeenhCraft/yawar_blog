<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <div id="preloder" style="display: none;">
        <div class="loader"></div>
    </div>
    <article class="post-section">
        <div class="post-wrap global-padding">
            <div class="post-content custom-content-leenh">
                <?php
                if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                ?>
                    <form id="frmGal" class="formgal error" onsubmit="updGal(this,event)">
                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                            <small class="alert-success global-im"></small>
                            <small class="alert-error global-im"></small>
                        </div>
                        <h2>
                            <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                            <input type="hidden" name="_gal" value="<?php echo $data['gallery']['idgalery'] ?>">
                            <input style="max-width: 100%;font-weight: var(--font-weight-one-bold);" type="text" name="galname" value="<?php echo $data['gallery']['ga_name'] ?>" placeholder="Titulo de la Galeria">
                        </h2>
                        <!-- </form> -->

                    <?php
                } else {
                    ?>
                        <h2 id="gallery">Galeria <?php echo $data['gallery']['ga_name'] ?></h2>
                    <?php
                }
                    ?>
                    <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                        <div class="mb-4">
                            <!-- <form id="img" class="mb-4" onsubmit="updGal(this,event)"> -->
                            <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                            <input type="hidden" name="_gal" value="<?php echo $data['gallery']['idgalery'] ?>">
                            <div class="upload-button kg-file-card-container global-radius mb-4">
                                <input name="img" multiple accept="image/*" type="file" class="upload-button__input" oonchange="viewImgGal(this,event)" onchange="updImgGal(this,event)" />
                                <div class="upload-button__icon">
                                    <div class="kg-file-card-contents">
                                        <div class="kg-file-card-title">Portada de la Galeria</div>
                                        <div class="kg-file-card-caption f-s">
                                            Tama??o recomendado 1280x720px
                                        </div>
                                        <div class="kg-file-card-metadata">
                                            <div class="kg-file-card-filename">
                                                <?php echo isset($data['gallery']['ga_img_port']) ? $data['gallery']['ga_img_port'] : ''; ?>
                                            </div>
                                            <div class="kg-file-card-filesize">
                                                <?php
                                                if (isset($data['gallery']['ga_img_port'])) {
                                                    if (file_exists(dir_recursos() . $data['gallery']['ga_img_port'])) {
                                                        $size = filesize(dir_recursos() . $data['gallery']['ga_img_port']);
                                                        echo number_format($size / 1024, 2) . " KB";
                                                    } else {
                                                        echo "0 KB";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                    <img src="<?php echo  path_recursos() . $data['gallery']['ga_img_port']; ?>" alt="cargando..." width="40">
                                </div>
                            </div>
                            <div class="my-4 row px-4">
                                <label class="content-input">
                                    <?php $checked = isset($data['gallery']['ga_publicar']) && $data['gallery']['ga_publicar'] == 1 ? 'checked' : ''; ?>
                                    <input type="checkbox" name="publicar" <?php echo $checked; ?>>
                                    <i></i>
                                    <span style="opacity: var(--opacity-one);">Publicar</span>
                                </label>
                                <label class="content-input ml-4">
                                    <?php $checked = isset($data['gallery']['ga_status']) && $data['gallery']['ga_status'] == 1 ? 'checked' : ''; ?>
                                    <input type="checkbox" name="status" <?php echo $checked; ?>>
                                    <i></i>
                                    <span style="opacity: var(--opacity-one);">Estado</span>
                                </label>
                            </div>
                            <div class="text-cente">
                                <button class="global-button">Guardar</button>
                            </div>
                            <!-- </form> -->
                        </div>
                    </form>
                <?php } ?>
                <?php
                if (!empty($data['post'])) {
                    // if (false) {
                ?>
                    <p class="global-subtitle" style="margin: 0;">Yawar Post asociado.</p>
                    <figure class="kg-card kg-bookmark-card">
                        <a class="kg-bookmark-container" href="<?php echo path_post() . $data['post']['pos_slug']; ?>">
                            <div class="kg-bookmark-content">
                                <div class="kg-bookmark-title"><?php echo $data['post']['pos_name'] ?></div>
                                <div class="kg-bookmark-description"><?php echo $data['post']['pos_extract']; ?></div>
                                <div class="kg-bookmark-metadata">
                                    <span class="kg-bookmark-author">by <?php echo $data['post']['usu_nombre'] ?></span>
                                </div>
                            </div>
                            <div class="kg-bookmark-thumbnail"><img src="<?php echo path_recursos() . $data['post']['pos_img'] ?>" alt="<?php echo $data['post']['pos_name'] ?>"></div>
                        </a>
                        <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                            <div class="account-buttons my-4">
                                <a id="btnpostaso" href="javascript:editPostAso(this,event)" class="account-button gh-portal-open">Editar post asociado</a>
                                <a id="btnpostaso" href="javascript:delPostAso(<?php echo $data['post']['idpost'] . ',' . $data['gallery']['idgalery']; ?>)" class="account-button gh-portal-open">Eliminar post asociado</a>
                                <div class="search-form-leenh is-hide" style="width: 100%;display: none;">
                                    <form class="search-form" onkeyup="postAso(this,event)">
                                        <input class="search-input search-input-leenh" type="text" placeholder="Buscar..." id="txtbuscar" name="txtbuscar">
                                        <div class="search-meta">
                                            <span class="search-info">Por Favor introduzca al menos 3 caracteres</span>
                                            <span class="search-counter is-hide">
                                                <span>10</span> resultados de tu busqueda
                                            </span>
                                        </div>
                                    </form>
                                    <div class="search-results global-image" style="max-height: 210px; overflow: auto;"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </figure>
                <?php
                } else {
                ?>
                    <figure class="kg-card kg-bookmark-card" style="margin-top: 0;">
                        <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                            <div class="account-buttons m-0">
                                <a id="btnpostaso" href="javascript:editPostAso(this,event)" class="account-button gh-portal-open">Asociar post</a>
                                <div class="search-form-leenh is-hide" style="width: 100%;display: none;">
                                    <form class="search-form" onkeyup="postAso(this,event)">
                                        <input class="search-input search-input-leenh" type="text" placeholder="Buscar..." id="txtbuscar" name="txtbuscar">
                                        <div class="search-meta">
                                            <span class="search-info">Por Favor introduzca al menos 3 caracteres</span>
                                            <span class="search-counter is-hide">
                                                <span>0</span> resultados de tu busqueda
                                            </span>
                                        </div>
                                    </form>
                                    <div class="search-results global-image" style="max-height: 210px; overflow: auto;"></div>
                                </div>
                            </div>
                        <?php } ?>
                    </figure>
                <?php
                }
                if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) {
                ?>
                    <hr class="m-0">
                <?php } ?>
                <figure class="kg-card kg-gallery-card kg-width-wide m-0 mt-4">
                    <div class="kg-gallery-container">
                        <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                            <form id="img" onsubmit="addImgGal(this,event)">
                                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                <input type="hidden" name="_gal" value="<?php echo $data['gallery']['idgalery'] ?>">
                                <div class="upload-button kg-file-card-container global-radius mb-4">
                                    <input name="img[]" multiple accept="image/*" type="file" class="upload-button__input" onchange="viewImgGal(this,event)" />
                                    <div class="upload-button__icon">
                                        <div class="kg-file-card-contents">
                                            <div class="kg-file-card-title">Agregar imagen a la galeria</div>
                                            <div class="kg-file-card-caption f-s">
                                                Tama??o recomendado 1280x720px
                                            </div>
                                            <div class="kg-file-card-metadata">
                                                <div class="kg-file-card-filename">-</div>
                                                <div class="kg-file-card-filesize">-</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                        <img src="<?php echo isset($data['logo']['img_url']) ?  path_recursos() . $data['logo']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                    </div>
                                </div>
                            </form>
                        <?php }
                        if (!empty($data['images'])) {
                        ?>
                            <div class="kg-gallery-row grid-1 mb-4">
                                <?php
                                $num = count($data['images']);
                                foreach ($data['images'] as $img) {
                                ?>
                                    <div class="kg-gallery-imagee">
                                        <img src="<?php echo path_recursos() . img_gallery() . $img['img_url'] ?>" alt="<?php echo $data['gallery']['ga_name'] ?>">
                                        <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
                                            <div class="account-buttons" style="margin: 0 0 2rem 0; text-align: right;">
                                                <a href="javascript:delImgGal(<?php echo $img['idimage'] . ',' . $data['gallery']['idgalery']; ?>)" style="width: 100%;">eliminar foto</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            echo paginador($data['count'], $data['limite'], $data['pagina'], $data['url']);
                            ?>
                            <div class="pagination-section d-none">
                                <a class="global-button" href="<?php echo path_post() . 'pagina/' ?>">Siguiente pagina</a>
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