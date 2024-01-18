<?php
class PermisoModel extends Query
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
    public function getPermiso()
    {
        // si es 1 
        if($_SESSION['id_usuario']==1){
            $sql = "SELECT * FROM permiso ";
            $res = $this->selectAll($sql);

        }else{
            $sql = "SELECT * FROM permiso WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editPermiso($id)
    {
        $sql = "SELECT * FROM permiso WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarPermiso($nombre_permiso,$descripcion_permiso,$usuario_activo)
    {
        $verificar = "SELECT * FROM permiso WHERE nombre_permiso = '$nombre_permiso' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO permiso(nombre_permiso,descripcion,user_c,user_m) VALUES (?,?,?,?)";
            $datos = array($nombre_permiso,$descripcion_permiso,$usuario_activo,$usuario_activo);
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

    public function actualizarPermiso($nombre_permiso,$descripcion_permiso,$usuario_activo, $id)
    {
        $fecha =date("Y-m-d H:i:s");  
        $verificar = "SELECT * FROM permiso WHERE nombre_permiso = '$nombre_permiso' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
        $query = "UPDATE permiso SET nombre_permiso = ? , descripcion = ? , updated_at = ?  ,user_m = ? WHERE id = ?";
        $datos = array($nombre_permiso,$descripcion_permiso,$fecha,$usuario_activo, $id);
        $data = $this->save($query, $datos);
        }else{
            $data=2;
        }
        if ($data == 1) {
            $res = "modificado";
        } else if($data == 2){
            $res =2 ;
        }
        
        else {
            $res = "error";
        }
        return $res;
    }
    // guardar en el historial 

    public function h_permiso($id,$nombre_permiso,$descripcion_permiso,$usuario_activo,$evento)
    {
        $query = "INSERT INTO h_permiso(permiso_id,nombre_permiso,descripcion,user,evento) VALUES (?,?,?,?,?)";
        $datos = array($id,$nombre_permiso,$descripcion_permiso,$usuario_activo,$evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoPermiso($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM permiso WHERE id = '$id' ";
        $data_permiso = $this->select($tomar_datos);
        $nombre_permiso =$data_permiso['nombre_permiso'];
        $descripcion =$data_permiso['descripcion'];
        $fecha =date("Y-m-d H:i:s");  
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if($estado==0){
            $evento ="ELIMINADO";
            $query = "UPDATE permiso SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha,$user,$estado,$id);
            $data = $this->save($query, $datos);

        }else{
            $evento ="RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM permiso WHERE nombre_permiso = '$nombre_permiso' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE permiso SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha,$user,$estado,$id);
                $data = $this->save($query, $datos);
            }else{
                $data =2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_permiso(permiso_id,nombre_permiso,descripcion,user,evento,estado) VALUES (?,?,?,?,?,?)";
        $datos_h = array($id,$nombre_permiso,$descripcion,$user,$evento,$estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdPermiso($nombre_permiso)
    {
        $sql = "SELECT id FROM permiso WHERE nombre_permiso = '$nombre_permiso' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>