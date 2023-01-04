function mostrarImg(ths, e) {
  let file = ths.files[0];
  let cont = $(ths).parent();
  let view = cont.find("img");
  let nombre = cont.find(".kg-file-card-filename");
  let peso = cont.find(".kg-file-card-filesize");
  view.attr("src", URL.createObjectURL(file));
  nombre.html(file.name);
  peso.html(parseInt(file.size / 1024) + " KB");
  //   var img = document.getElementById("img");
  //   img.src = ths.src;
  //   img.style.display = "block";
  //   img.style.left = e.clientX + "px";
  //   img.style.top = e.clientY + "px";
}

function save(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);
  let cont = $("#imgsave");
  let ajaxUrl = base_url + "Leenh/guardar";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      if (objData.status) {
        cont
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        cont.find(".message").show("slow");
        cont.find(".alert-success").html(objData.text);
      } else {
        // Swal.fire("Error", objData.text, "warning");
        cont
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        cont.find(".message").show("slow");
        cont.find(".alert-error").html(objData.text);
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}

function saveSign(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);
  let cont = $("#imgsaveSign");
  let ajaxUrl = base_url + "Leenh/imgSign";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      if (objData.status) {
        cont
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        cont.find(".message").show("slow");
        cont.find(".alert-success").html(objData.text);
      } else {
        // Swal.fire("Error", objData.text, "warning");
        cont
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        cont.find(".message").show("slow");
        cont.find(".alert-error").html(objData.text);
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}

function saveRegister(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);
  let cont = $("#imgSecRegister");
  let ajaxUrl = base_url + "Leenh/imgSecRegister";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
      if (objData.status) {
        cont
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        cont.find(".message").show("slow");
        cont.find(".alert-success").html(objData.text);
      } else {
        // Swal.fire("Error", objData.text, "warning");
        cont
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        cont.find(".message").show("slow");
        cont.find(".alert-error").html(objData.text);
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}
