<?php
class GeneralModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
    public function getGeneral()
    {
        // si es 1 
        if ($_SESSION['id_usuario'] == 1) {
            $sql = "SELECT * FROM general ";
            $res = $this->selectAll($sql);

        } else {
            $sql = "SELECT * FROM general WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editGeneral($id)
    {
        $sql = "SELECT * FROM general WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarGeneral($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo)
    {
        $verificar = "SELECT * FROM general WHERE nombre_empresa = '$nombre_General' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO general(nombre_empresa,ruc,telefono,direccion,logo,correo,user_c,user_m) VALUES (?,?,?,?,?,?,?,?)";
            $datos = array($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $usuario_activo);
            $data = $this->save($query, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            // si existe informacion 
            $res = "existe";
        }
        return $res;
    }

    public function actualizarGeneral($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $id)
    {
        $fecha = date("Y-m-d H:i:s");
        $verificar = "SELECT * FROM general WHERE nombre_empresa = '$nombre_General' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "UPDATE general SET nombre_empresa = ? , ruc = ? ,telefono = ? ,direccion = ? ,logo = ? ,correo = ?, updated_at = ?  ,user_m = ? WHERE id = ?";
            $datos = array($nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $fecha, $usuario_activo, $id);
            $data = $this->save($query, $datos);
        } else {
            $data = 2;
        }
        if ($data == 1) {
            $res = "modificado";
        } else if ($data == 2) {
            $res = 2;
        } else {
            $res = "error";
        }
        return $res;
    }
    // guardar en el historial 

    public function h_general($id, $nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $evento)
    {
        $query = "INSERT INTO h_general(general_id,nombre_empresa,ruc,telefono,direccion,logo,correo,user,evento) VALUES (?,?,?,?,?,?,?,?,?)";
        $datos = array($id, $nombre_General, $ruc_general, $telefono_general, $direccion_general, $logo_general, $correo_general, $usuario_activo, $evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoGeneral($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM general WHERE id = '$id' ";
        $data_general = $this->select($tomar_datos);
        $nombre_empresa = $data_general['nombre_empresa'];
        $ruc = $data_general['ruc'];
        $telefono = $data_general['telefono'];
        $direccion = $data_general['direccion'];
        $logo = $data_general['logo'];
        $correo = $data_general['correo'];
        $fecha = date("Y-m-d H:i:s");
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if ($estado == 0) {
            $evento = "ELIMINADO";
            $query = "UPDATE general SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha, $user, $estado, $id);
            $data = $this->save($query, $datos);

        } else {
            $evento = "RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM general WHERE nombre_empresa = '$nombre_empresa' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE general SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha, $user, $estado, $id);
                $data = $this->save($query, $datos);
            } else {
                $data = 2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_general(general_id,nombre_empresa,ruc,telefono,direccion,logo,correo,user,evento,estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos_h = array($id, $nombre_empresa, $ruc, $telefono, $direccion, $logo, $correo, $user, $evento, $estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdGeneral($nombre_General)
    {
        $sql = "SELECT id FROM general WHERE nombre_empresa = '$nombre_General' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>