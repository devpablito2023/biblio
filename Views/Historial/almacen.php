<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Historial de Recetas</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4" id="tblHalmacen">
                        <thead class="thead-dark">
                            <tr>
                                
                                <th>Codigo1</th>
                                <th>Codigo2</th>
                                <th>nombre</th>
                                <th>descripcion</th>
                                <th>ubicacion</th>
                                <th>user</th>
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