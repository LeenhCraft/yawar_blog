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
      <form class="search-form" onsubmit="return false">
        <input class="search-input" type="text" placeholder="Search" />
        <div class="search-meta">
          <span class="search-info is-hide">Please enter at least 3 characters</span>
          <span class="search-counter">
            <span>19</span> results for your search
          </span>
          <span class="search-counter is-hide">
            <span>0</span> results for your search
          </span>
        </div>
        <span class="search-close"><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.997 10.846L1.369.219 1.363.214A.814.814 0 00.818.005.821.821 0 000 .822c0 .201.074.395.208.545l.006.006L10.842 12 .214 22.626l-.006.006a.822.822 0 00-.208.546c0 .447.37.817.818.817a.814.814 0 00.551-.215l10.628-10.627 10.628 10.628.005.005a.816.816 0 001.368-.603.816.816 0 00-.213-.552l-.006-.005L13.151 12l10.63-10.627c.003 0 .004-.003.006-.005A.82.82 0 0024 .817a.817.817 0 00-1.37-.602l-.004.004-10.63 10.627z" />
          </svg></span>
      </form>
      <!-- <div class="search-results global-image"></div> -->
      <div class="search-results global-image">
        <a href="https://reiro-dark.fueko.net/i-have-my-own-definition-of-minimalism/">
          <img src="https://reiro-dark.fueko.net/content/images/2022/10/jacek-dylag-PR-B3hhcOZY-unsplash.jpg">
          <h5><span>I have my own definition of minimalism</span></h5>
          <time>August 17, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/i-believe-the-world-is-one-big-family/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/m-cooper-Xe4dyCmmXR0-unsplash.jpg">
          <h5><span>I believe the world is one big family</span></h5><time>March 2, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/look-at-life-with-the-eyes-of-a-child/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1597765654534-e42ea47ab66a.jpeg">
          <h5><span>Look at life with the eyes of a child</span></h5><time>October 22, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/every-day-in-every-city-and-town-across-the-country/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/ramona-balaban-RyV9G427E-k-unsplash.jpg">
          <h5><span>Every day, in every city and town across the country</span></h5><time>July 14, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/change-your-attitude/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1593721725687-43a49dfa8c67.jpeg">
          <h5><span>Change your attitude</span></h5><time>June 16, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/comfort-and-simplicity-are-two-keys/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1615406020658-6c4b805f1f30.jpeg">
          <h5><span>Comfort and simplicity are two keys</span></h5><time>March 5, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/being-unique-is-better-than-being-perfect/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1642557581411-1be3a36d4786.jpeg">
          <h5><span>Being unique is better than being perfect</span></h5><time>January 13, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/the-difference-is-quality/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1434494878577-86c23bcb06b9.jpeg">
          <h5><span>The difference is quality</span></h5><time>June 17, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/the-trick-to-getting-more-done-is-to-have-the-freedom-to-roam-around/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1551734465-bf8cc92570f5.jpeg">
          <h5><span>The trick to getting more done is to have the freedom to roam around</span></h5><time>October 12, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/we-are-stronger-as-a-group-than-an-individual-2/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/rayul-_M6gy9oHgII-unsplash.jpg">
          <h5><span>We are stronger as a group than an individual</span></h5><time>September 16, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/quiet-time-is-the-best-time/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/emilio-garcia-lb9hi0NDjT0-unsplash.jpg">
          <h5><span>Quiet time is the best time</span></h5><time>July 27, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/the-secret-is-to-work-less-as-individuals-and-more-as-a-team/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/dillon-wanner-qrCmguAfqAg-unsplash.jpg">
          <h5><span>The secret is to work less as individuals and more as a team</span></h5><time>September 22, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/this-must-be-the-place/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1518893494013-481c1d8ed3fd.jpeg">
          <h5><span>This must be the place</span></h5><time>June 18, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/there-are-still-many-questions-left-to-answer/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1584539094584-c4231ff84bd4.jpeg">
          <h5><span>There are still many questions left to answer</span></h5><time>September 30, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/architecture-begins-where-engineering-ends/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1665399320309-e9757b31a5fe.jpeg">
          <h5><span>Architecture begins where engineering ends</span></h5><time>July 15, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/its-a-new-era-in-design-there-are-no-rules/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1665406510231-6a3615a7c00e.jpeg">
          <h5><span>It’s a new era in design, there are no rules</span></h5><time>March 23, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/products-is-a-visual-art-and-speak-for-themselves/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1551027188-2fcf968a2cd6.jpeg">
          <h5><span>Products is a visual art, and speak for themselves</span></h5><time>August 6, 2021</time>
        </a><a href="https://reiro-dark.fueko.net/you-have-to-fight-to-reach-your-dream/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1613498382159-0972b7b4c9f1.jpeg">
          <h5><span>You have to fight to reach your dream</span></h5><time>September 27, 2022</time>
        </a><a href="https://reiro-dark.fueko.net/the-perfect-place-that-helps-you-get-work-done-in-peace/"><img src="https://reiro-dark.fueko.net/content/images/2022/10/photo-1487017159836-4e23ece2e4cf.jpeg">
          <h5><span>The perfect place that helps you get work done in peace</span></h5><time>May 19, 2021</time>
        </a>
      </div>
    </div>
  </div>
  <div class="search-overlay"></div>
</div>
<!-- <script src="<?php echo media() . 'js/globala108.js' ?>"></script>
<script src="<?php echo media() . 'js/indexa108.js' ?>"></script> -->
<script src="<?php echo media() . 'js/blog.js' ?>"></script>
</body>

</html>