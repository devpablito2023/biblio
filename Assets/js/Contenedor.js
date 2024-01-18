let tblContenedor;

function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
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

        tblContenedor = $('#tblContenedor').DataTable({
        ajax: {
            url: base_url + "Contenedor/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo'
            },
            {
                'data': 'tipo_contenedor'
            },
            {
                'data': 'descripcion'
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

function btnEditarContenedor(id) {
    document.getElementById("title").textContent = "Actualizar Contenedor";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Contenedor/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo_contenedor").value = res.codigo;
            document.getElementById("tipo_contenedor").value = res.tipo_contenedor;
            document.getElementById("descripcion_contenedor").value = res.descripcion;                

            $("#nuevoContenedor").modal("show");
        }
    }
}

function btnEliminarContenedor(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La Receta no se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Contenedor/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblContenedor.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function registrarContenedor(e) {
    e.preventDefault();
    const tipo_contenedor = document.getElementById("tipo_contenedor");
    if (tipo_contenedor.value == "") {
        alertas('El Nombre del contenedor es requerido', 'warning');
    } else {
        const url = base_url + "Contenedor/registrar";
        const frm = document.getElementById("frmContenedor");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoContenedor").modal("hide");
                frm.reset();
                tblContenedor.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function frmContenedor() {
    document.getElementById("title").textContent = "Nueva Contenedor";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmContenedor").reset();
    document.getElementById("id").value = "";
    $("#nuevoContenedor").modal("show");
}

function btnReingresarContenedor(id) {
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
            const url = base_url + "Contenedor/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblContenedor.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
