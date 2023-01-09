<!DOCTYPE html>
<html lang="es" class="dark-mode">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Yawar Muxus Blog">
    <meta name="description" content="este blog publica las experiencias de la agrupación a lo largo de los años">
    <meta name="keywords" content="Yawar Muxus, Danzas, Nueva Cajamarca, Fraternidad Folclórica">
    <meta name="robots" content="index, follow">
    <meta name="author" content="LeenhCraft">
    <meta name="language" content="Spanish">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="🤖 blog de yawar muxus">
    <meta name="twitter:description" content="este blog publica las experiencias de la agrupación a lo largo de los años">
    <meta name="twitter:site" content="@mttsleenh">
    <meta name="twitter:creator" content="@mttsleenh">
    <meta name="twitter:image" content="https://leenhcraft.com/Assets/images/portafolio/perfil.jpg">
    <!-- Open Graph general (Facebook, Pinterest)-->
    <meta property="og:title" content="🤖 blog de yawar muxus">
    <meta property="og:description" content="este blog publica las experiencias de la agrupación a lo largo de los años">
    <meta property="og:url" content="leenhcraft.com">
    <meta property="og:site_name" content="leenhcraft.com">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://leenhcraft.com/Assets/images/portafolio/perfil.jpg">
    <title><?php echo isset($data['titulo_web']) ? $data['titulo_web'] : NOMBRE_EMPRESA; ?></title>
    <link rel="icon" type="image/png" href="<?php echo !empty($logo) ? path_recursos() . img_logo() . $logo['img_url'] : media() . 'img/favicon.png'; ?>">
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&amp;display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&amp;display=swap" />
    <link rel="stylesheet" type="text/css" href="<?php echo media() . 'css/screena108.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo media() . 'css/cards.mina.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo media() . 'css/blog.css'; ?>">
    <?php
    if (isset($data['css']) && !empty($data['css'])) {
        for ($i = 0; $i < count($data['css']); $i++) {
            echo '<link rel="stylesheet" type="text/css" href="' . media() . $data['css'][$i] . '">';
        }
    }
    ?>
</head>

<body>
    <div class="global-wrap">
        <div class="global-cover" style="background-image: url(
            <?php
            if (isset($data['img_port'])) {
                echo isset($data['img_port']) ? path_recursos() . $data['img_port'] : path_img_404();
            } else {
                echo isset($backImg['img_url']) ? path_recursos() . img_other() . $backImg['img_url'] : path_img_404();
            }
            ?>);">
        </div>
        <div class="global-content">
            <?php require_once __DIR__ . '/NavbarWeb.php'; ?>