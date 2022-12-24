<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">
    <progress class="post-progress"></progress>
    <article class="post-section is-sidebar">
        <div class="post-header">
            <div class="post-header-wrap global-padding">
                <div class="post-header-content">
                    <?php
                    if (isset($data['editar']) && $data['editar'] == true) {
                    ?>
                        <a class="global-button py-2 px-4" href="<?php echo path_post() . $data['post']['pos_slug'] . '/editar' ?>">Editar Post</a>
                    <?php
                    }
                    ?>
                    <h1 class="post-title global-title"><?php echo $data['post']['pos_name']; ?></h1>
                    <p class="post-excerpt global-excerpt"><?php echo $data['post']['pos_extract']; ?></p>
                    <div class="post-tags global-tags">
                        <?php foreach ($data['post']['pos_tag'] as $tag) {
                        ?>
                            <a href="<?php echo path_tag() . $tag['tag_slug'] ?>"><?php echo $tag['tag_name'] ?></a>
                        <?php
                        } ?>
                    </div>
                    <div class="post-meta-wrap">
                        <div class="global-meta is-full-meta is-post">
                            <div class="global-meta-wrap">
                                <div>
                                    <div class="global-meta-avatar is-image global-image">
                                        <a href="<?php echo path_author() . urls_amigables($data['post']['usu_nombre']); ?>" class="global-link" title="<?php echo $data['post']['usu_nombre']; ?>"></a>
                                        <img src="<?php echo $data['post']['aut_img']; ?>" alt="cargando..." loading="lazy">
                                    </div>
                                </div>
                            </div>
                            <div class="global-meta-content">
                                <div>
                                    by
                                    <a href="<?php echo path_author() . urls_amigables($data['post']['usu_nombre']); ?>"><?php echo $data['post']['usu_nombre']; ?></a>
                                </div>
                                <time datetime="<?php echo date('Y-m-d', strtotime($data['post']['pos_date'])) ?>">
                                    <span>
                                        <?php echo date('F j, Y', strtotime($data['post']['pos_date'])) ?> ∙
                                    </span>3 min read
                                </time>
                            </div>
                        </div>
                        <!-- redes del autor -->
                        <div class="post-share-wrap" style="display: none;">
                            <a href="https://twitter.com/intent/tweet?text=The%20trick%20to%20getting%20more%20done%20is%20to%20have%20the%20freedom%20to%20roam%20around&amp;url=https://reiro-dark.fueko.net/the-trick-to-getting-more-done-is-to-have-the-freedom-to-roam-around/" target="_blank" rel="noopener" aria-label="Share on Twitter"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                                </svg></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://reiro-dark.fueko.net/the-trick-to-getting-more-done-is-to-have-the-freedom-to-roam-around/" target="_blank" rel="noopener" aria-label="Share on Facebook"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.9981 11.9991C23.9981 5.37216 18.626 0 11.9991 0C5.37216 0 0 5.37216 0 11.9991C0 17.9882 4.38789 22.9522 10.1242 23.8524V15.4676H7.07758V11.9991H10.1242V9.35553C10.1242 6.34826 11.9156 4.68714 14.6564 4.68714C15.9692 4.68714 17.3424 4.92149 17.3424 4.92149V7.87439H15.8294C14.3388 7.87439 13.8739 8.79933 13.8739 9.74824V11.9991H17.2018L16.6698 15.4676H13.8739V23.8524C19.6103 22.9522 23.9981 17.9882 23.9981 11.9991Z" />
                                </svg></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&amp;title=The%20trick%20to%20getting%20more%20done%20is%20to%20have%20the%20freedom%20to%20roam%20around&amp;url=https://reiro-dark.fueko.net/the-trick-to-getting-more-done-is-to-have-the-freedom-to-roam-around/" target="_blank" rel="noopener" aria-label="Share on Linkedin"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg></a>
                        </div>
                    </div>
                </div>
                <div class="post-header-image">
                    <figure>
                        <div class="global-image global-image-orientation global-radius">
                            <img src="<?php echo path_recursos() . 'Webp/' . $data['post']['pos_img']; ?>" alt="<?php echo $data['post']['pos_name']; ?>">
                        </div>
                        <figcaption>
                            Photo by
                            <a href="<?php echo path_author() . urls_amigables($data['post']['usu_nombre']); ?>">
                                <?php echo $data['post']['usu_nombre']; ?>
                            </a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
        <div class="global-margin">
            <div class="post-wrap global-padding grid">
                <div class="post-content col-md">
                    <?php echo $data['post']['pos_body'] ?>
                </div>
                <div class="post-sidebar post-sidebar-lnh">
                    <div class="is-authors">
                        <small class="global-subtitle">Escrito por</small>
                        <a href="<?php echo path_author() . urls_amigables($data['post']['usu_nombre']); ?>">
                            <img src="<?php echo $data['post']['aut_img']; ?>" alt="<?php echo $data['post']['usu_nombre']; ?>" loading="lazy">
                            <div>
                                <h3 class="post-sidebar-title"><?php echo $data['post']['usu_nombre']; ?></h3>
                                <p><?php echo $data['post']['aut_meta']['me_descrip']; ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="is-featured">
                        <small class="global-subtitle">Recomendacion del editor</small>
                        <?php
                        foreach ($data['postrandom'] as $post) {
                        ?>
                            <a href="<?php echo path_post() . $post['pos_slug'] ?>">
                                <img src="<?php echo path_recursos() . 'Webp/' . $post['pos_img']; ?>" loading="lazy" alt="<?php echo $post['pos_name'] ?>">
                                <div>
                                    <h3 class="post-sidebar-title"><?php echo $post['pos_name'] ?></h3>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="subscribe-form global-radius is-sticky">
                        <div class="global-dynamic-color">
                            <small class="global-subtitle">estar enterado</small>
                            <h3 class="subscribe-title">Recibe todas las publicaciones más recientes directamente en tu bandeja de entrada.</h3>
                        </div>
                        <div class="subscribe-wrap">
                            <form data-members-form="subscribe" data-members-autoredirect="false">
                                <input data-members-email type="email" placeholder="Ingresa tu correo" aria-label="Your email address" required>
                                <button class="global-button no-color" type="submit"> Subscribirse</button>
                            </form>
                            <div class="subscribe-alert global-dynamic-color">
                                <span class="alert-loading global-alert">Procesando su solicitud</span>
                                <span class="alert-success global-alert">Por favor revise su bandeja de entrada y haga clic en el enlace para confirmar su suscripción.</span>
                                <span class="alert-error global-alert">Hubo un error al enviar el correo electrónico. Por favor intentelo más tarde.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php if (!empty($data['gallery'])) {
    ?>
        <div class="special-section global-padding">
            <small class="global-subtitle">Mira nuestra galeria de fotos</small>
            <div class="special-wrap">
                <?php
                foreach ($data['gallery'] as $gallery) {
                ?>
                    <article class="item is-special">
                        <div class="item-image global-image global-image-orientation global-radius">
                            <img src="<?php echo path_recursos() . 'Webp/' . $gallery['ga_img'] ?>" alt="<?php echo $gallery['ga_name'] ?>">
                            <a href="<?php echo path_gallery() . $gallery['ga_slug'] ?>" class="global-link" aria-label="<?php echo $gallery['ga_name'] ?>"></a>
                        </div>
                        <div class="item-content">
                            <h2 class="item-title"><a href="<?php echo  path_gallery() . $gallery['ga_slug'] ?>"><?php echo $gallery['ga_name'] ?></a></h2>
                        </div>
                    </article>
                <?php }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
    <aside class="navigation-section global-padding">
        <div class="navigation-wrap">
            <?php
            if (!empty($data['next'])) {
            ?>
                <a href="<?php echo path_post() . $data['next']['pos_slug'] ?>" class="navigation-next">
                    <small class="global-subtitle">yawar post siguiente</small>
                    <div>
                        <div class="navigation-image global-image-orientation global-image global-radius is-square">
                            <img src="<?php echo path_recursos() . 'Webp/' . $data['next']['pos_img'] ?>" alt="<?php echo $data['next']['pos_name'] ?>" loading="lazy">
                        </div>
                        <div class="navigation-title">
                            <div>
                                <h3><?php echo $data['next']['pos_name'] ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
            }
            if (!empty($data['older'])) {
            ?>
                <a href="<?php echo path_post() . $data['older']['pos_slug'] ?>" class="navigation-prev">
                    <small class="global-subtitle">Yawar Post anteriores</small>
                    <div>
                        <div class="navigation-title">
                            <div>
                                <h3><?php echo $data['older']['pos_name'] ?></h3>
                            </div>
                        </div>
                        <div class="navigation-image global-image-orientation global-image global-radius is-square">
                            <img src="<?php echo path_recursos() . 'Webp/' . $data['older']['pos_img'] ?>" alt="<?php echo $data['older']['pos_name'] ?>" loading="lazy">
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </aside>
    <div class="comments-section global-padding">
        <div class="comments-wrap global-radius">
            <div class="comments-content">
                <div class="comments-header">
                    <h3>Sección de comentarios</h3>
                    <span>0 comentarios</span>
                </div>
                <style>
                    .comments-body {
                        padding: 5rem 0;
                        margin: 0 0 8rem 0;
                        border-top: 1px solid hsla(0, 0%, 100%, .1);
                        border-bottom: 1px solid hsla(0, 0%, 100%, .1);
                        /* border-top-width: 2px;
                        border-bottom-width: 2px; */
                    }

                    .btn {
                        padding: 8px 17px;
                        background-color: var(--ghost-accent-color);
                    }

                    .w-100 {
                        width: 100%;
                    }
                </style>
                <div class="comments-body" sstyle=" border-top: 5px solid red;  border-bottom: 5px solid red;">
                    <section class="text-center">
                        <p class="w-100">¿Tienes algo que decir?</p>
                        <p>¡Comparte tu opinión con nosotros!</p>
                        <p>
                            <a href="membership/index.html" class="global-button">Iniciar Sesión</a>
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>