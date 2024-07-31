$(document).ready(function () {
  $.ajax({
    url: "php/get_provincias.php",
    method: "GET",
    success: function (data) {
      $("#provincia").html(data);
    },
  });

  $("#provincia").change(function () {
    var provincia_id = $(this).val();
    if (provincia_id) {
      $("#municipalidad").prop("disabled", false);
      $.ajax({
        url: "php/get_municipalidades.php",
        method: "GET",
        data: { provincia_id: provincia_id },
        success: function (data) {
          $("#municipalidad").html(data);
        },
      });
    } else {
      $("#municipalidad").prop("disabled", true);
      $("#municipalidad").html(
        '<option value="">Seleccione una provincia primero</option>'
      );
    }
  });

  $.ajax({
    url: "php/get_candidatos.php",
    method: "GET",
    success: function (data) {
      $("#candidato").html(data);
    },
  });
});

function votar() {
  var form = $(votacionForm);
  var dni = $("#dni").val();
  var dniFormato = /^\d{8}-\d{1}$/;
  var datosForm = form.serializeArray();
  var mediosSeleccionados = form.find('input[name="medio[]"]:checked').length;
  var provincia = $("#provincia").val();
  var municipalidad = $("#municipalidad").val();
  var candidato = $("#candidato").val();

  var validaciones = [
    {
      message: "El DNI debe tener el formato ########-# (Ej: 71838371-0).",
      condition: !dniFormato.test(dni),
    },
    {
      message:
        "Al menos debe seleccionar dos opciones de como se enteró sobre nosotros. Reintentar",
      condition: mediosSeleccionados < 2,
    },
    { message: "Debe seleccionar una provincia.", condition: !provincia },
    {
      message: "Debe seleccionar una municipalidad.",
      condition: !municipalidad,
    },
    { message: "Debe seleccionar un candidato.", condition: !candidato },
  ];

  for (var i = 0; i < validaciones.length; i++) {
    if (validaciones[i].condition) {
      alert(validaciones[i].message);
      return false;
    }
  }

  $.ajax({
    url: "php/votar.php",
    method: "POST",
    data: datosForm,
    success: function (response) {
      alert(response);
    },
  });
}
