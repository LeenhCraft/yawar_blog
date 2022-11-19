<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <article class="post-section is-sidebar">
        <div class="post-header">
            <div class="post-header-wrap global-padding">
                <div class="post-header-content">
                    <h1>Nuevo post</h1>
                    <h1 class="post-title global-title"><input type="text" placeholder="Titulo"></h1>
                    <textarea class="post-excerpt global-excerpt" rows="4" style="background-color: var(--color-border-one);width:100%; border-radius: var(--border-radius); padding: 2rem 3.25rem;">resumen</textarea>
                    <div class="post-tags global-tags">

                        <a href="#">tags</a>

                    </div>
                </div>

                <div class="post-header-image">
                    <div class="upload-button kg-file-card-container global-radius">
                        <input type="file" class="upload-button__input" />
                        <div class="upload-button__icon">
                            <div class="kg-file-card-contents">
                                <div class="kg-file-card-title">Imagen de portada</div>
                                <div class="kg-file-card-metadata">
                                    <div class="kg-file-card-filename">mobius.jpg</div>
                                    <div class="kg-file-card-filesize">946 KB</div>
                                </div>
                            </div>
                        </div>
                        <div class="kg-file-card-icon" style="min-height: 90px; min-width: 80px; margin: 0 2.25rem;">
                            <img src="<?php echo media() . 'svg/upload.svg' ?>" alt="" width="40">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="global-margin">
            <div class="post-wrap global-padding grid">
                <div class="post-contentt col-md">
                    <textarea rows="10" style="background-color: var(--color-border-one);width:800px; border-radius: var(--border-radius); padding: 2rem 3.25rem;">contenido</textarea>
                </div>
            </div>
        </div>
    </article>
</main>
<?php footerWeb('FooterWeb', $data); ?>