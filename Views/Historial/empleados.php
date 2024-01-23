<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Historial de Contenedores</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblHempleados">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>area</th>
                                <th>nombres	</th>
                                <th>apellidos</th>
                                <th>dni</th>
                                <th>email</th>
                                <th>fecha de nacimiento</th>
                                <th>licencia_conducir</th>
                                <th>profesion</th>
                                <th>Fecha</th>
                                <th>Usuario</th>         
                                <th>Evento</th>
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
<?php include "Views/Templates/footer.php"; ?>