let tblInsumos; 
function alertas(msg, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: msg,
        showConfirmButton: false,
        timer: 3000
    })
}
$('.categoria').select2({
    placeholder: 'Buscar Categoria',
    minimumInputLength: 2,
    ajax: {
        url: base_url + 'Insumos/buscarCategoria',
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
$('.categoria').on('select2:open', function (e) { 
    $('.categoria').val(null).trigger('change');
});

$('.almacen').select2({
    placeholder: 'Buscar Almacen',
    minimumInputLength: 2,
    ajax: {
        url: base_url + 'Insumos/buscarAlmacen',
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
$('.almacen').on('select2:open', function (e) { 
    $('.almacen').val(null).trigger('change');
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
/*
function frmCategorias() {
    document.getElementById("title1").textContent = "Nueva Categoria";
    document.getElementById("btnAccion1").textContent = "Registrar";
    document.getElementById("frmCategorias").reset();
    document.getElementById("id1").value = "";
    $("#nuevoCategoria").modal("show");
}

*/
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

        tblInsumos = $('#tblInsumos').DataTable({
        ajax: {
            url: base_url + "Insumos/listar",
            dataSrc: ''
        },
        columns: [{
                'data': 'id'
            },
            {
                'data': 'codigo_insumo'
            },
            {
                'data': 'nombre_insumo'
            },
            {
                'data': 'nombre_categoria'
            },
            {
                'data': 'descripcion'
            },
            {
                'data': 'foto'
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

function previewI(e) {
    var input = document.getElementById('imagen');
    var filePath = input.value;
    var extension = /(\.png|\.jpeg|\.jpg)$/i;
    if (!extension.exec(filePath)) {
        alertas('Seleccione un archivo valido', 'warning');
        deleteImg();
        return false;
    }else{
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>
        `;
    }

}

function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}

function frmInsumos() {
    document.getElementById("title").textContent = "Nuevo Insumo";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmInsumo").reset();
    document.getElementById("id").value = "";
    $("#nuevoInsumo").modal("show");
    var newOptionC = new Option("sin categoria", 1,false,false);
    $('.categoria').append(newOptionC).trigger("change");
    $('.categoria').val(1).trigger('change');
    var newOptionA = new Option("Almacen General", 1,false,false);
    $('.almacen').append(newOptionA).trigger("change");
    deleteImg();
}


function registrarInsumo(e) {
    e.preventDefault();
    const codigoInsumo = document.getElementById("codigoInsumo");
    const nombreInsumo = document.getElementById("nombreInsumo");
    const categoria = document.getElementById("categoria");
    const almacen = document.getElementById("almacen");

    if (codigoInsumo.value == '' || nombreInsumo.value == '' || categoria.value == ''
    || almacen.value == '' ) {
        alertas('Todo los campos * son requeridos', 'warning');
    } else {
        const url = base_url + "Insumos/registrar";
        const frm = document.getElementById("frmInsumo");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoInsumo").modal("hide");
                tblInsumos.ajax.reload();
                frm.reset();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarInsumo(id) {

    document.getElementById("title").textContent = "Actualizar Insumo";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Insumos/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            //console.log(res);
            document.getElementById("id").value = res.id;
            document.getElementById("codigoInsumo").value = res.codigo_insumo;
            // ESTE SECTOR ACUMULA LA OPCION SELECCIONADA EN EL SELECT
            var newOptionC= new Option(res.textCategoria, res.categoria_id,false,false);
            //agregara option en el select
            $('.categoria').append(newOptionC).trigger("change");
            //selecciona esa opcion 
            $('.categoria').val(res.categoria_id).trigger('change');
            var newOptionA = new Option(res.textAlmacen, res.almacen_id,false,false);
            $('.almacen').append(newOptionA).trigger("change");
            $('.almacen').val(res.almacen_id).trigger('change');           
            document.getElementById("nombreInsumo").value = res.nombre_insumo;
            document.getElementById("marcaInsumo").value = res.marca;
            document.getElementById("descripcionInsumo").value = res.descripcion;
            document.getElementById("partNumber1").value = res.part_number_1;
            document.getElementById("partNumber2").value = res.part_number_2;
            document.getElementById("partNumber3").value = res.part_number_3;
            document.getElementById("partNumber4").value = res.part_number_4;
            document.getElementById("rack").value = res.rack;
            document.getElementById("anaquel").value = res.anaquel;
            document.getElementById("piso").value = res.piso;
            document.getElementById("sector").value = res.sector;

            document.getElementById("img-preview").src = base_url + 'Assets/img/insumos/'+ res.imagen_insumo; 
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()">
            <i class="fa fa-times-circle"></i></button>`;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("foto_actual").value = res.imagen_insumo;
            $("#nuevoInsumo").modal("show");
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

