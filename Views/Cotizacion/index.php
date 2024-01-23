<?php include "Views/Templates/header.php"; ?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Cotizacion</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" onclick="frmCotizacion()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblCotizacion">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>N° de cotizacion </th>
                                <th>Cliente</th>
                                <th>Monto</th>
                                <th>Asunto</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="nuevoCotizacion" class="modal fade" role="dialog"   aria-labelledby="my-modal-title" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="title">Registro Cotizacion</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
                <form id="frmCotizacion" class="row" onsubmit="registrarCotizacion(event)">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="codigoCotizacion">Código *</label>
                            <input type="hidden" id="id" name="id">
                            <input id="codigoCotizacion" class="form-control" type="text" name="codigoCotizacion" placeholder="Código del Cotizacion" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cliente">Cliente*</label><br>
                            <select id="cliente" class="form-control cliente" name="cliente" required style="width: 100%;">                            
                            </select>
                        </div>
                    </div>
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monto">Monto</label><br>
                            <input id="monto" class="form-control" type="text" name="monto" placeholder="Monto" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asunto">asunto</label><br>
                            <input id="asunto" class="form-control" name="asunto" rows="2" placeholder="asunto ..."></input>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                            <button class="btn btn-danger" data-dismiss="modal" type="button">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="nuevoCategoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title1">Registro Recetas</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmCategorias">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <input type="hidden" id="id1" name="id1">

                                <label for="nombre">Nombre</label>
                                <input id="nombre_categoria" class="form-control" type="text" name="nombre_categoria" required placeholder="Nombre de Categoria">
                                <label for="descripcion">Descripción</label>
                                <input id="descripcion_categoria" class="form-control" type="text" name="descripcion_categoria"  placeholder="Descripcion de Categoria">


                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" id="btnAccion1" name="btnAccion1">Registrar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>