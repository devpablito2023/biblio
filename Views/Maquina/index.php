<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Recetas</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmMaquina()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblMaquina">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>producto</th>
                                <th>marca</th>
                                <th>modelo</th>
                                <th>regrigerante</th>
                                <th>serie</th>
                                <th>controlador</th>
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
<div id="nuevoMaquina" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Recetas</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmMaquina">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">
                                <input id="codigo" class="form-control" type="text" name="codigo" required placeholder="Codigo ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="producto">Producto</label>
                                <input id="producto" class="form-control" type="text" name="producto" required placeholder="producto">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input id="marca" class="form-control" type="text" name="marca" required placeholder="marca">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input id="modelo" class="form-control" type="text" name="modelo" required placeholder="Modelo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Refrigerante">Refrigerante</label>
                                <input id="Refrigerante" class="form-control" type="text" name="Refrigerante" required placeholder="Refrigerante">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="serie">Serie</label>
                                <input id="serie" class="form-control" type="text" name="serie" required placeholder="serie">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="controlador">controlador</label>
                                <input id="controlador" class="form-control" type="text" name="controlador" required placeholder="controlador">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarMaquina(event)" id="btnAccion">Registrar</button>
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