function updImgAcc(ths, e) {
  e.preventDefault();
  if (confirm("¿Estas seguro de actualizar la imagen?")) {
    mostrarImg(ths, e);
    let form = $(".formtag");
    let dat = new FormData(form[0]);

    let ajaxUrl = base_url + "Account/updImgAcc";
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
            // $("#img")
            //   .removeClass("error")
            //   .addClass("success")
            //   .find(".message")
            //   //   .removeClass("d-none")
            //   .addClass("kg-callout-card-blue");
            // $(".message").show("slow");
            // $(".alert-success").html(objData.text);
        } else {
          //   // Swal.fire("Error", objData.text, "warning");
          //   $("#img")
          //     .removeClass("success")
          //     .addClass("error")
          //     .find(".message")
          //     //   .removeClass("d-none")
          //     .addClass("kg-callout-card-yellow");
          //   $(".message").show("slow");
          //   $(".alert-error").html(objData.text);
        }
      },
      error: function (error) {
        alert(error);
      },
    });
  }
}

function mostrarImg(ths, e) {
  let file = ths.files[0];
  //   console.log(file);
  let cont = $(ths).parent();
  let view = cont.find("img");
  if (view.length == 0) {
    cont.append(`<img style="z-index:0;" src="" alt="${file.name}">`);
    view = cont.find("img");
  } else {
    view = cont.find("img");
  }
  view.attr("src", URL.createObjectURL(file));
}
