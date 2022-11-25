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

  let ajaxUrl = base_url + "Leenh/leenh";
  $.ajax({
    type: "POST",
    url: ajaxUrl,
    data: dat,
    processData: false,
    contentType: false,
    success: function (data) {
      let objData = JSON.parse(data);
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

function saveSign(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);

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
        $("#imgg")
          .removeClass("error")
          .addClass("success")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-blue");
        $("#imgg").find(".alert-success").html(objData.text);
        $("#imgg").find(".message").show("slow");
      } else {
        // Swal.fire("Error", objData.text, "warning");
        $("#imgg")
          .removeClass("success")
          .addClass("error")
          .find(".message")
          //   .removeClass("d-none")
          .addClass("kg-callout-card-yellow");
        $("#imgg").fin(".alert-error").html(objData.text);
        $("#imgg").find(".message").show("slow");
      }
    },
    error: function (error) {
      alert(error);
    },
  });
}
