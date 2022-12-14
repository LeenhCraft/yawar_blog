<?php headerWeb('HeaderWeb', $data); ?>
<div class="global-content">
    <main class="global-main">
        <div class="account-section global-padding">
            <div class="post-header">
                <?php
                if (isset($_SESSION['pe'])) {
                ?>
                    <form id="img" class="formtag">
                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                            <small class="alert-success global-im">Procesando su petición</small>
                            <small class="alert-error global-im"></small>
                        </div>
                    <?php
                }
                    ?>
                    <div class="post-header-wrap global-padding is-center is-archive-image">
                        <div class="post-header-content">
                            <div class="archive-image global-image is-account" style="position: relative;">
                                <?php
                                if (isset($_SESSION['pe'])) {
                                ?>
                                    <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                    <input type="hidden" name="_usr" value="<?php echo $data['user']['idwebusuario'] ?>">
                                    <input accept="image/*" name="img" type="file" class="upload-button__input" oonchange="mostrarImg(this,event)" onchange="updImgAcc(this,event)">
                                <?php
                                }
                                ?>
                                <img src="<?php echo empty($data['user']['usu_foto']) ? path_img_404() : path_recursos() . img_user() . $data['user']['usu_foto']; ?>" alt="<?php echo $data['user']['usu_nombre'] ?>" style="z-index: 0;">
                            </div>
                            <?php
                            if (isset($_SESSION['pe']) && false) {
                            ?>
                                <h1 class="post-title global-title">
                                    <input class="text-center w-100" type="text" name="name" value="<?php echo $data['user']['usu_nombre'] ?>">
                                </h1>
                            <?php
                            } else {
                            ?>
                                <h1 class="post-title global-title"><?php echo $data['user']['usu_nombre'] ?></h1>
                            <?php
                            }
                            ?>
                            <p class="post-excerpt global-excerpt">
                            </p>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['pe'])) { ?>
                    </form>
                <?php } ?>
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
        <?php
        if (isset($_SESSION['pe']) && $_SESSION['lnh'] === '1') { ?>
            <div class="account-details">
                <small class="global-subtitle">root</small>
                <div class="account-details-wrap global-radius">
                    <div class="account-details-content">
                        <?php
                        if (isset($_SESSION['_cf']) && $_SESSION['_cf'] === 'ok') {
                        ?>
                            <form onsubmit="c(this,event)" class="cf">
                                <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                                    <small class="alert-success global-im"></small>
                                    <small class="alert-error global-im"></small>
                                </div>
                                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                <input type="hidden" name="_usr" value="<?php echo $data['user']['idwebusuario'] ?>">
                                <button class="global-button" type="submit">Desactivar</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form onsubmit="c(this,event)" class="cf">
                                <style>
                                    .global-button.no-color,
                                    .global-button.no-color::before {
                                        background-color: #fff;
                                        color: #000;
                                    }
                                </style>
                                <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                                    <small class="alert-success global-im"></small>
                                    <small class="alert-error global-im"></small>
                                </div>
                                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                <input type="hidden" name="_usr" value="<?php echo $data['user']['idwebusuario'] ?>">
                                <button class="global-button no-color" type="submit">Activar</button>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="account-section global-padding">
                <div class="account-details">
                    <div class="card mb-4">
                        <small class="global-subtitle">Configuraciones web</small>
                        <div class="account-details-wrap global-radius">
                            <div class="account-details-content custom-content-leenh">
                                <form id="imgsave" onsubmit="save(this,event)" style="min-width: 100%;">
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
                                                                // if (file_exists(__DIR__ . '/../../Medios/Webp/' . $data['logo']['img_url'])) {
                                                                if (file_exists(dir_recursos() . img_other() . $data['logo']['img_url'])) {
                                                                    $size = filesize(dir_recursos() . img_other() . $data['logo']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['logo']['img_url']) ?  path_recursos() . img_logo() . $data['logo']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
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
                                                                if (file_exists(dir_recursos() . img_other() . $data['backImg']['img_url'])) {
                                                                    $size = filesize(dir_recursos() . img_other() . $data['backImg']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['backImg']['img_url']) ?  path_recursos() . img_other() . $data['backImg']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
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
                                                                if (file_exists(dir_recursos() . img_other() . $data['backDes']['img_url'])) {
                                                                    $size = filesize(dir_recursos() . img_other() . $data['backDes']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['backDes']['img_url']) ?  path_recursos() . img_other() . $data['backDes']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <button type="submit" class="global-button">guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <small class="global-subtitle">Pagina Signin and Signup</small>
                        <div class="account-details-wrap global-radius">
                            <div class="account-details-content custom-content-leenh">
                                <form id="imgsaveSign" onsubmit="saveSign(this,event)" style="min-width: 100%;">
                                    <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                    <div class="post-header">
                                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                                            <small class="alert-success global-im">Procesando su petición</small>
                                            <small class="alert-error global-im"></small>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgSignin" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)" />
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Imagen Signin</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 100x50px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['imgSignin']['img_url']) ? $data['imgSignin']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['imgSignin']['img_url'])) {
                                                                if (file_exists(dir_recursos() . img_other() . $data['imgSignin']['img_url'])) {
                                                                    $size = filesize(dir_recursos() . img_other() . $data['imgSignin']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['imgSignin']['img_url']) ?  path_recursos() . img_other() . $data['imgSignin']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgSignup" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Imagen de Signup</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 1600x1030px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['imgSignup']['img_url']) ? $data['imgSignup']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['imgSignup']['img_url'])) {
                                                                if (file_exists(dir_recursos() . img_other() . $data['imgSignup']['img_url'])) {
                                                                    $size = filesize(dir_recursos() . img_other() . $data['imgSignup']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['imgSignup']['img_url']) ?  path_recursos() . img_other() . $data['imgSignup']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
                                            </div>
                                        </div>
                                        <button type="submit" class="global-button">guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <small class="global-subtitle">Seccion registrar nuevo miembro</small>
                        <div class="account-details-wrap global-radius">
                            <div class="account-details-content custom-content-leenh">
                                <form id="imgSecRegister" onsubmit="saveRegister(this,event)" style="min-width: 100%;">
                                    <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                                    <div class="post-header">
                                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                                            <small class="alert-success global-im">Procesando su petición</small>
                                            <small class="alert-error global-im"></small>
                                        </div>
                                        <div class="upload-button kg-file-card-container global-radius mb-4">
                                            <input name="imgSecRegister" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)" />
                                            <div class="upload-button__icon">
                                                <div class="kg-file-card-contents">
                                                    <div class="kg-file-card-title">Imagen de Sección</div>
                                                    <div class="kg-file-card-caption f-s">
                                                        Tamaño recomendado 200x120px
                                                    </div>
                                                    <div class="kg-file-card-metadata">
                                                        <div class="kg-file-card-filename"><?php echo isset($data['secRegister']['img_url']) ? $data['secRegister']['img_url'] : ''; ?></div>
                                                        <div class="kg-file-card-filesize">
                                                            <?php
                                                            if (isset($data['secRegister']['img_url'])) {
                                                                if (file_exists(__DIR__ . '/../../Medios/Webp/' . $data['secRegister']['img_url'])) {
                                                                    $size = filesize(__DIR__ . '/../../Medios/Webp/' . $data['secRegister']['img_url']);
                                                                    echo number_format($size / 1024, 2) . " KB";
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                                <img src="<?php echo isset($data['secRegister']['img_url']) ?  path_recursos() . img_other() . $data['secRegister']['img_url'] : media() . 'svg/upload.svg' ?>" alt="cargando..." width="40">
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
                                <img src="<?php echo path_recursos() . $value['pos_img'] ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>">
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
                            <img src="<?php echo path_recursos() . $value['pos_img'] ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>">
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