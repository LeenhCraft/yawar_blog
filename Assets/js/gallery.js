function newGal(ths, e) {
  let elemetn = $(".new-tag");
  if (elemetn.hasClass("active")) {
    $(".new-tag").hide("slow").removeClass("active").addClass("inactive");
  } else {
    $(".new-tag").show("slow").removeClass("inactive").addClass("active");
  }
}

function mostrarImg(ths, e) {
  let file = ths.files[0];
  let cont = $(ths).parent();
  let view = cont.find("img");
  let nombre = cont.find(".kg-file-card-filename");
  let peso = cont.find(".kg-file-card-filesize");
  view.attr("src", URL.createObjectURL(file));
  nombre.html(file.name);
  peso.html(parseInt(file.size / 1024) + " KB");
}

function saveGal(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);

  let ajaxUrl = base_url + "YawarGalleries/save";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      console.log(objData);
      //   if (objData.status) {
      //     $("#img")
      //       .removeClass("error")
      //       .addClass("success")
      //       .find(".message")
      //       //   .removeClass("d-none")
      //       .addClass("kg-callout-card-blue");
      //     $(".message").show("slow");
      //     $(".alert-success").html(objData.text);
      //   } else {
      //     // Swal.fire("Error", objData.text, "warning");
      //     $("#img")
      //       .removeClass("success")
      //       .addClass("error")
      //       .find(".message")
      //       //   .removeClass("d-none")
      //       .addClass("kg-callout-card-yellow");
      //     $(".message").show("slow");
      //     $(".alert-error").html(objData.text);
      //   }
    },
    error: function (error) {
      alert(error);
    },
  });
}

function updImgTag(ths, e) {
  e.preventDefault();
  if (confirm("¿Estas seguro de actualizar la imagen?")) {
    mostrarImg(ths, e);
  }
  let form = $(".formtag");
  let dat = new FormData(form[0]);

  let ajaxUrl = base_url + "YawarTags/updImgTag";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      console.log(objData);
      if (objData.status) {
        $("#img")
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        $(".message").show("slow");
        $(".alert-success").html(objData.text);
      } else {
        // Swal.fire("Error", objData.text, "warning");
        $("#img")
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        $(".message").show("slow");
        $(".alert-error").html(objData.text);
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}

function updGal(ths, e) {
  e.preventDefault();
  if (confirm("¿Estas seguro de actualizar la galeria?")) {
    let form = $("#frmGal");
    let dat = new FormData(form[0]);

    let ajaxUrl = base_url + "YawarGalleries/updGal";
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: dat,
      processData: false,
      contentType: false,
      success: function (data) {
        let objData = JSON.parse(data);
        if (objData.status) {
          $("#frmGal")
            .removeClass("error")
            .addClass("success")
            .find(".message")
            //   .removeClass("d-none")
            .addClass("kg-callout-card-blue");
          $(".alert-success").html(objData.text);
          $(".message").show("slow");
        } else {
          // Swal.fire("Error", objData.text, "warning");
          $("#frmGal")
            .removeClass("success")
            .addClass("error")
            .find(".message")
            //   .removeClass("d-none")
            .addClass("kg-callout-card-yellow");
          $(".alert-error").html(objData.text);
          $(".message").show("slow");
        }
      },
      error: function (error) {
        alert(error);
      },
    });
  }
}

let listPostAso = [];

function postAso(ths, e) {
  e.preventDefault();
  let a = $(".search-input-leenh").val();
  if (Object.entries(listPostAso).length === 0) {
    let ajaxUrl = base_url + "Web/buscarPosts/";
    $.get(ajaxUrl, function (data) {
      let objData = JSON.parse(data);
      if (objData.status) {
        listPostAso = objData.data.slice();
      }
    });
  } else {
    let contenedor = $(".search-form-leenh");
    let result = contenedor.find(".search-result");
    let counter = contenedor.find(".search-counter");
    let count = contenedor.find(".search-counter span");
    let info = contenedor.find(".search-info");
    let results = contenedor.find(".search-results");

    const options = {
      keys: ["title"],
    };
    const fuse = new Fuse(listPostAso, options);
    var resultSearch = fuse.search(a);
    var z = resultSearch.length;
    if (a.length > 2) {
      results.html("");
      info.addClass("is-hide");
      counter.removeClass("is-hide");
      count.html(z);
      const opciones = {
        weekday: "long",
        year: "numeric",
        month: "short",
        day: "numeric",
      };
      resultSearch.forEach(function (item, index) {
        let fecha = new Date(item.item.date);
        let html = `
          <a href="javascript:addPostAso(this,${item.item.num})">
          <img style="width: 70px;height:70px" src="${item.item.img}">
          <h5 style="margin:0;"><span>${item.item.title}</h5>
          <time>${fecha.toLocaleDateString("es-pe", opciones)}</time>
          </a>
        `;
        results.append(html);
      });
    } else {
      results.html("");
      info.removeClass("is-hide");
      counter.addClass("is-hide");
    }
  }
}

