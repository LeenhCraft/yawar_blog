function newTag(ths, e) {
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
  view.attr("src", URL.createObjectURL(file));
}

function saveTag(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);
  let cont = $(".formtag");
  let ajaxUrl = base_url + "YawarTags/save";
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
        console.log(objData.text);
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

function updImgTag(ths, e) {
  e.preventDefault();
  if (confirm("¿Estas seguro de actualizar la imagen?")) {
    mostrarImg(ths, e);
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
}

function updTag(ths, e) {
  e.preventDefault();
  if (confirm("¿Estas seguro de actualizar la etiqueta?")) {
    let form = $(".formtag");
    let dat = new FormData(form[0]);

    let ajaxUrl = base_url + "YawarTags/updTag";
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
}
