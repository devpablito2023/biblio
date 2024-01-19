
<?php
class Recetas extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        // verificacion del permiso 
        $perm = $this->model->verificarPermisos($id_user, "Recetas");
        if (!$perm && $id_user != 1) {
            // no tines permiso 
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getRecetas();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarReceta(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarReceta(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarReceta(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }





        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editReceta($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo_receta = strClean($_POST['codigo_receta']);
        $nombre_receta = strClean($_POST['nombre_receta']);
        $descripcion_receta = strClean($_POST['descripcion_receta']);
        $usuario_activo = $_SESSION['id_usuario'];
        $id = strClean($_POST['id']);
        if (empty($nombre_receta) || empty($codigo_receta)||empty($descripcion_receta)) {
            $msg = array('msg' => 'El nombre de Receta es requerido', 'icono' => 'warning');
        } else {
            if ($id == "") {
                //se guarda si id es vacio 
                $data = $this->model->insertarReceta($codigo_receta,$nombre_receta,$descripcion_receta,$usuario_activo);
                if ($data == "ok") {
                    // guardar los datos en el historico de receta
                    $evento="CREADO";
                    //consultar el id que acabamos de crear
                    $id_consulta = $this->model->IdReceta($nombre_receta);
                    $id=$id_consulta['id'];
                    // insertamos el evento en tabla historica
                    $data2 = $this->model->h_receta($id,$codigo_receta,$nombre_receta,$descripcion_receta,$usuario_activo,$evento );
                    $msg = array('msg' => 'Receta registrada', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La Receta ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                // se actualiza si id tiene informacion
                $data = $this->model->actualizarReceta($codigo_receta,$nombre_receta,$descripcion_receta,$usuario_activo, $id);
                if ($data == "modificado") {
                    // guardar los datos en el historico de receta}
                    $evento="MODIFICADO";
                    $data2 = $this->model->h_receta($id,$codigo_receta,$nombre_receta,$descripcion_receta,$usuario_activo,$evento );
                    $msg = array('msg' => 'Receta modificado', 'icono' => 'success');
                } else if($data==2){
                    $msg = array('msg' => 'ya existe una receta con ese nombre', 'icono' => 'error');

                }
                
                else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    } 
    public function eliminar($id)
    {
        // primero debemos  consultar la informacion con el id que tenemos 
        //para obtenr todos los datos
        $data = $this->model->estadoReceta(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Receta dado de baja', 'icono' => 'success');
        } 
        
        else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar($id)
    {
        $data = $this->model->estadoReceta(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Receta restaurada', 'icono' => 'success');
        } 
        else if($data == 2){
            $msg = array('msg' => 'ya existe una receta con ese nombre', 'icono' => 'error');

        }
       
        else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>