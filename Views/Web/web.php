<?php headerWeb('header_web', $data); ?>
<nav class="navbar navbar-expand-lg navbar-light text-white py-4 px-5">
    <a class="navbar-brand text-white" href="#">Yawar Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white font-weight-bold" href="#">Demos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="#">Style Guide</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="#">Membership</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white font-weigth-bold" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <span>
                        <svg role="img" viewBox="0 0 20 4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 4A2 2 0 102.001.001 2 2 0 002 4zm8 0a2 2 0 10.001-3.999A2 2 0 0010 4zm8 0a2 2 0 10.001-3.999A2 2 0 0018 4z"></path>
                        </svg>
                    </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m16.822 18.813 4.798 4.799c.262.248.61.388.972.388.772-.001 1.407-.637 1.407-1.409 0-.361-.139-.709-.387-.971l-4.799-4.797c3.132-4.108 2.822-10.005-.928-13.756l-.007-.007-.278-.278a.6985.6985 0 0 0-.13-.107C13.36-1.017 7.021-.888 3.066 3.067c-4.088 4.089-4.088 10.729 0 14.816 3.752 3.752 9.65 4.063 13.756.93Zm-.965-13.719c2.95 2.953 2.95 7.81 0 10.763-2.953 2.949-7.809 2.949-10.762 0-2.951-2.953-2.951-7.81 0-10.763 2.953-2.95 7.809-2.95 10.762 0Z"></path>
                </svg>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="#">Sign in</a>
            </li>
            <li>
                <button class="btn btn-web btn-sm rounded-pill text-gray font-weight-bolder py-2 px-4">Become a subscriber</button>
            </li>
        </ul>
    </div>
</nav>
<?php footerWeb('footer_web', $data); ?>