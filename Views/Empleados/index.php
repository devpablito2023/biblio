<?php include "Views/Templates/header.php"; ?>

<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Cotizacion</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" onclick="frmEmpleados()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblEmpleados">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Area </th>
                                <th>nombres</th>
                                <th>apellidos</th>
                                <th>dni</th>
                                <th>email</th>
                                <th>fecha_nacimiento</th>
                                <th>licencia_conducir</th>
                                <th>profesion</th>
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

<div id="nuevoEmpleados" class="modal fade" role="dialog"   aria-labelledby="my-modal-title" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="title">Registro Empleados</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
         
                <form id="frmEmpleados" class="row" onsubmit="registrarEmpleados(event)">
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="area">Area*</label><br>
                            <input type="hidden" id="id" name="id">
                            <select id="area" class="form-control area" name="area" required style="width: 100%;">                            
                            </select>
                        </div>
                    </div>
                  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label><br>
                            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="nombre" >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellido">Apellidos</label><br>
                            <input id="apellido" class="form-control" name="apellido"  placeholder="apellido ..."></input>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dni">dni</label><br>
                            <input id="dni" class="form-control" name="dni"  placeholder="dni ..."></input>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">email</label><br>
                            <input id="email" class="form-control" name="email"  placeholder="email ..."></input>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha</label><br>
                            <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento"  placeholder="fecha_nacimiento ..."></input>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="licencia_conducir">licencia conducir</label><br>
                            <input id="licencia_conducir" class="form-control" name="licencia_conducir"  placeholder="licencia_conducir ..."></input>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profesion">profesion</label><br>
                            <input id="profesion" class="form-control" name="profesion"  placeholder="profesion ..."></input>

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