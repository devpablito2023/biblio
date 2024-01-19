<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Almacen</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmAlmacen()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblAlmacen">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>nombre</th>
                                <th>descripcion</th>
                                <th>ubicacion</th>
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
<div id="nuevoAlmacen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAlmacen">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">

                                <input id="codigo_almacen" class="form-control" type="text" name="codigo_almacen"
                                    required placeholder="Código de Receta">
                                <label for="nombre">Nombre</label>
                                <input id="nombre_almacen" class="form-control" type="text" name="nombre_almacen"
                                    required placeholder="Nombre de almacen">
                                <label for="descripcion">Descripcion</label>
                                <input id="descripcion_almacen" class="form-control" type="text" name="descripcion_almacen"
                                    required placeholder="descripcion de almacen">
                                <label for="ubicacion">Ubicacion</label>
                                <input id="ubicacion_almacen" class="form-control" type="text" name="ubicacion_almacen"
                                    required placeholder="ubicacion de almacen">
                               


                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarAlmacen(event)"
                                    id="btnAccion">Registrar</button>
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