
<?php
class Maquina extends Controller
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
        $perm = $this->model->verificarPermisos($id_user, "Maquina");
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
        $data = $this->model->getMaquina();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarContenedor(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarMaquina(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarContenedor(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }





        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editContenedor($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $codigo = strClean($_POST['codigo']);
        $producto = strClean($_POST['producto']);
        $marca = strClean($_POST['marca']);
        $modelo = strClean($_POST['modelo']);
        $Refrigerante = strClean($_POST['Refrigerante']);
        $serie = strClean($_POST['serie']);
        $controlador = strClean($_POST['controlador']);
        $usuario_activo = $_SESSION['id_usuario'];
        $id = strClean($_POST['id']);
        if (empty($codigo) || empty($producto) || empty($marca) || empty($modelo) || empty($Refrigerante) || empty($serie) || empty($controlador) ) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
        } else {
            if ($id == "") {
                //se guarda si id es vacio 
                $data = $this->model->insertarMaquina($codigo,$producto,$marca,$modelo,$Refrigerante,$serie,$controlador,$usuario_activo);
                if ($data == "ok") {
                    // guardar los datos en el historico de receta
                    $evento="CREADO";
                    //consultar el id que acabamos de crear
                    $id_consulta = $this->model->IdMaquina($codigo);
                    $id=$id_consulta['id'];
                    // insertamos el evento en tabla historica
                    $data2 = $this->model->h_maquina($id,$codigo,$producto,$marca,$modelo,$Refrigerante,$serie,$controlador,$usuario_activo,$evento );
                    $msg = array('msg' => 'Maquina registrada', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La Maquina ya existe', 'icono' => 'warning');
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
        $data = $this->model->estadoMaquina(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Maquina dado de baja', 'icono' => 'success');
        } 
        
        else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar($id)
    {
        $data = $this->model->estadoContenedor(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Contenedor restaurada', 'icono' => 'success');
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