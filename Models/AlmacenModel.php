<?php
class AlmacenModel extends Query
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
    public function getAlmacen()
    {
        // si es 1 
        if ($_SESSION['id_usuario'] == 1) {
            $sql = "SELECT * FROM almacen ";
            $res = $this->selectAll($sql);

        } else {
            $sql = "SELECT * FROM almacen WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editAlmacen($id)
    {
        $sql = "SELECT * FROM almacen WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarAlmacen($codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen, $usuario_activo)
    {
        $verificar = "SELECT * FROM almacen WHERE nombre_almacen = '$nombre_almacen' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO almacen(codigo_almacen,nombre_almacen	,descripcion,ubicacion,user_c,user_m) VALUES (?,?,?,?,?,?)";
            $datos = array($codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen, $usuario_activo, $usuario_activo);
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

    public function actualizarAlmacen($codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen, $usuario_activo, $id)
    {
        $fecha = date("Y-m-d H:i:s");
        $verificar = "SELECT * FROM almacen WHERE nombre_almacen = '$nombre_almacen' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "UPDATE almacen SET codigo_almacen = ? , nombre_almacen = ? ,descripcion	 = ? ,ubicacion = ? , updated_at = ?  ,user_m = ? WHERE id = ?";
            $datos = array($codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen, $fecha, $usuario_activo, $id);
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

    public function h_almacen($id, $codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen,  $usuario_activo, $evento)
    {
        $query = "INSERT INTO h_almacen(almacen_id,codigo_almacen,nombre_almacen,descripcion,ubicacion,user,evento) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id, $codigo_almacen, $nombre_almacen, $descripcion_almacen, $ubicacion_almacen, $usuario_activo, $evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoAlmacen($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM almacen WHERE id = '$id' ";
        $data_almacen = $this->select($tomar_datos);
        $codigo_almacen = $data_almacen['codigo_almacen'];
        $nombre_almacen = $data_almacen['nombre_almacen'];
        $descripcion = $data_almacen['descripcion'];
        $ubicacion = $data_almacen['ubicacion'];
        $fecha = date("Y-m-d H:i:s");
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if ($estado == 0) {
            $evento = "ELIMINADO";
            $query = "UPDATE almacen SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha, $user, $estado, $id);
            $data = $this->save($query, $datos);

        } else {
            $evento = "RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM almacen WHERE nombre_almacen = '$nombre_almacen' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE almacen SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha, $user, $estado, $id);
                $data = $this->save($query, $datos);
            } else {
                $data = 2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_almacen(almacen_id,codigo_almacen,nombre_almacen,descripcion,ubicacion,user,evento,estado) VALUES (?,?,?,?,?,?,?,?)";
        $datos_h = array($id, $codigo_almacen, $nombre_almacen, $descripcion, $ubicacion, $user, $evento, $estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdAlmacen($nombre_almacen)
    {
        $sql = "SELECT id FROM almacen WHERE nombre_almacen = '$nombre_almacen' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>