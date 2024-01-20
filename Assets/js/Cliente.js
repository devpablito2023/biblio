let tblCliente;

function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}

document.addEventListener("DOMContentLoaded", function () {
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
    const buttons = [{
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

    tblCliente = $('#tblCliente').DataTable({
        ajax: {
            url: base_url + "Cliente/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'codigo_cliente'
            },
            {
                'data': 'cliente'
            },
            {
                'data': 'contacto'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'email'
            },
            {
                'data': 'tiempo_contrato'
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

function btnEditarCliente(id) {
    document.getElementById("title").textContent = "Actualizar Cliente";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Cliente/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo_cliente").value = res.codigo_cliente;
            document.getElementById("nombre_cliente").value = res.cliente;
            document.getElementById("contacto_cliente").value = res.contacto;
            document.getElementById("telefono_cliente").value = res.telefono;
            document.getElementById("email_cliente").value = res.email;
            document.getElementById("tiempo_contrato").value = res.tiempo_contrato;

            $("#nuevoCliente").modal("show");
        }
    }
}

function btnEliminarCliente(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La Cliente no se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cliente/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCliente.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function registrarCliente(e) {
    e.preventDefault();
    const nombre_cliente = document.getElementById("nombre_cliente");
    if (nombre_cliente.value == "") {
        alertas('El Nombre del Cliente es requerido', 'warning');
    } else {
        const url = base_url + "Cliente/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoCliente").modal("hide");
                frm.reset();
                tblCliente.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function frmCliente() {
    document.getElementById("title").textContent = "Nueva Cliente";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmCliente").reset();
    document.getElementById("id").value = "";
    $("#nuevoCliente").modal("show");
}

function btnReingresarCliente(id) {
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
            const url = base_url + "Cliente/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblCliente.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

$('.cliente').select2({
    placeholder: 'Buscar Cliente',
    ajax: {
        url: base_url + 'Cotizacion/buscarCliente',
        dataType: 'json',
        delay: 100,
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