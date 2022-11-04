document.addEventListener("DOMContentLoaded", function () {
  !(function (e) {
    "use strict";
    const t = document.body,
      n = document.querySelector(".search-section"),
      s = document.querySelectorAll(".search-open"),
      i = document.querySelector(".search-close"),
      c = document.querySelector(".search-input"),
      a = document.querySelector(".search-info"),
      o = document.querySelector(".search-counter"),
      r = document.querySelector(".search-results"),
      d = document.querySelector(".search-counter span"),
      l = document.querySelector(".search-overlay");
    if (n) {
      function u() {
        t.classList.remove("search-is-active"),
          t.classList.add("search-no-active"),
          (c.value = ""),
          (r.innerHTML = ""),
          o.classList.add("is-hide"),
          a.classList.remove("is-hide"),
          window.scrollTo(0, 0);
      }
      t.addEventListener("keyup", function (e) {
        // alert(e.keyCode);
        if (e.altKey && 70 === e.keyCode) {
          t.classList.add("search-is-active"),
            t.classList.remove("search-no-active"),
            (n.style.display = "block"),
            c.focus();
        }
        27 == e.keyCode && u(); //si se presiona la tecla escape, se cierra la busqueda
      }),
        i.addEventListener("click", u),
        l.addEventListener("click", u),
        s.forEach(function (s) {
          s.addEventListener("click", function () {
            t.classList.add("search-is-active"),
              t.classList.remove("search-no-active"),
              (n.style.display = "block"),
              c.focus();
          }),
            s.addEventListener("click", function () {
              // if (!1 === m) {
              //   var t = options.api,
              //     n = new XMLHttpRequest();
              //   n.open("GET", t, !0),
              //     (n.onload = function () {
              //       var e, t;
              //       n.status >= 200 &&
              //         n.status < 400 &&
              //         (n.response,
              //         (e = JSON.parse(n.responseText)),
              //         (t = new Fuse(e.posts, options)),
              //         (c.onkeyup = function (e) {
              //           if (
              //             ((d.innerHTML = ""),
              //             (r.innerHTML = ""),
              //             this.value.length > 2 &&
              //               (a.classList.add("is-hide"),
              //               o.classList.remove("is-hide")),
              //             this.value.length < 3 &&
              //               (a.classList.remove("is-hide"),
              //               o.classList.add("is-hide")),
              //             !(this.value.length <= 2))
              //           ) {
              //             const n = t.search(e.target.value, {
              //               limit: options.limit,
              //             });
              //             (d.innerHTML = n.length),
              //               n.map(function (e) {
              //                 var t = new Date(
              //                     e.item.published_at
              //                   ).toLocaleDateString(
              //                     document.documentElement.lang,
              //                     {
              //                       year: "numeric",
              //                       month: "long",
              //                       day: "numeric",
              //                     }
              //                   ),
              //                   n = document.createElement("time"),
              //                   s = document.createElement("h5"),
              //                   i = document.createElement("span"),
              //                   c = document.createElement("a");
              //                 if (!0 === options.images) {
              //                   var a = document.createElement("img");
              //                   null !== e.item.feature_image &&
              //                     (a.setAttribute("src", e.item.feature_image),
              //                     c.appendChild(a));
              //                 }
              //                 (n.textContent = n.innerHTML += t),
              //                   (i.textContent = e.item.title),
              //                   c.setAttribute("href", e.item.url),
              //                   s.appendChild(i),
              //                   r.appendChild(c),
              //                   c.appendChild(s),
              //                   c.appendChild(n);
              //               });
              //           }
              //         }));
              //     }),
              //     n.send(),
              //     s.removeEventListener("click", e);
              // }
              // m = !0;
              // alert('aca');
            });
        });
      var m = !1;
    }
  })(window);
});

const readingProgress = (e, t) => {
  const o = document.querySelector(e),
    n = document.querySelector(t),
    a = () => {
      const e = o.getBoundingClientRect(),
        t = window.innerHeight / 2;
      Math.round(n.max - n.value);
      e.top > t && (n.value = 0),
        e.top < t && (n.value = n.max),
        e.top <= t &&
          e.bottom >= t &&
          (n.value = (n.max * Math.abs(e.top - t)) / e.height),
        window.addEventListener("scroll", a);
    };
  window.addEventListener("scroll", a);
};

/* Custom settings for progress bar */
!(function () {
  const a = document.querySelector(".post-progress");
  a && readingProgress(".post-content", ".post-progress");
})();

/* estilo de la galeria */
// document.querySelectorAll(".kg-gallery-image img").forEach(function (e) {
//   const t = e.closest(".kg-gallery-image"),
//     a = e.attributes.width.value / e.attributes.height.value;
//   t.style.flex = a + " 1 0%";
// })