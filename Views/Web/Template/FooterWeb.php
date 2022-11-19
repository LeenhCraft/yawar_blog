<footer class="footer-section global-footer">
  <div class="footer-wrap global-padding">
    <?php
    // eslogan de footer
    if ($data['componentes']['esloganfooter']['status']) {
      require_once __DIR__ . '/../Index/components/EsloganFooter.php';
    }
    // links footer
    if ($data['componentes']['linksfooter']['status']) {
      require_once __DIR__ . '/../Index/components/LinksFooter.php';
    }
    ?>
    <div class="footer-copyright">
      &copy; <a href="https://leenhcraft.com/yawarmuxus" target="_blank">Yawar Muxus - Blog</a> <?php echo date('Y') ?>. Published with
      <a href="https://leenhcraft.com/" target="_blank" rel="noopener noreferrer">leenhcraft</a>.
    </div>
  </div>
</footer>
</div>
</div>

<div id="notifications" class="global-notification">
  <div class="subscribe">You’ve successfully subscribed to Reiro</div>
  <div class="signin">Welcome back! You’ve successfully signed in.</div>
  <div class="signup">Great! You’ve successfully signed up.</div>
  <div class="update-email">Success! Your email is updated.</div>
  <div class="expired">Your link has expired</div>
  <div class="checkout-success">
    Success! Check your email for magic link to sign-in.
  </div>
</div>

<div class="search-section">
  <div class="search-wrap">
    <div class="search-content global-radius">
      <form class="search-form" onkeyup="buscarPost(this,event)">
        <input class="search-input" type="text" placeholder="Buscar..." id="txtbuscar" name="txtbuscar">
        <div class="search-meta">
          <span class="search-info">Por Favor introduzca al menos 3 caracteres</span>
          <span class="search-counter is-hide">
            <span>0</span> resultados de tu busqueda
          </span>
        </div>
        <span class="search-close"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.997 10.846L1.369.219 1.363.214A.814.814 0 00.818.005.821.821 0 000 .822c0 .201.074.395.208.545l.006.006L10.842 12 .214 22.626l-.006.006a.822.822 0 00-.208.546c0 .447.37.817.818.817a.814.814 0 00.551-.215l10.628-10.627 10.628 10.628.005.005a.816.816 0 001.368-.603.816.816 0 00-.213-.552l-.006-.005L13.151 12l10.63-10.627c.003 0 .004-.003.006-.005A.82.82 0 0024 .817a.817.817 0 00-1.37-.602l-.004.004-10.63 10.627z" />
          </svg></span>
      </form>
      <div class="search-results global-image"></div>
    </div>
  </div>
  <div class="search-overlay"></div>
</div>
<!-- <script src="<?php echo media() . 'js/globala108.js' ?>"></script>
<script src="<?php echo media() . 'js/indexa108.js' ?>"></script> -->
<script>
  const base_url = "<?php echo base_url(); ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.js"></script>
<script src="<?php echo media() . 'js/jquery.min.js'; ?>"></script>
<script src="https://kit.fontawesome.com/772425e4ae.js" crossorigin="anonymous"></script>
<script src="<?php echo media() . 'js/blog.js' ?>"></script>
<!-- <script src="<?php echo media() . 'js/fuse.basic.js' ?>"></script> -->
<script>
  let list = [];

  function buscarPost(ths, e) {
    e.preventDefault();
    let a = $('#txtbuscar').val();
    if (Object.entries(list).length === 0) {
      let ajaxUrl = base_url + "Web/buscarPosts/";
      $.get(ajaxUrl, function(data) {
        let objData = JSON.parse(data);
        if (objData.status) {
          list = objData.data.slice();
        }
      });
    } else {
      let result = $('.search-result');
      let counter = $('.search-counter');
      let count = $('.search-counter span');
      let info = $('.search-info');
      let results = $('.search-results');

      const options = {
        keys: [
          "title"
        ]
      };
      const fuse = new Fuse(list, options);
      var resultSearch = fuse.search(a);
      var z = resultSearch.length;
      if (a.length > 2) {
        results.html('');
        info.addClass('is-hide');
        counter.removeClass('is-hide');
        count.html(z);
        const opciones = {
          weekday: 'long',
          year: 'numeric',
          month: 'short',
          day: 'numeric'
        };
        resultSearch.forEach(function(item, index) {
          console.log(item.item.title);
          let fecha = new Date(item.item.date);
          let html = `
            <a href="<?php echo path_post() ?>${item.item.slug}">
            <img src="${item.item.img}">
            <h5><span>${item.item.title}</h5>
            <time>${fecha.toLocaleDateString('es-pe',opciones)}</time>
            </a>
          `;
          results.append(html);
        });
      } else {
        results.html('');
        info.removeClass('is-hide');
        counter.addClass('is-hide');
      }
    }

  }
</script>
<?php
if (isset($data['js']) && !empty($data['js'])) {
  for ($i = 0; $i < count($data['js']); $i++) {
    echo '<script src="' . media() . $data['js'][$i] . '"></script>';
  }
}
?>
</body>

</html>