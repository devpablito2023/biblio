let tblEmpleados; 
function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}

$('.area').select2({
    placeholder: 'Buscar Area',
    minimumInputLength: 2,
    ajax: {
        url: base_url + 'Empleados/buscarArea',
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
$('.area').on('select2:open', function (e) { 
    $('.area').val(null).trigger('change');
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

        tblEmpleados = $('#tblEmpleados').DataTable({
        ajax: {
            url: base_url + "Empleados/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'area'
            },
            {
                'data': 'nombres'
            },
            {
                'data': 'apellidos'
            },
            {
                'data': 'dni'
            },  
            {
                'data': 'email'
            },
            {
                'data': 'fecha_nacimiento'
            },
            {
                'data': 'licencia_conducir'
            },    
            {
                'data': 'profesion'
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




function frmEmpleados() {
    document.getElementById("title").textContent = "Nuevo Empleados";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmEmpleados").reset();
    document.getElementById("id").value = "";
    $("#nuevoEmpleados").modal("show");
    var newOptionC = new Option("sin registro", 1,false,false);
    $('.area').append(newOptionC).trigger("change");
    $('.area').val(1).trigger('change');

}


function registrarEmpleados(e) {
    e.preventDefault();
    const area = document.getElementById("area");
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const dni = document.getElementById("dni");
    const email = document.getElementById("email");
    const fecha_nacimiento = document.getElementById("fecha_nacimiento");
    const licencia_conducir = document.getElementById("licencia_conducir");
    const profesion = document.getElementById("profesion");

    if (area.value == '' || nombre.value == '' || apellido.value == '' || dni.value == '' || email.value == '' || fecha_nacimiento.value == '' || licencia_conducir.value == '' || profesion.value == ''  ) {
        alertas('Todo los campos * son requeridos', 'warning');
    } else {
        const url = base_url + "Empleados/registrar";
        const frm = document.getElementById("frmEmpleados");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoEmpleados").modal("hide");
                tblEmpleados.ajax.reload();
                frm.reset();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarEmpleados(id) {

    document.getElementById("title").textContent = "Actualizar Empleados";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Empleados/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("nombre").value = res.nombres;
            // ESTE SECTOR ACUMULA LA OPCION SELECCIONADA EN EL SELECT
            var newOptionC= new Option(res.textArea, res.area_id,false,false);
            //agregara option en el select
            $('.area').append(newOptionC).trigger("change");
            //selecciona esa opcion 
            $('.area').val(res.area_id).trigger('change');    
            document.getElementById("apellido").value = res.apellidos;
            document.getElementById("dni").value = res.dni;
            document.getElementById("email").value = res.email;
            document.getElementById("fecha_nacimiento").value = res.fecha_nacimiento;
            document.getElementById("licencia_conducir").value = res.licencia_conducir;
            document.getElementById("profesion").value = res.profesion;
            $("#nuevoEmpleados").modal("show");
        }
    }
}

function btnEliminarEmpleados(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El Empleado no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Empleados/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEmpleados.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
function btnReingresarEmpleados(id) {
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
            const url = base_url + "Empleados/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblEmpleados.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }

        }
    })
}

