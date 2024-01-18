<?php
class AreaModel extends Query
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
    public function getArea()
    {
        // si es 1 
        if($_SESSION['id_usuario']==1){
            $sql = "SELECT * FROM area ";
            $res = $this->selectAll($sql);

        }else{
            $sql = "SELECT * FROM area WHERE estado = 1 ";
            $res = $this->selectAll($sql);
        }

        return $res;
    }
    public function editArea($id)
    {
        $sql = "SELECT * FROM area WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }

    public function insertarArea($nombre_area,$descripcion_area,$usuario_activo)
    {
        $verificar = "SELECT * FROM area WHERE area = '$nombre_area' AND estado=1";
        $existe = $this->select($verificar);
        // si no existe 
        if (empty($existe)) {
            $query = "INSERT INTO area(area,descripcion,user_c,user_m) VALUES (?,?,?,?)";
            $datos = array($nombre_area,$descripcion_area,$usuario_activo,$usuario_activo);
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

    public function actualizarArea($nombre_area,$descripcion_area,$usuario_activo, $id)
    {
        $fecha =date("Y-m-d H:i:s");  
        $verificar = "SELECT * FROM area WHERE area = '$nombre_area' AND estado=1";
        $existe = $this->select($verificar);
        if (empty($existe)) {
        $query = "UPDATE area SET  area = ? ,descripcion = ?, updated_at = ?  ,user_m = ? WHERE id = ?";
        $datos = array($nombre_area,$descripcion_area,$fecha,$usuario_activo, $id);
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

    public function h_area($id,$nombre_area,$descripcion_area,$usuario_activo,$evento)
    {
        $query = "INSERT INTO h_area(area_id,area,descripcion,user,evento )VALUES (?,?,?,?,?)";
        $datos = array($id,$nombre_area,$descripcion_area,$usuario_activo,$evento);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function estadoArea($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM area WHERE id = '$id' ";
        $data_area = $this->select($tomar_datos);
        $nombre_area =$data_area['area'];
        $descripcion =$data_area['descripcion'];
        $fecha =date("Y-m-d H:i:s");  
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if($estado==0){
            $evento ="ELIMINADO";
            $query = "UPDATE area SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha,$user,$estado,$id);
            $data = $this->save($query, $datos);

        }else{
            $evento ="RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM area WHERE area = '$nombre_area' AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE area SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha,$user,$estado,$id);
                $data = $this->save($query, $datos);
            }else{
                $data =2;
            }


        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 

        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_area(area_id,area,descripcion,user,evento,estado) VALUES (?,?,?,?,?,?)";
        $datos_h = array($id,$nombre_area,$descripcion,$user,$evento,$estado);
        $data_h = $this->save($query_h, $datos_h);

        return $data;
    }

    public function IdArea($nombre_area)
    {
        $sql = "SELECT id FROM area WHERE area = '$nombre_area' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }

}

?>