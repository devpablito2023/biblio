<?php include "Views/Templates/header.php"; ?>



<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Recetas</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmCliente()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblCliente">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>cliente</th>
                                <th>contacto</th>
                                <th>telefono</th>
                                <th>email</th>
                                <th>tiempo_contrato</th>
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
<div id="nuevoCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
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
                <form id="frmCliente">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">

                                <input id="codigo_cliente" class="form-control" type="text" name="codigo_cliente"
                                    required placeholder="Código de Receta">
                                <label for="nombre">Nombre</label>
                                <input id="nombre_cliente" class="form-control" type="text" name="nombre_cliente"
                                    required placeholder="Nombre de cliente">
                                <label for="contacto">contacto</label>
                                <input id="contacto_cliente" class="form-control" type="text" name="contacto_cliente"
                                    required placeholder="contacto de cliente">
                                <label for="telefono">telefono</label>
                                <input id="telefono_cliente" class="form-control" type="text" name="telefono_cliente"
                                    required placeholder="telefono de cliente">
                                <label for="email">email</label>
                                <input id="email_cliente" class="form-control" type="text" name="email_cliente" required
                                    placeholder="email">
                                <label for="tiempo_contrato">tiempo de contrato</label>
                                <input id="tiempo_contrato" class="form-control" type="text" name="tiempo_contrato"
                                    required placeholder="tiempo contrato">



                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarCliente(event)"
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