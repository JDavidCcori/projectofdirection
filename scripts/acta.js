
//AGREGAR NUEVA ACTA
$(document).on('submit', '#guardarActa', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("guardar_acta", true);

    $.ajax({
        type: "POST",
        url: '../../controlador/secretario/actasControlador.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            } else if (res.status == 200) {

                $('#errorMessage').addClass('d-none');
                $('#agregarActaModal').modal('hide');
                $('#guardarActa')[0].reset();

                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");

            } else if (res.status == 500) {
                alert(res.message);
            }
        }
    });

});



//EDITAR Y ACTULIZAR ACTA
$(document).on('click', '.editarActaBtn', function () {


    var numero_acta = $(this).val();


    $.ajax({
        type: "GET",
        url: "../../controlador/secretario/actasControlador.php?numero_acta=" + numero_acta,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 404) {

                alert(res.message);
            } else if (res.status == 200) {

                $('#acta_id').val(res.data.numero_acta);
                $('#asunto').val(res.data.asunto_acta);
                $('#acuerdo').val(res.data.acuerdo_acta);
                $('#lugar').val(res.data.lugar);

                $('#editarModal').modal('show');
            }

        }
    });

});

$(document).on('submit', '#actualizarActa', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_student", true);

    $.ajax({
        type: "POST",
        url: "../../controlador/secretario/actasControlador.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            } else if (res.status == 200) {
                $('#errorMessageUpdate').addClass('d-none');

                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

                // Cierra el modal
                $('#editarModal').modal('hide');

                // Limpia el formulario
                $('#actualizarActa')[0].reset();

                // Recargar la tabla con la actualizacion
                $('#myTable').load(location.href + " #myTable");
            } else if (res.status == 500) {
                alert(res.message);
            }
        }
    });

});



//VER DETALLES ACTA
$(document).on('click', '.verActaBtn', function () {

    var numero_acta = $(this).val();
    $.ajax({
        type: "GET",
        url: "../../controlador/secretario/actasControlador.php?numero_acta=" + numero_acta,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 404) {

                alert(res.message);
            } else if (res.status == 200) {

                $('#id_acta').text(res.data.numero_acta);
                $('#vista_asunto').text(res.data.asunto_acta);
                $('#vista_acuerdo').text(res.data.acuerdo_acta);
                $('#vista_fecha').text(res.data.fecha);
                $('#vista_lugar').text(res.data.lugar);

                $('#ActaVistaModal').modal('show');
            }
        }
    });
});



