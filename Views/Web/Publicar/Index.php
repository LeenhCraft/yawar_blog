<?php headerWeb('HeaderWeb', $data); ?>
<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
</style>
<main class="global-main">
    <div id="preloder" style=" display: none; position: fixed;">
        <div class="loader"></div>
    </div>
    <form class="create-post" <?php echo isset($data['create-post']) ? $data['create-post'] : 'onsubmit="createPost(this,event)"' ?>>
        <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
        <div class="container border-box">
            <div class="row">
                <?php
                if (isset($data['editar'])) {
                ?>
                    <div class="col-12">
                        <a class="global-button py-2 px-4" href="<?php echo path_post() . $data['post']['pos_slug'] ?>">Volver</a>
                    </div>
                <?php
                }
                ?>
                <div class="col-12 col-md-8 mx-auto mb-4">
                    <label class="title mb-4">
                        <?php
                        echo isset($data['titulo_view']) ? $data['titulo_view'] : "Publicar Post";
                        ?>
                    </label>
                    <div class="row pl-4">
                        <div class="mb-4">
                            <label class="content-input m-0">
                                <?php $checked = isset($data['post']['pos_publicar']) && $data['post']['pos_publicar'] == 1 ? 'checked' : ''; ?>
                                <input type="checkbox" name="publicar" <?php echo $checked; ?>>
                                <i></i>
                                <span style="opacity: var(--opacity-one);">Publicar Post</span>
                            </label>
                        </div>
                        <div class="ml-4 mb-4">
                            <label class="content-input m-0">
                                <?php $checked = isset($data['post']['pos_principal']) && $data['post']['pos_principal'] == 1 ? 'checked' : ''; ?>
                                <input type="checkbox" name="principal" <?php echo $checked; ?>>
                                <i></i>
                                <span style="opacity: var(--opacity-one);">Post Principal</span>
                            </label>
                        </div>
                        <div class="ml-4 mb-4">
                            <label class="content-input m-0">
                                <?php $checked = isset($data['post']['pos_destacado']) && !empty($data['post']['pos_destacado']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="destacado" <?php echo $checked; ?>>
                                <i></i>
                                <span style="opacity: var(--opacity-one);">Post Destacado</span>
                            </label>
                        </div>
                        <?php
                        if (isset($data['post']['pos_status'])) {
                        ?>
                            <div class="ml-4 mb-4">
                                <label class="content-input m-0">
                                    <?php $checked = isset($data['post']['pos_status']) && $data['post']['pos_status'] == 1 ? 'checked' : ''; ?>
                                    <input type="checkbox" name="status" <?php echo $checked; ?>>
                                    <i></i>
                                    <span style="opacity: var(--opacity-one);">Estado</span>
                                </label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <input type="text" class="title w-100" placeholder="Titulo" name="titulo" value="<?php echo isset($data['post']['pos_name']) ? $data['post']['pos_name'] : '' ?>">
                </div>
                <div class="col-12 mb-4">
                    <textarea name="resumen" class="element-textarea w-100"><?php echo isset($data['post']['pos_extract']) ? $data['post']['pos_extract'] : 'resumen' ?></textarea>
                </div>
                <div class="col-12 mb-4">
                    <div class="qtagselect isw360 qmain">
                        <?php
                        if (!empty($data['tags'])) {
                        ?>
                            <select name="tags[]" class="qtagselect__select qtagselect__tag" multiple>
                                <?php
                                $count = 0;
                                // dep($arraTag);
                                // dep($arrPosTag);
                                $selected = "";
                                foreach ($data['tags'] as $tag) {
                                    if (isset($data['arrPosTag'])) {
                                        $selected = in_array($tag['tag_slug'], $data['arrPosTag']) ? "selected" : "";
                                    }
                                ?>
                                    <option value="<?php echo $tag['tag_slug']; ?>" <?php echo $selected; ?>><?php echo $tag['tag_name']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <select name="gallery" class="form-control-select">
                        <?php
                        if (!empty($data['gallery'])) {
                        ?>
                            <option value="0">Seleccione una opción</option>
                            <?php
                            foreach ($data['gallery'] as $tag) {
                                if (isset($data['post']['pos_gallery'])) {
                                    $selected = $data['post']['pos_gallery']['ga_slug'] == $tag['ga_slug'] ? 'selected' : '';
                                } else {
                                    $selected = '';
                                }
                            ?>
                                <option value="<?php echo $tag['ga_slug']; ?>" <?php echo $selected; ?>><?php echo $tag['ga_name']; ?></option>
                            <?php
                            }
                            ?>
                        <?php } else { ?>
                            <option value="0">No hay galerias creadas para este post</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 mb-4">
                    <div class="post-header-image m-0">
                        <div class="upload-button kg-file-card-container global-radius">
                            <input name="portada" accept="image/*" type="file" class="upload-button__input" onchange="mostrarImg(this,event)">
                            <div class="upload-button__icon">
                                <div class="kg-file-card-contents">
                                    <div class="kg-file-card-title">Imagen de portada</div>
                                    <div class="kg-file-card-metadata">
                                        <div class="kg-file-card-filename"><?php echo isset($data['post']['pos_img']) ? $data['post']['pos_img'] : '*.jpg'; ?></div>
                                        <div class="kg-file-card-filesize">
                                            <?php
                                            if (isset($data['post']['pos_img'])) {
                                                if (file_exists(dir_recursos() . $data['post']['pos_img'])) {
                                                    $size = filesize(dir_recursos() . $data['post']['pos_img']);
                                                    echo number_format($size / 1024, 2) . " KB";
                                                } else {
                                                    echo 'no existe 0 KB';
                                                }
                                            } else {
                                                echo '0 KB';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                                <img src="<?php echo isset($data['post']['pos_img']) && file_exists(path_recursos() . 'Webp/' . $data['post']['pos_img']) ?  path_recursos() . 'Webp/' . $data['post']['pos_img'] : media() . 'svg/upload.svg' ?>" alt="cargando" width="40">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <textarea name="contenido" class="element-textarea w-100"><?php echo isset($data['post']['pos_body']) ? $data['post']['pos_body'] : 'contenido' ?></textarea>
                </div>
                <div class="col-12 mb-4 contentFormCreatePost" style="display: none;">
                    <p class="messageFormCreatePost global-radius p-5 font-weight-bold" style="border: 1px solid var(--ghost-accent-color);font-size: 1.7rem;color: var(--ghost-accent-color);">message</p>
                </div>
                <div class="col-12 mb-4" style="display: flex; justify-content: center;">
                    <?php
                    if (isset($data['editar'])) {
                    ?>
                        <input type="hidden" name="_edit" value="<?php echo $data['post']['idpost']; ?>">
                        <button class="global-button global-button-nocolor">Actualizar</button>
                    <?php
                    } else {
                    ?>
                        <button class="global-button" type="submit">Crear Post</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</main>
<?php footerWeb('FooterWeb', $data); ?>