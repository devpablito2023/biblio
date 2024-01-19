let tblAlmacen;

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

    tblAlmacen = $('#tblAlmacen').DataTable({
        ajax: {
            url: base_url + "Almacen/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'codigo_almacen'
            },
            {
                'data': 'nombre_almacen'
            },
            {
                'data': 'descripcion'
            },
            {
                'data': 'ubicacion'
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

function btnEditarAlmacen(id) {
    document.getElementById("title").textContent = "Actualizar Almacen";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Almacen/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo_almacen").value = res.codigo_almacen;
            document.getElementById("nombre_almacen").value = res.nombre_almacen;
              document.getElementById("descripcion_almacen").value = res.descripcion;
            document.getElementById("ubicacion_almacen").value = res.ubicacion;
           

            $("#nuevoAlmacen").modal("show");
        }
    }
}

function btnEliminarAlmacen(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El almacen no se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Almacen/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAlmacen.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function registrarAlmacen(e) {
    e.preventDefault();
    const nombre_almacen = document.getElementById("nombre_almacen");
    if (nombre_almacen.value == "") {
        alertas('El Nombre del Almacen es requerido', 'warning');
    } else {
        const url = base_url + "Almacen/registrar";
        const frm = document.getElementById("frmAlmacen");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoAlmacen").modal("hide");
                frm.reset();
                tblAlmacen.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function frmAlmacen() {
    document.getElementById("title").textContent = "Nuevo Almacen";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmAlmacen").reset();
    document.getElementById("id").value = "";
    $("#nuevoAlmacen").modal("show");
}

function btnReingresarAlmacen(id) {
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
            const url = base_url + "Almacen/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAlmacen.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
