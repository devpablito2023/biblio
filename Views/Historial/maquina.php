<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Historial de Maquina</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblHmaquina">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>codigo</th>
                                <th>producto</th>
                                <th>marca</th>
                                <th>modelo</th>
                                <th>regrigerante</th>
                                <th>serie</th>
                                <th>controlador</th>
                                <th>controlador</th>
                                <th>Fecha</th>
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