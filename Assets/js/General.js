let tblGeneral;

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

    tblGeneral = $('#tblGeneral').DataTable({
        ajax: {
            url: base_url + "General/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'nombre_empresa'
            },
            {
                'data': 'ruc'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'direccion'
            },
            {
                'data': 'logo'
            },
            {
                'data': 'correo'
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

function btnEditarGeneral(id) {
    document.getElementById("title").textContent = "Actualizar General";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "General/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre_General").value = res.nombre_empresa;
            document.getElementById("ruc_general").value = res.ruc;
            document.getElementById("telefono_general").value = res.telefono;
            document.getElementById("direccion_general").value = res.direccion;
            document.getElementById("logo_general").value = res.logo;
            document.getElementById("correo_general").value = res.correo;

            $("#nuevoGeneral").modal("show");
        }
    }
}

function btnEliminarGeneral(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La General no se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "General/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGeneral.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

function registrarGeneral(e) {
    e.preventDefault();
    const nombre_General = document.getElementById("nombre_General");
    if (nombre_General.value == "") {
        alertas('El Nombre General es requerido', 'warning');
    } else {
        const url = base_url + "General/registrar";
        const frm = document.getElementById("frmGeneral");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoGeneral").modal("hide");
                frm.reset();
                tblGeneral.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function frmGeneral() {
    document.getElementById("title").textContent = "Nueva General";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmGeneral").reset();
    document.getElementById("id").value = "";

    $("#nuevoGeneral").modal("show");
}

function btnReingresarGeneral(id) {
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
            const url = base_url + "General/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblGeneral.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}
