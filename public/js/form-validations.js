$(function() {
  $("form[name='indicator-form']").validate({
    rules: {
      name: {
        required: true,
        minlength: 2
      },
      formula: {
        required: true,
        minlength: 3
      }
    },
    messages: {
      name: {
        required: "El indicador debe tener un nombre",
        minlength: "El nombre del indicador debe contener al menos 2 caracteres"
      },
      formula: {
        required: "El indicador debe tener una fórmula",
        minlength: "La fórmula debe contener al menos 3 caracteres"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

$(function() {
  $("form[name='methodology-form']").validate({
    rules: {
      name: {
        required: true,
        minlength: 2
      },
    },
    messages: {
      name: {
        required: "La metodología debe tener un nombre",
        minlength: "El nombre de la metodología debe contener al menos 2 caracteres"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
