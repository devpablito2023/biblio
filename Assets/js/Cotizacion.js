let tblCotizacion; 
function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}

$('.cliente').select2({
    placeholder: 'Buscar Ciente',
    minimumInputLength: 2,
    ajax: {
        url: base_url + 'Cotizacion/buscarCliente',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term               
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
});
// para borrar lo cargado de forma predefinada 
$('.cliente').on('select2:open', function (e) { 
    $('.cliente').val(null).trigger('change');
});




$(document).on('click','#btnCategoria',function(){
    document.getElementById("title1").textContent = "Nueva Categoria";
    document.getElementById("btnAccion1").textContent = "Registrar";
    //document.getElementById("frmCategorias").reset();
    document.getElementById("id").value = "";
    $("#nuevoCategoria").modal("show");

})

$(document).on('click','#btnAccion1',function(){
    const nombre_categoria = document.getElementById("nombre_categoria");
    if (nombre_categoria.value == "") {
        alertas('El Nombre de la Categoria es requerida', 'warning');
    } else {
        const url = base_url + "Categorias/registrar";
        const frm1 = document.getElementById("frmCategorias");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm1));
        //alertas(res.msg, res.icono);
        $("#nuevoCategoria").modal("hide");  
        /*    
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
                $("#nuevoCategoria").modal("hide");
                //frm.reset();
                //tblCategorias.ajax.reload();
                
            }
        }
        */
    }

})
function registrarCategoria(e) {
    e.preventDefault();
    const nombre_receta = document.getElementById("nombre_categoria");
    if (nombre_categoria.value == "") {
        alertas('El Nombre de la Receta es requerida', 'warning');
    } else {
        const url = base_url + "Categorias/registrar";
        const frm = document.getElementById("frmCategorias");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoCategoria").modal("hide");
                frm.reset();
                tblCategorias.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

document.addEventListener("DOMContentLoaded", function(){
    const language = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }

    }
    const  buttons = [{
                //Botón para Excel
                extend: 'excel',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',

                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
            },
            //Botón para PDF
            {
                extend: 'pdf',
                footer: true,
                title: 'Archivo PDF',
                filename: 'reporte',
                text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                title: 'Reportes',
                filename: 'Export_File_print',
                text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
            }
        ]

        tblCotizacion = $('#tblCotizacion').DataTable({
        ajax: {
            url: base_url + "Cotizacion/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'numero_cotizacion'
            },
            {
                'data': 'cliente'
            },
            {
                'data': 'monto'
            },
            {
                'data': 'asunto'
            },          
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });

})




function frmCotizacion() {
    document.getElementById("title").textContent = "Nuevo Cotizacion";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCotizacion").reset();
    document.getElementById("id").value = "";
    $("#nuevoCotizacion").modal("show");
    var newOptionC = new Option("sin registro", 1,false,false);
    $('.cliente').append(newOptionC).trigger("change");
    $('.cliente').val(1).trigger('change');

}


function registrarCotizacion(e) {
    e.preventDefault();
    const codigoCotizacion = document.getElementById("codigoCotizacion");
    const cliente = document.getElementById("cliente");
    const monto = document.getElementById("monto");
    const asunto = document.getElementById("asunto");

    if (codigoCotizacion.value == '' || cliente.value == '' || monto.value == ''
    || asunto.value == '' ) {
        alertas('Todo los campos * son requeridos', 'warning');
    } else {
        const url = base_url + "Cotizacion/registrar";
        const frm = document.getElementById("frmCotizacion");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoCotizacion").modal("hide");
                tblCotizacion.ajax.reload();
                frm.reset();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarCotizacion(id) {

    document.getElementById("title").textContent = "Actualizar Cotizacion";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Cotizacion/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("codigoCotizacion").value = res.numero_cotizacion;
            // ESTE SECTOR ACUMULA LA OPCION SELECCIONADA EN EL SELECT
            var newOptionC= new Option(res.textCliente, res.cliente_id,false,false);
            //agregara option en el select
            $('.cliente').append(newOptionC).trigger("change");
            //selecciona esa opcion 
            $('.cliente').val(res.cliente_id).trigger('change');    
            document.getElementById("monto").value = res.monto;
            document.getElementById("asunto").value = res.asunto;
            $("#nuevoCotizacion").modal("show");
        }
    }
}

function btnEliminarInsumo(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Insumo no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Insumos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblInsumos.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
function btnReingresarInsumo(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Insumos/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblInsumos.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

