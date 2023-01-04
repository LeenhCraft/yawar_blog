function c(ths, e) {
  e.preventDefault();
  let form = $(ths);
  let dat = new FormData(form[0]);
  let cont = $(".cf");
  let ajaxUrl = base_url + "leenh/c";
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
