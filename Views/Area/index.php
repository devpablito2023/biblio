<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Area</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmArea()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblArea">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
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
<div id="nuevoArea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Area</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmArea">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <input type="hidden" id="id" name="id">

                                <label for="nombre">Nombre</label>
                                <input id="nombre_area" class="form-control" type="text" name="nombre_area" required placeholder="Nombre de area">
                                <label for="descripcion">Descripción</label>
                                <input id="descripcion_area" class="form-control" type="text" name="descripcion_area" required placeholder="Descripcion de area">


                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarArea(event)" id="btnAccion">Registrar</button>
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