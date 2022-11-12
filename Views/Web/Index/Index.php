<?php headerWeb('HeaderWeb', $data); ?>
<main class="global-main">

  <?php
  // slogan + buscador
  if ($data['componentes']['eslogan']['status']) {
    require_once __DIR__ . '/components/Eslogan.php';
  }
  // // publicar post
  // if ($data['componentes']['publicapost']['status']) {
  //   require_once __DIR__ . '/components/PublicaPost.php';
  // }
  // lista de etiquetas
  if ($data['componentes']['listaetiquetas']['status']) {
    require_once __DIR__ . '/components/ListaEtiquetas.php';
  }
  ?>

  <div class="loop-section global-padding">
    <?php
    // post principal
    if ($data['componentes']['postprincipal']['status']) {
      require_once __DIR__ . '/components/PostPrincipal.php';
    }
    // posts destacados
    if ($data['componentes']['postdestacados']['status']) {
      require_once __DIR__ . '/components/PostDestacados.php';
    }
    // listado de miniposts
    if ($data['componentes']['listaminipost']['status']) {
      require_once __DIR__ . '/components/ListaMiniPost.php';
    }
    // lista de galerias
    if ($data['componentes']['listagaleria']['status']) {
      require_once __DIR__ . '/components/ListaGaleria.php';
    }
    ?>
  </div>
</main>
<?php footerWeb('FooterWeb', $data); ?>