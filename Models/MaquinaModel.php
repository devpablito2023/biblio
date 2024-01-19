<?php
class MaquinaModel extends Query
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
    public function getMaquina()
    {
        // si es 1 
        if ($_SESSION['id_usuario'] == 1) {
            $sql = "SELECT * FROM maquina ";
            $res = $this->selectAll($sql);

        } else {
            $sql = "SELECT * FROM maquina WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editMaquina($id)
    {
        $sql = "SELECT * FROM maquina WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarMaquina($codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $usuario_activo)
    {
        $verificar = "SELECT * FROM maquina WHERE codigo = '$codigo' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO maquina(codigo,producto,marca,modelo,regrigerante,serie,controlador,user_c,user_m) VALUES (?,?,?,?,?,?,?,?,?)";
            $datos = array($codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $usuario_activo, $usuario_activo);
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

    public function actualizarMaquina($codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $usuario_activo, $id)
    {
        $fecha = date("Y-m-d H:i:s");
        $verificar = "SELECT * FROM maquina WHERE codigo = '$codigo' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "UPDATE maquina SET codigo = ? , producto = ? ,marca = ?,modelo = ?,regrigerante = ?,serie = ?,controlador = ?, updated_at = ?  ,user_m = ? WHERE id = ?";
            $datos = array($codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $fecha, $usuario_activo, $id);
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

    public function h_maquina($id, $codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $usuario_activo, $evento)
    {
        $query = "INSERT INTO h_maquina(maquina_id,codigo,producto,marca,modelo,regrigerante,serie,controlador,user,evento) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos = array($id, $codigo, $producto, $marca, $modelo, $Refrigerante, $serie, $controlador, $usuario_activo, $evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoMaquina($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM maquina WHERE id = '$id' ";
        $data_maquina = $this->select($tomar_datos);
        $codigo = $data_maquina['codigo'];
        $producto = $data_maquina['producto'];
        $marca = $data_maquina['marca'];
        $modelo = $data_maquina['modelo'];
        $regrigerante = $data_maquina['regrigerante'];
        $serie = $data_maquina['serie'];
        $controlador = $data_maquina['controlador'];
        $fecha = date("Y-m-d H:i:s");
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if ($estado == 0) {
            $evento = "ELIMINADO";
            $query = "UPDATE maquina SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha, $user, $estado, $id);
            $data = $this->save($query, $datos);

        } else {
            $evento = "RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM maquina WHERE codigo = '$codigo' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE maquina SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha, $user, $estado, $id);
                $data = $this->save($query, $datos);
            } else {
                $data = 2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_maquina(maquina_id,codigo,producto,marca,modelo,regrigerante,serie,controlador,user,evento,estado) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $datos_h = array($id, $codigo, $producto, $marca, $modelo, $regrigerante, $serie, $controlador, $user, $evento, $estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdMaquina($codigo)
    {
        $sql = "SELECT id FROM maquina WHERE codigo = '$codigo' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>