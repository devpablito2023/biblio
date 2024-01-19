<?php
class ClienteModel extends Query
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
    public function getCliente()
    {
        // si es 1 
        if ($_SESSION['id_usuario'] == 1) {
            $sql = "SELECT * FROM cliente ";
            $res = $this->selectAll($sql);

        } else {
            $sql = "SELECT * FROM cliente WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editCliente($id)
    {
        $sql = "SELECT * FROM cliente WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarCliente($codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $usuario_activo)
    {
        $verificar = "SELECT * FROM cliente WHERE cliente = '$nombre_cliente' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO cliente(codigo_cliente,cliente,contacto,telefono,email,tiempo_contrato,user_c,user_m) VALUES (?,?,?,?,?,?,?,?)";
            $datos = array($codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $usuario_activo, $usuario_activo);
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

    public function actualizarCliente($codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $usuario_activo, $id)
    {
        $fecha = date("Y-m-d H:i:s");
        $verificar = "SELECT * FROM cliente WHERE cliente = '$nombre_cliente' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "UPDATE cliente SET codigo_cliente = ? , cliente = ? ,contacto = ? ,telefono = ? ,email = ? ,tiempo_contrato = ?, updated_at = ?  ,user_m = ? WHERE id = ?";
            $datos = array($codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $fecha, $usuario_activo, $id);
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

    public function h_cliente($id, $codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $usuario_activo, $evento)
    {
        $query = "INSERT INTO h_cliente(cliente_id,codigo_cliente,cliente,contacto,telefono,email,tiempo_contrato,user,evento) VALUES (?,?,?,?,?,?,?,?,?)";
        $datos = array($id, $codigo_cliente, $nombre_cliente, $contacto_cliente, $telefono_cliente, $email_cliente, $tiempo_contrato, $usuario_activo, $evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoCliente($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM cliente WHERE id = '$id' ";
        $data_cliente = $this->select($tomar_datos);
        $codigo_cliente = $data_cliente['codigo_cliente'];
        $cliente = $data_cliente['cliente'];
        $contacto = $data_cliente['contacto'];
        $telefono = $data_cliente['telefono'];
        $email = $data_cliente['email'];
        $tiempo_contrato = $data_cliente['tiempo_contrato'];
        $fecha = date("Y-m-d H:i:s");
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if ($estado == 0) {
            $evento = "ELIMINADO";
            $query = "UPDATE cliente SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha, $user, $estado, $id);
            $data = $this->save($query, $datos);

        } else {
            $evento = "RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM cliente WHERE cliente = '$cliente' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE cliente SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha, $user, $estado, $id);
                $data = $this->save($query, $datos);
            } else {
                $data = 2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_cliente(cliente_id,codigo_cliente,cliente,contacto,telefono,email,tiempo_contrato,user,evento,estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $datos_h = array($id, $codigo_cliente, $cliente, $contacto, $telefono, $email, $tiempo_contrato, $user, $evento, $estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdCliente($nombre_cliente)
    {
        $sql = "SELECT id FROM cliente WHERE cliente = '$nombre_cliente' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>