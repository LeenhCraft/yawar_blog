$(document).ready(function () {
  listcb();
  $("#txtnom").hide("fast");
  $(".section-apoderado-hidden").hide("fast");
  $("#txtnomapo").hide("fast");
});

// let checkbox = document.getElementById("apoderado");
// if (checkbox.checked) {
//   $(".section-apoderado-hidden").show("fast");
//   // $("#txtnomapo").show("fast");
// }

function viewApoderado(ths) {
  ths.checked
    ? $(".section-apoderado-hidden").show("fast")
    : $(".section-apoderado-hidden").hide("fast");
}

function buscarDni(ths) {
  let dni = $(ths).val();
  let spinner = $("#preloder");
  let nombre = $(ths).parent().find(".name");
  let cel = $(ths).parent().find(".phone");
  if (dni.length == 8) {
    spinner.css("display", "flex");
    $(ths).attr("readonly", true);
    nombre.val("");
    let ajaxUrl = base_url + "web/dni/" + dni;
    // $("#divLoading").css("display", "flex");
    $.get(ajaxUrl, function (data, textStatus, jqXHR) {
      spinner.css("display", "none");
      $(ths).attr("readonly", false);
      nombre.show("slow");
      if (textStatus == "success" && jqXHR.readyState == 4) {
        // $("#divLoading").css("display", "none");
        let objData = JSON.parse(data);
        if (objData.success == true) {
          nombre.val(objData.data.nombre_completo);
          // nombre.val(objData.nombre_completo);
          cel.focus();
        } else {
          //   Toast.fire({
          //     icon: "warning",
          //     title: "No se encontró el DNI, porfavolo ingrese su nombre",
          //   });
          nombre.attr("placeholder", "Ingrese su nombre").focus();
        }
      }
    });
  }
}

function listcb() {
  let url2 = base_url + "Web/filiales";
  $.post(url2, function (data) {
    let objData = JSON.parse(data);
    $("#txtcede").empty();
    $.each(objData, function (key, value) {
      $("#txtcede").append(
        "<option value=" + value.nmr + ">" + value.nombre + "</option>"
      );
    });
  });
}

function saveRegister(ths, e) {
  e.preventDefault();
  // console.log($(ths).serialize());
  let form = new FormData(ths);
  let spinner = $("#preloder");
  let ajaxUrl = base_url + "Web/registrar";
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
        $(".formRegisterNewMember").css("display", "none");
        $("#apoderado").trigger("click");
        $("#frmregister")[0].reset();
        $(".messageFormRegisterNewMember>.message").html(objData.text);
        $(".messageFormRegisterNewMember").show("slow");
      } else {
        $(".formMessageValdiation").html(objData.text).css("display", "flex");
      }
    },
    error: function (error) {
      spinner.css("display", "none");
      alert(error);
    },
  });
}

function limitar(e, contenido, caracteres) {
  var unicode = e.keyCode ? e.keyCode : e.charCode;
  if (
    unicode == 8 ||
    unicode == 46 ||
    unicode == 13 ||
    unicode == 9 ||
    unicode == 37 ||
    unicode == 39 ||
    unicode == 38 ||
    unicode == 40
  ) {
    return true;
  }

  if (contenido.length >= caracteres) {
    return false;
  }

  return true;
}
