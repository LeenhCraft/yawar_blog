<style>
    .hero-public {
        display: flex;
        align-items: center;
        box-sizing: border-box;
        width: 100%;
        padding: 10px 6px;
        cursor: pointer;
        border-radius: 100px;
        background-color: var(--color-one);
        transition: background-color .16s ease;
    }

    .hero-public span:first-of-type {
        font-size: 1.8rem;
        line-height: 1;
        overflow: hidden;
        flex: 1 0 50%;
        white-space: nowrap;
        text-overflow: ellipsis;
        opacity: var(--opacity-two);
    }

    .hero-public:hover {
        background-color: var(--color-two);
    }
</style>
<div class="hero-section">
    <div class="hero-wrap global-padding">
        <h1 class="hero-title global-title text-capitalized text-center">
            <?php
            /*
            <span>This is Reiro.</span> A digital magazine that promises to
            deliver <span>inspiring stories</span> from all disciplines.
            */
            echo $data['componentes']['eslogan']['content']['sl_name'];
            ?>
        </h1>
        <div class="hero-search is-flat search-open">
            <span>Haga clic aquí para buscar publicaciones</span>
            <span class="global-dynamic-color">
                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m16.822 18.813 4.798 4.799c.262.248.61.388.972.388.772-.001 1.407-.637 1.407-1.409 0-.361-.139-.709-.387-.971l-4.799-4.797c3.132-4.108 2.822-10.005-.928-13.756l-.007-.007-.278-.278a.6985.6985 0 0 0-.13-.107C13.36-1.017 7.021-.888 3.066 3.067c-4.088 4.089-4.088 10.729 0 14.816 3.752 3.752 9.65 4.063 13.756.93Zm-.965-13.719c2.95 2.953 2.95 7.81 0 10.763-2.953 2.949-7.809 2.949-10.762 0-2.951-2.953-2.951-7.81 0-10.763 2.953-2.95 7.809-2.95 10.762 0Z" />
                </svg>
            </span>
        </div>
        <?php
        if (false) {
        ?>
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <div style="background-color: var(--color-five);border-radius: var(--border-radius);max-width: 500px;min-width: 500px; padding: 2vh; margin: 0;">
                    <div class="open-section-post">
                        <span style="font-size: 1.8rem;opacity: var(--opacity-two);margin: 0 0 0px 10px;">Publicar nuevo post</span>

                        <div style="display: flex; align-items: center; margin-top: 10px;">
                            <div class="global-meta-avatar is-image global-image" style="min-width: 45px; margin-right: 10px; margin-left: 10px;">
                                <a href="author/damian/index.html" class="global-link" title=""></a>
                                <img src="https://via.placeholder.com/300x49" alt="BUSTAMANTE FERNANDEZ LEENH ALEXANDER" loading="lazy">
                            </div>
                            <div class="hero-public" style="max-width: 400px; overflow: hidden;">
                                <a href="<?php echo base_url() . 'publicar' ?>" style="text-overflow: ellipsis;opacity: var(--opacity-two);white-space: nowrap;font-size: 1.8rem;">¿Qué estas pensando?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="public-section">
                <div class="public-wrap" style="z-index: 999;">
                    <div class="public-content global-radius">
                        <form class="public-form" onsubmit="return false">
                            <!-- <input class="search-input" type="text" placeholder="Search"> -->

                            <div>
                                <p>Crear Publicacion</p>
                                <span class="public-close"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.997 10.846L1.369.219 1.363.214A.814.814 0 00.818.005.821.821 0 000 .822c0 .201.074.395.208.545l.006.006L10.842 12 .214 22.626l-.006.006a.822.822 0 00-.208.546c0 .447.37.817.818.817a.814.814 0 00.551-.215l10.628-10.627 10.628 10.628.005.005a.816.816 0 001.368-.603.816.816 0 00-.213-.552l-.006-.005L13.151 12l10.63-10.627c.003 0 .004-.003.006-.005A.82.82 0 0024 .817a.817.817 0 00-1.37-.602l-.004.004-10.63 10.627z"></path>
                                    </svg></span>
                            </div>
                            <input type="text">
                        </form>
                    </div>
                </div>
                <div class="public-overlay"></div>
            </div>
        <?php
        }
        ?>

    </div>
</div>