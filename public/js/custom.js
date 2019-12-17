var urlProyecto = "https://qrriculum:8890/";


function mostrarInfo(item) {
    $('#divInfo' + item).toggle("slow", function () {
    });

}

function muestraUrl(item) {

    if (item == 2) {
        $('#divFile2').css("display", 'none');
        $('#divUrl2').toggle("slow", function () { });
    } else {
        $('#divFile').css("display", 'none');
        $('#divUrl').toggle("slow", function () { });
    }
}


function muestraFile(item) {

    if (item == 2) {
        $('#divUrl2').css("display", 'none');
        $('#divFile2').toggle("slow", function () {
        });
    } else {
        $('#divUrl').css("display", 'none');
        $('#divFile').toggle("slow", function () {
        });
    }
}


$(document).ready(function () {

    var url = document.location.toString();

    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });
    eyeSlash();
    eye();

    setTimeout(ocultarErrores, 4000);
});

function ocultarErrores() {
    $('.alert').toggle("slow", function () {
    });
}

function eyeSlash() {
    $('.fa-eye').unbind('click').click(function () {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        eye();
    });

}

function eye() {
    $('.fa-eye-slash').unbind('click').click(function () {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        eyeSlash();
    });
}

function puesto_actual(item) {

        // cada vez que se cambia el estado del checkbox trabajo aqui:
        // si el valor es checked desactivamos los selects de año y mes de finalizacion
        // en caso contrario lo habilitamos

        if($(item).prop('checked')==1){
            $('#mes_fin_exp').prop('disabled', 'disabled');
            $('#anio_fin_exp').prop('disabled', 'disabled');
        } else {
            $('#mes_fin_exp').prop('disabled', '');
            $('#anio_fin_exp').prop('disabled', '');

        }


}

/**
 * Recoge el id de la experiencia a editar, lee los datos de la tabla y los carga en los campos del formulario
 * seteamos a true un campo hidden para saber que se está editando cuando se haga submit
 * seteamos un campo hidden con el id del registro que estamos editando
 * @param id = id del registro experiencia a editar
 */
function editarExperiencia(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: urlProyecto + "candidatos/leerunregistro/" + id,
        cache: false,
        method: 'POST'
    })
        .done(function (datos) {

            $('#descripcion').val(datos.registro[0].descripcion);

            $('input[name="cargo"]').val(datos.registro[0].puesto);
            $('input[name="empresa"]').val(datos.registro[0].empresa);
            $('input[name="ubicacion"]').val(datos.registro[0].ubicacion);
            $('input[name="url_experiencia"]').val(datos.registro[0].url);
            $('input[name="tipo_contrato"]').val(datos.registro[0].tipo_contrato);
            $('#tipo_contrato').val(datos.registro[0].tipo_contrato);
            $('#mes_inicio_exp').val(datos.registro[0].mes_comienza);
            $('#anio_inicio_exp').val(datos.registro[0].anio_comienza);
            $('#mes_fin_exp').val(datos.registro[0].mes_termina);
            $('#anio_fin_exp').val(datos.registro[0].anio_termina);
            $('#editando').val(true);
            $('#id_experiencia').val(id);
            $("#actualidad").prop('checked', datos.registro[0].puesto_actual);



            $('#cargo').focus();


            if (!datos.registro[0].url =='') {
                muestraUrl(2);
            }

        });

}
