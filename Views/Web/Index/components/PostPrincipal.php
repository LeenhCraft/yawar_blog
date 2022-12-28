<?php
// dep($data['componentes']['postrandom']['content']);
?>
<small class="global-subtitle">¿Qué de nuevo?</small>
<div class="loop-wrap is-top">
    <article class="item is-top is-first">
        <div class="item-image global-image global-image-orientation global-radius">
            <a href="<?php echo path_post() . $data['componentes']['postprincipal']['content']['pos_slug']; ?>" class="global-link" aria-label="The trick to getting more done is to have the freedom to roam around"></a>
            <img src="<?php echo path_recursos() . $data['componentes']['postprincipal']['content']['pos_img'] ?>" loading="lazy" alt="<?php echo $data['componentes']['postprincipal']['content']['pos_name'] ?>">
        </div>
        <div class="item-content">
            <div class="item-tags global-tags">
                <!-- tags -->
                <?php
                foreach ($data['componentes']['postprincipal']['content']['pos_tag'] as $value) {
                ?>
                    <a href="<?php echo path_tag() . $value['tag_slug'] ?>"><?php echo $value['tag_name'] ?></a>
                <?php
                }
                ?>
            </div>
            <h2 class="item-title">
                <a href="<?php /*url del post */ echo path_post() . $data['componentes']['postprincipal']['content']['pos_slug'] ?> ">
                    <?php /*nombre del post */ echo $data['componentes']['postprincipal']['content']['pos_name'] ?>
                </a>
            </h2>
            <p class="item-excerpt global-excerpt">
                <?php echo $data['componentes']['postprincipal']['content']['pos_extract'] ?>
            </p>
            <div class="global-meta is-full-meta">
                <div class="global-meta-wrap">
                    <div>
                        <div class="global-meta-avatar is-image global-image">
                            <a href="<?php echo path_author() . urls_amigables($data['componentes']['postprincipal']['content']['usu_nombre']) ?>" class="global-link" title="<?php $data['componentes']['postprincipal']['content']['usu_nombre'] ?>"></a>
                            <img src="<?php echo empty($data['componentes']['postprincipal']['content']['usu_foto']) ? path_img_404() : path_recursos() . img_user() . $data['componentes']['postprincipal']['content']['usu_foto']; ?>" alt="<?php echo $data['componentes']['postprincipal']['content']['usu_nombre'] ?>" loading="lazy" />
                        </div>
                    </div>
                </div>
                <div class="global-meta-content">
                    <div>
                        by
                        <a href="<?php echo path_author() . urls_amigables($data['componentes']['postprincipal']['content']['usu_nombre']) ?>"><?php echo $data['componentes']['postprincipal']['content']['usu_nombre'] ?></a>
                    </div>
                    <time datetime="<?php echo date('Y-m-d', strtotime($data['componentes']['postprincipal']['content']['pos_date'])) ?>"><span><?php echo date('F j, Y', strtotime($data['componentes']['postprincipal']['content']['pos_date'])) ?> ∙ </span>3 min read</time>
                </div>
            </div>
        </div>
    </article>
    <?php
    /*
     <div class="subscribe-form global-radius">
        <div class="global-dynamic-color">
            <small class="global-subtitle">estar enterado</small>
            <h3 class="subscribe-title">
                Recibe todas las publicaciones más recientes directamente en tu bandeja de entrada.
            </h3>
        </div>
        <div class="subscribe-wrap">
            <form data-members-form="subscribe" data-members-autoredirect="false">
                <input data-members-email type="email" placeholder="Ingresa tu correo" aria-label="Ingresa tu correo" required />
                <button class="global-button no-color" type="submit">
                    Subscribirse
                </button>
            </form>
            <div class="subscribe-alert global-dynamic-color">
                <span class="alert-loading global-alert">Procesando su solicitud</span>
                <span class="alert-success global-alert">Por favor revise su bandeja de entrada y haga clic en el enlace para confirmar su suscripción.</span>
                <span class="alert-error global-alert">Hubo un error al enviar el correo electrónico. Por favor intentelo más tarde.</span>
            </div>
        </div>
    </div>
     */
    ?>
    <div class="subscribe-form global-radius">
        <div class="global-dynamic-color">
            <small class="global-subtitle">redes sociales</small>
            <h3 class="subscribe-title">
                Visita nuestra pagina de Facebook y canal de YouTube para mantenerte al tanto de todas las novedades.
            </h3>
        </div>
        <div class="subscribe-wrap">
            <div>
                <a href="https://www.facebook.com/YawarMuxus/" target="_blank">
                    <button class="global-button no-color mb-2">
                        <i class="fab fa-facebook"></i>
                        Facebook
                    </button>
                </a>
                <a href="https://www.youtube.com/channel/UCnRk_SJpDNTV6ORyUzmmMZg" target="_blank">
                    <button class="global-button no-color">
                        <i class="fab fa-youtube"></i>
                        YouTube
                    </button>
                </a>
            </div>
        </div>
    </div>
    <?php
    foreach ($data['componentes']['postrandom']['content'] as $value) {
    ?>
        <article class="item is-top">
            <div class="item-image global-image global-image-orientation global-radius">
                <a href="<?php echo path_post() . $value['pos_slug'] ?>" class="global-link"></a>
                <img src="<?php echo path_recursos() . $value['pos_img']; ?>" loading="lazy" alt="<?php echo $value['pos_name'] ?>">
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
    <?php
    }
    ?>

</div>