<?php headerWeb('HeaderWeb', $data); ?>
<div class="global-content">
    <main class="global-main">
        <div class="account-section global-padding">
            <div class="post-header">
                <div class="post-header-wrap global-padding is-center is-archive-image">
                    <div class="post-header-content">
                        <div class="archive-image global-image global-dynamic-color is-account">
                            <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd">
                                <path d="M1.631 23.361l-.001-.078c0-5.723 4.647-10.37 10.37-10.37 5.723 0 10.37 4.647 10.37 10.37l-.001.078h-1.5l.001-.078c0-4.895-3.975-8.87-8.87-8.87s-8.87 3.975-8.87 8.87l.001.078h-1.5zM12 .639a5.657 5.657 0 015.654 5.655A5.657 5.657 0 0112 11.948a5.657 5.657 0 01-5.654-5.654A5.657 5.657 0 0112 .639zm0 1.5a4.156 4.156 0 010 8.309 4.156 4.156 0 010-8.309z"></path>
                            </svg>
                            <?php if ($data['user']['usu_foto'] != '') {
                            ?>
                                <img src="<?php echo path_recursos() . 'mini/' . $data['user']['usu_foto'] ?>" alt="<?php echo $data['user']['usu_nombre'] ?>">
                            <?php
                            } ?>
                        </div>
                        <h1 class="post-title global-title"><?php echo $data['user']['usu_nombre'] ?></h1>
                        <p class="post-excerpt global-excerpt">
                        </p>
                    </div>
                </div>
            </div>
            <div class="account-details">
                <small class="global-subtitle">Detalles de la cuenta</small>
                <div class="account-details-wrap global-radius">
                    <div class="account-details-content">
                        <div class="account-detail-column">
                            <div>
                                <label class="account-detail-heading">Correo electrónico</label>
                                <span class="account-detail-content"><?php echo $data['user']['usu_usuario'] ?></span>
                            </div>
                        </div>
                        <div class="account-detail-column">
                            <div>
                                <label class="account-detail-heading">Celular</label>
                                <span class="account-detail-content"><?php echo $data['user']['usu_cel'] ?></span>
                            </div>
                        </div>
                        <?php if ($data['user']['usu_activo'] == '0') { ?>
                            <div class="account-detail-column">
                                <div>
                                    <label class="account-detail-heading">Cuenta sin activar</label>
                                    <span class="account-detail-content">Por favor revise su bandeja de entrada y haga clic en el enlace para confirmar su registro.</span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="account-signout-wrap">
                            <a class="global-button" href="<?php echo base_url() . 'Logout' ?>">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
                <div class="account-buttons d-none">
                    <a href="javascript:" class="account-button gh-portal-open" data-portal="account">Account settings</a>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['pe']) && isset($_SESSION['_cf'])) { ?>
            <div class="account-section global-padding">
                <div class="account-details">
                    <div class="card mb-4">
                        <small class="global-subtitle">Configuraciones web</small>
                        <div class="account-details-wrap global-radius">
                            <div class="account-details-content custom-content-leenh">
                                <form id="img" onsubmit="save(this,event)">
                                    <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                    <div class="post-header">
                                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                                            <small class="alert-success global-im">Procesando su petición</small>
                                            <small class="alert-error global-im"></small>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgLogo" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)" />
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Logo de la web</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 100x50px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['logo']['img_url']) ? $data['logo']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['logo']['img_url'])) {
                                                                if (file_exists(__DIR__ . '/../../Medios/Webp/' . $data['logo']['img_url'])) {
                                                                    $size = filesize(__DIR__ . '/../../Medios/Webp/' . $data['logo']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['logo']['img_url']) ?  path_recursos() . 'Webp/' . $data['logo']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgBackWeb" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Imagen de fondo web</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 1600x1030px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['backImg']['img_url']) ? $data['backImg']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['backImg']['img_url'])) {
                                                                if (file_exists(__DIR__ . '/../../Medios/Webp/' . $data['backImg']['img_url'])) {
                                                                    $size = filesize(__DIR__ . '/../../Medios/Webp/' . $data['backImg']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['backImg']['img_url']) ?  path_recursos() . 'Webp/' . $data['backImg']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgBackDes" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Imagen de fondo Seccion destacados</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 1600x1030px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['backDes']['img_url']) ? $data['backDes']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['backDes']['img_url'])) {
                                                                if (file_exists(__DIR__ . '/../../Medios/Webp/' . $data['backDes']['img_url'])) {
                                                                    $size = filesize(__DIR__ . '/../../Medios/Webp/' . $data['backDes']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['backDes']['img_url']) ?  path_recursos() . 'Webp/' . $data['backDes']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <button type="submit" class="global-button">guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($data['postsusuario'])) { ?>
            <div class="special-section global-padding">
                <small class="global-subtitle">Tus últimas publicaciones</small>
                <div class="special-wrap">
                    <?php
                    foreach ($data['postsusuario'] as $value) {

                    ?>
                        <article class="item is-special">
                            <div class="item-image global-image global-image-orientation global-radius">
                                <a href="<?php echo path_post() . $value['pos_slug'] ?>" class="global-link"></a>
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
                                        <a href="<?php echo path_tag() . $item['tag_slug'] ?>"><?php echo $item['tag_name'] ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <h2 class="item-title">
                                    <a href="<?php echo path_post() . $value['pos_slug'] ?>"><?php echo $value['pos_name'] ?></a>
                                </h2>
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
                <hr>
            </div>
        <?php } ?>
        <div class="special-section global-padding">
            <small class="global-subtitle">Últimas publicaciones</small>
            <div class="special-wrap">
                <?php
                foreach ($data['posts'] as $value) {

                ?>
                    <article class="item is-special">
                        <div class="item-image global-image global-image-orientation global-radius">
                            <a href="<?php echo path_post() . $value['pos_slug'] ?>" class="global-link"></a>
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
                                    <a href="<?php echo path_tag() . $item['tag_slug'] ?>"><?php echo $item['tag_name'] ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <h2 class="item-title">
                                <a href="<?php echo path_post() . $value['pos_slug'] ?>"><?php echo $value['pos_name'] ?></a>
                            </h2>
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
        </div>
    </main>
</div>
<?php footerWeb('FooterWeb', $data); ?>