function temporizador(sg) {
  var contador = sg; // Segundos
  if (contador > 0) {
    contador--;
    setTimeout("temporizador()", 1000);
  } else {
    window.location.href = base_url + "account";
  }
}

function registrar_usuario(ths, e) {
  e.preventDefault();
  let form = $(ths).serialize();
  let ajaxUrl = base_url + "Signup/register";
  let btn = $("button");
  let btnHtml = $("button").html();
  btn.html(
    '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
  );
  $('[name="txtnombre"]').attr("readonly", true);
  $('[name="txtpass"]').attr("readonly", true);
  $('[name="txtemail"]').attr("readonly", true);
  $.post(ajaxUrl, form, function (data) {
    $('[name="txtnombre"]').attr("readonly", false);
    $('[name="txtpass"]').attr("readonly", false);
    $('[name="txtemail"]').attr("readonly", false);
    btn.html(btnHtml);
    let objData = JSON.parse(data);
    if (objData.status) {
      $(ths)
        .find(".form")
        .addClass("d-none")
        .parent()
        .find(".alert-success")
        .removeClass("d-none");
      $(".global-question").addClass("d-none");
    } else {
      $(ths).addClass("error");
      $(ths).find(".alert-error").html(objData.text);
      $("#txtpass").val("");
    }
  });
}

function inisiar_sesion(ths, e) {
  e.preventDefault();
  let btn = $("button");
  let btnHtml = $("button").html();
  btn.html(
    '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>'
  );
  let form = $(ths).serialize();
  let ajaxUrl = base_url + "Signin/session";
  $("#txtusuario").attr("disabled", true);
  $("#txtpass").attr("disabled", true);
  $.post(ajaxUrl, form, function (data) {
    let objData = JSON.parse(data);

    if (objData.status) {
      $(ths)
        .find(".form")
        .addClass("d-none")
        .parent()
        .find(".alert-success")
        .removeClass("d-none");
      $(".global-question").addClass("d-none");
      temporizador(10);
    } else {
      $(ths).addClass("error");
      $(ths).find(".alert-error").html(objData.text);
      $("#txtpass").val("");
    }
    btn.html(btnHtml);
    $("#txtusuario").attr("disabled", false);
    $("#txtpass").attr("disabled", false);
  });
}
