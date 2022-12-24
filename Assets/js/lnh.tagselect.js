$(function () {
  $(".qtagselect__tag").tagselect({
    // additional class(es)
    // class: "",

    // placeholder
    placeholder: "Seleccione una o más etiquetas",

    // additional class(es) for the dropdown
    // dropClass: "bg-dark",

    // shows the footer in the dropdown
    dropFooter: true,

    // is opened on page load
    isOpen: false,

    // maximum number of tags allowed to select
    maxTag: 4,

    // parent container
    tagParent: "qmain",

    // error message
    tagMessage: "Solo se permite 4 etiquetas!",

    // auto hides after this timeout
    tagMessageHide: "3000",

    // custom styles for the error message
    // tagMessageStyle: "",
  });
});

function createPost(ths, e) {
  e.preventDefault();
  let form = new FormData(ths);
  let spinner = $("#preloder");
  let ajaxUrl = base_url + "Publicar/crear";
  spinner.css("display", "flex");
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: form,
    processData: false,
    contentType: false,
    success: function (data) {
      spinner.css("display", "none");
      let objData = JSON.parse(data);
      // console.log(objData);
      if (objData.status) {
        setTimeout(redirigir(objData.url), 1000);
      } else {
        $(".contentFormCreatePost")
          .css("display", "block")
          .find(".messageFormCreatePost")
          .html(objData.text);
      }
    },
    error: function (error) {
      spinner.css("display", "none");
      alert(error);
    },
  });
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

function redirigir(url) {
  window.location.href = base_url + "YawarPost/" + url;
}
