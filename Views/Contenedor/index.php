<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Contenedor</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmContenedor()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblContenedor">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>Tipo Contenedor</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                              <th>Acciones</th>
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
<div id="nuevoContenedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Contenedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmContenedor">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">

                                <input id="codigo_contenedor" class="form-control" type="text" name="codigo_contenedor" required placeholder="Código de Contenedor">
                                <label for="nombre">Tipo de Contenedor</label>
                                <input id="tipo_contenedor" class="form-control" type="text" name="tipo_contenedor" required placeholder="Tipo de Contenedor">
                                <label for="descripcion">Descripción</label>
                                <input id="descripcion_contenedor" class="form-control" type="text" name="descripcion_contenedor" required placeholder="Descripcion de Contenedor">


                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarContenedor(event)" id="btnAccion">Registrar</button>
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