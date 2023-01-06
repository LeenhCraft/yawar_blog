<header class="header-section">
    <div class="header-wrap">
        <div class="header-logo global-logo is-header">
            <a href="<?php echo base_url(); ?>" class="is-logo">
                <img src="<?php echo isset($logo['img_url']) ? path_recursos() . img_logo() . $logo['img_url'] : path_img_404() ?>" alt="<?php echo NOMBRE_EMPRESA ?>">
            </a>
        </div>
        <div class="header-nav">
            <span class="header-search search-open is-mobile"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.877 18.456l5.01 5.011c.208.197.484.308.771.308a1.118 1.118 0 00.809-1.888l-5.011-5.01c3.233-4.022 2.983-9.923-.746-13.654l-.291-.29a.403.403 0 00-.095-.075C13.307-.77 7.095-.649 3.223 3.223c-3.997 3.998-3.997 10.489 0 14.485 3.731 3.731 9.633 3.981 13.654.748zm-.784-13.617a7.96 7.96 0 010 11.254 7.961 7.961 0 01-11.253 0 7.96 7.96 0 010-11.254 7.961 7.961 0 0111.253 0z" />
                </svg>
            </span>
            <input id="toggle" class="header-checkbox" type="checkbox" />
            <label class="header-toggle" for="toggle">
                <span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </span>
            </label>
            <nav>
                <ul>
                    <?php
                    // dep($data);
                    foreach ($data['componentes']['menu']['content'] as $item) {
                        if (isset($_SESSION['_cf'])) {
                    ?>
                            <li><a class="text-capitalize" href="<?php echo base_url() . $item['me_url'] ?>"><?php echo $item['me_name'] ?></a></li>
                            <?php
                        } else {
                            if ($item['me_privado'] != 1) {
                            ?>
                                <li><a class="text-capitalize" href="<?php echo base_url() . $item['me_url'] ?>"><?php echo $item['me_name'] ?></a></li>
                    <?php
                            }
                        }
                    }
                    ?>
                </ul>
                <ul>
                    <li class="header-search search-open is-desktop">
                        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="m16.822 18.813 4.798 4.799c.262.248.61.388.972.388.772-.001 1.407-.637 1.407-1.409 0-.361-.139-.709-.387-.971l-4.799-4.797c3.132-4.108 2.822-10.005-.928-13.756l-.007-.007-.278-.278a.6985.6985 0 0 0-.13-.107C13.36-1.017 7.021-.888 3.066 3.067c-4.088 4.089-4.088 10.729 0 14.816 3.752 3.752 9.65 4.063 13.756.93Zm-.965-13.719c2.95 2.953 2.95 7.81 0 10.763-2.953 2.949-7.809 2.949-10.762 0-2.951-2.953-2.951-7.81 0-10.763 2.953-2.95 7.809-2.95 10.762 0Z" />
                        </svg>
                    </li>
                    <?php
                    if (isset($_SESSION['pe'])) {
                        // if (isset($_SESSION['_cf'])) {
                        if (false) {
                    ?>
                            <li class="signin">
                                <a href="<?php echo base_url() . 'Leenh'; ?>">Configurar Web</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="account">
                            <a class="global-button no-color" href="<?php echo base_url() . 'account'; ?>">Mi cuenta</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="signin">
                            <a href="<?php echo base_url() . 'Signin'; ?>">Iniciar sesión</a>
                        </li>
                        <li class="signin">
                            <a class="global-button" style="text-decoration: none;" href="<?php echo base_url() . 'Signup'; ?>">Crear cuenta</a>
                        </li>


                    <?php
                        /*
                    <li class="signup">
                            <a href="membership/index.html" class="global-button">Suscribirme</a>
                        </li>
                     */
                    } ?>
                </ul>
            </nav>
        </div>
    </div>
</header>