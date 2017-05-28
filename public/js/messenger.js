$(document).ready(function () {
  setTimeout(function() {
      toastr.options = {
          closeButton: true,
          progressBar: true,
          showMethod: 'slideDown',
          timeOut: 4000
      };
      toastr.success('Tu asesor de inversiones online', 'Bienvenido a ¿Dónde Invierto?');
  }, 1300);

    setTimeout(function () {
        $(".alert-success").slideUp(1500);
    }, 2000);
});
