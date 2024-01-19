<?php
class General extends Controller
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
        $perm = $this->model->verificarPermisos($id_user, "General");
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
        $data = $this->model->getGeneral();

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarGeneral(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarGeneral(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Eliminado</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarGeneral(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }





        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editGeneral($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre_General = strClean($_POST['nombre_General']);
        $ruc_general = strClean($_POST['ruc_general']);
        $telefono_general = strClean($_POST['telefono_general']);
        $direccion_general = strClean($_POST['direccion_general']);
        $logo_general = strClean($_POST['logo_general']);
        $correo_general = strClean($_POST['correo_general']);
        $usuario_activo = $_SESSION['id_usuario'];
        $id = strClean($_POST['id']);
        if (empty($nombre_General) || empty($ruc_general) ||empty($telefono_general) || empty($direccion_general) || empty($logo_general) || empty($correo_general)) {
            $msg = array('msg' => 'Llenar los datos requerido', 'icono' => 'warning');
        } else {
            if ($id == "") {
                //se guarda si id es vacio 
                $data = $this->model->insertarGeneral($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo);
                if ($data == "ok") {
                    // guardar los datos en el historico de receta
                    $evento = "CREADO";
                    //consultar el id que acabamos de crear
                    $id_consulta = $this->model->IdGeneral($nombre_General);
                    $id = $id_consulta['id'];
                    // insertamos el evento en tabla historica
                    $data2 = $this->model->h_general($id, $nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $evento);
                    $msg = array('msg' => 'General registrada', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => ' General ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                // se actualiza si id tiene informacion
                $data = $this->model->actualizarGeneral($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $id);
                if ($data == "modificado") {
                    // guardar los datos en el historico de receta}
                    $evento = "MODIFICADO";
                    $data2 = $this->model->h_general($id, $nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $evento);
                    $msg = array('msg' => 'General modificado', 'icono' => 'success');
                } else if ($data == 2) {
                    $msg = array('msg' => 'ya existe una Cliente con ese nombre', 'icono' => 'error');

                } else {
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
        $data = $this->model->estadoGeneral(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Cliente dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar($id)
    {
        $data = $this->model->estadoGeneral(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Cliente restaurada', 'icono' => 'success');
        } else if ($data == 2) {
            $msg = array('msg' => 'ya existe una Cliente con ese nombre', 'icono' => 'error');

        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>