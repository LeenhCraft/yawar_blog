<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <article class="post-section">
        <div class="post-wrap global-padding custom-content-leenh">
            <form id="img" class="success" onsubmit="save(this,event)">
                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                <div class="post-content">
                    <h2 class="text-center">Configuración Web</h2>
                    <div class="post-header-image">
                        <div class="message text-center border global-radius mb-4 global-padding" style="padding: 1.5rem; display: none;">
                            <small class="alert-success global-img">Procesando su petición</small>
                            <small class="alert-error global-img">Ocurrio un error al tratar de iniciar sesión por favor intentelo más tarde.</small>
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
                </div>
            </form>
        </div>
        <div class="post-wrap global-padding custom-content-leenh">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam quaerat dolorem non explicabo vero optio magnam! Pariatur quos consectetur magnam cupiditate deserunt odio esse libero ad. Voluptas quo mollitia quae!
        </div>
    </article>
</main>
<?php footerWeb('FooterWeb', $data); ?>