<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php echo $data['titulo_web']; ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Spanish">
    <meta name="author" content="LeenhCraft.com">
    <meta name="description" content="<?php echo EMPRESA_DESCRIPCION ?>">
    <link rel="icon" type="image/png" href="<?php echo media() . 'img/favicon.png'; ?>">
    <meta property="og:url" content="<?php echo base_url(); ?>">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="es_PE">
    <meta property="og:title" content="<?php echo $data['titulo_web']; ?>">
    <meta property="og:image" content="<?php echo isset($data['img_web']) ? $data['img_web'] : media() . 'img/achuu.jpg'; ?>" />
    <meta property="og:site_name" content="<?php echo NOMBRE_EMPRESA ?>">
    <meta property="og:description" content="<?php echo EMPRESA_DESCRIPCION ?>">
    <title><?php echo $data['titulo_web']; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="<?php echo media() . 'css/bootstrap.css'; ?>">
    <link rel="stylesheet" href="<?php echo media() . 'css/style.css'; ?>">
</head>

<body>