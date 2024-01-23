<?php
class Empleados extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Empleados");
        if (!$perm && $id_user != 1) {
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
        $data = $this->model->getEmpleados();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div class="d-flex">
                <button class="btn btn-primary" type="button" onclick="btnEditarEmpleados(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarEmpleados(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarEmpleados(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $area = strClean($_POST['area']);
        $nombre = strClean($_POST['nombre']);
        $apellido = strClean($_POST['apellido']);
        $dni = strClean($_POST['dni']);
        $email = strClean($_POST['email']);
        $fecha_nacimiento = strClean($_POST['fecha_nacimiento']);
        $licencia_conducir = strClean($_POST['licencia_conducir']);
        $profesion = strClean($_POST['profesion']);
        //identificacion de usuario que crea o modifica el insumo
        $usuario_activo = $_SESSION['id_usuario'];
        $id = strClean($_POST['id']);

        if (empty($area) || empty($nombre) || empty($apellido) || empty($dni) || empty($email) || empty($fecha_nacimiento) || empty($licencia_conducir) || empty($profesion)) {
            $msg = array('msg' => 'Todo los campos * son requeridos', 'icono' => 'warning');
        } else {
            if ($id == "") {
                $data = $this->model->insertarEmpleados($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion, $usuario_activo);
                if ($data == "ok") {
                    // guardar los datos en el historico de insumo
                    $evento = "CREADO";
                    //consultar el id que acabamos de crear
                    $id_consulta = $this->model->IdEmpleados($nombre);
                    $id = $id_consulta['id'];
                    // insertamos el evento en tabla historica
                    $data2 = $this->model->h_empleado($id, $area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion, $usuario_activo, $evento);
                    $msg = array('msg' => 'Empleado registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'Codigo o nombre de Empleado  ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
              
                //pedir datos para evitar duplicidad 
                $duplicidad = $this->model->analizarEmpleados($nombre, $apellido);
                if ($id != $duplicidad['id']) {
                    $msg = array('msg' => 'Cotizacion Duplicado , verifique los datos', 'icono' => 'warning');
                } else {
                    $data = $this->model->actualizarEmpleados($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$usuario_activo, $id);
                    if ($data == "modificado") {
                     
                        $evento = "MODIFICADO";
                        $data2 = $this->model->h_empleado($id, $area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion, $usuario_activo, $evento);
                        $msg = array('msg' => 'Empleado modificado', 'icono' => 'success');
                    } else {
                        $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                    }

                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editEmpleados($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoEmpleados(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Empleados dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoEmpleados(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Insumo restaurada', 'icono' => 'success');
        } else if ($data == 2) {
            $msg = array('msg' => 'ya existe una Cotizacion con ese codigo o nombre', 'icono' => 'error');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    // public function verificar($id_libro)
    // {
    //     if (is_numeric($id_libro)) {
    //         $data = $this->model->editLibros($id_libro);
    //         if (!empty($data)) {
    //             $msg = array('cantidad' => $data['cantidad'], 'icono' => 'success');
    //         }
    //     }else{
    //         $msg = array('msg' => 'Error Fatal', 'icono' => 'error');
    //     }
    //     echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    //     die();
    // }

    public function buscarArea()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarArea($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

}