function editPostAso(ths, e) {
  let section = $(".search-form-leenh");
  let input = section.find(".search-input-leenh");
  if (section.hasClass("is-hide")) {
    section.removeClass("is-hide").show("slow");
    input.focus();
  } else {
    section.addClass("is-hide").hide("slow");
  }
}

function addPostAso(ths, num) {
  if (confirm("¿Estas seguro de actualizar la galeria?")) {
    let dat = new FormData();
    dat.append("post", num);
    dat.append("_token", $('[name="_token"]').val());
    dat.append("_gal", $('[name="_gal"]').val());
    console.log(dat);

    let contenedor = $(".search-form-leenh");
    let counter = contenedor.find(".search-counter");
    let info = contenedor.find(".search-info");
    let results = contenedor.find(".search-results");

    let ajaxUrl = base_url + "YawarGalleries/assoPost/";
    $.ajax({
      type: "POST",
      url: ajaxUrl,
      data: dat,
      processData: false,
      contentType: false,
      success: function (data) {
        let objData = JSON.parse(data);
        if (objData.status) {
          $("#frmGal")
            .removeClass("error")
            .addClass("success")
            .find(".message")
            //   .removeClass("d-none")
            .addClass("kg-callout-card-blue");
          $(".alert-success").html(objData.text);
          $(".message").show("slow");
          window.location.reload();
        } else {
          // Swal.fire("Error", objData.text, "warning");
          $("#frmGal")
            .removeClass("success")
            .addClass("error")
            .find(".message")
            //   .removeClass("d-none")
            .addClass("kg-callout-card-yellow");
          $(".alert-error").html(objData.text);
          $(".message").show("slow");
          $("#btnpostaso").trigger("click");
        }
      },
      error: function (error) {
        alert(error);
      },
    });
  }
}

function viewImgGal(ths, e) {
  if (confirm("¿Quiere agregar esta imagen a la galeria?")) {
    mostrarImg(ths, e);
    $("#img").trigger("onsubmit");
  }
}

function addImgGal(ths, e) {
  let form = $(ths);
  let dat = new FormData(form[0]);
  let ajaxUrl = base_url + "YawarGalleries/addImgGal/";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      if (objData.status) {
        $("#frmGal")
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        $(".alert-success").html(objData.text);
        $(".message").show("slow");
        window.location.reload();
      } else {
        // // Swal.fire("Error", objData.text, "warning");
        // $("#frmGal")
        //   .removeClass("success")
        //   .addClass("error")
        //   .find(".message")
        //   //   .removeClass("d-none")
        //   .addClass("kg-callout-card-yellow");
        // $(".alert-error").html(objData.text);
        // $(".message").show("slow");
        // $("#btnpostaso").trigger("click");
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}

function delImgGal(a, b) {
  if (confirm("¿Estas seguro de eliminar esta imagen?")) {
    let tk = $('[name="_token"]').val();
    let ajaxUrl = base_url + "YawarGalleries/delImgGal/";
    $.post(ajaxUrl, { a: a, b: b, _token: tk }, function (data) {
      let objData = JSON.parse(data);

      if (objData.status) {
        $("#frmGal")
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        $(".alert-success").html(objData.text);
        $(".message").show("slow");
        window.location.reload();
      } else {
        $("#frmGal")
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        $(".alert-error").html(objData.text);
        $(".message").show("slow");
      }
    });
  }
}

function delPostAso(post, gal) {
  if (confirm("¿Estas seguro de eliminar el post asociado?")) {
    let tk = $('[name="_token"]').val();
    let ajaxUrl = base_url + "YawarGalleries/delPostAso/";
    $.post(
      ajaxUrl,
      { post: post, _gal: gal, _token: tk },
      function (data) {
        let objData = JSON.parse(data);
        if (objData.status) {
          $("#frmGal")
            .removeClass("error")
            .addClass("success")
            .find(".message")
            .addClass("kg-callout-card-blue");
          $(".alert-success").html(objData.text);
          $(".message").show("slow");
          window.location.reload();
        } else {
          $("#frmGal")
            .removeClass("success")
            .addClass("error")
            .find(".message")
            .addClass("kg-callout-card-yellow");
          $(".alert-error").html(objData.text);
          $(".message").show("slow");
        }
      }
    );
  }
}
