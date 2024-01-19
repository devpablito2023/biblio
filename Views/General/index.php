<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Recetas</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmGeneral()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblGeneral">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>nombre empresa</th>
                                <th>ruc</th>
                                <th>telefono</th>
                                <th>direccion</th>
                                <th>logo</th>
                                <th>correo</th>
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
<div id="nuevoGeneral" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro General</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmGeneral">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">
                                <label for="nombre">Nombre </label>
                                <input id="nombre_General" class="form-control" type="text" name="nombre_General"
                                    required placeholder="Nombre de General">
                                <label for="ruc">Ruc</label>
                                <input id="ruc_general" class="form-control" type="text" name="ruc_general" required
                                    placeholder="contacto de general">
                                <label for="telefono">telefono</label>
                                <input id="telefono_general" class="form-control" type="text" name="telefono_general"
                                    required placeholder="telefono de general">
                                <label for="direccion">Direccion</label>
                                <input id="direccion_general" class="form-control" type="text" name="direccion_general"
                                    required placeholder="email">
                                <label for="logo">Logo</label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <input type="hidden" id="foto_actual" name="foto_actual">
                                        <label for="imagen" id="icon-image" class="btn btn-primary"><i class="fa fa-cloud-upload"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event)">
                                        <img class="img-thumbnail" id="img-preview" width="150">
                                    </div>
                                </div>
                                <label for="correo">Correo</label>
                                <input id="correo_general" class="form-control" type="text" name="correo_general"
                                    required placeholder="tiempo contrato">


                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarGeneral(event)"
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