<?php
class EmpleadosModel extends Query
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function getEmpleados()
    {
       if($_SESSION['id_usuario']==1){
        $sql = "SELECT i.*,a.area FROM empleado i INNER JOIN area a ON i.area_id = a.id";
        $res = $this->selectAll($sql);
        }else{
            $sql = "SELECT i.*,a.area FROM empleado i INNER JOIN area a ON i.area_id = a.id WHERE i.estado=1";
            $res = $this->selectAll($sql);
        }
        return $res;
    }
    public function insertarEmpleados($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion, $usuario_activo)
    { 
        $verificar = "SELECT * FROM empleado WHERE nombres = '$nombre' ";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO empleado(area_id, nombres, apellidos, dni,email,fecha_nacimiento,licencia_conducir,profesion,user_c) VALUES (?,?,?,?,?,?,?,?,?)";
            $datos = array($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion, $usuario_activo);
            $data = $this->save($query, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function editEmpleados($id)
    {
        //$sql = "SELECT l.* , a.autor AS textAutor , e.editorial  AS textEditorial , m.materia AS textMateria FROM libro l INNER JOIN autor a  ON l.id_autor = a.id  INNER JOIN editorial e ON l.id_editorial = e.id INNER JOIN materia m ON l.id_materia = m.id WHERE l.id = $id";
        $sql = "SELECT i.*, a.area AS textArea FROM empleado i INNER JOIN area a ON i.area_id = a.id  WHERE i.id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function analizarEmpleados($nombre,$apellido)
    {
        $sql = "SELECT id from empleado WHERE (nombres='$nombre' OR apellidos='$apellido' ) AND estado=1" ; 
        $res = $this->select($sql);
        return $res;
        //return 1;
    }
    /*
    public function analizarInsumoC($codigoInsumo)
    {
        $sql = "SELECT id from insumo WHERE codigo_insumo='$codigoInsumo' AND estado=1" ; 
        $res = $this->select($sql);
        return $res;
        //return 1;
    }
    public function analizarInsumoN($nombreInsumo)
    {
        $sql = "SELECT id from insumo WHERE  nombre_insumo='$nombreInsumo' AND estado=1" ; 
        $res = $this->select($sql);
        return $res;
        //return 1;
    }
 */

    public function actualizarEmpleados($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$usuario_activo,$id)
    {
        $fecha =date("Y-m-d H:i:s");  
        $query = "UPDATE empleado SET area_id = ?, nombres=?, apellidos=?,dni=?,email=?,fecha_nacimiento=?,licencia_conducir=?,profesion=?, user_m=? ,updated_at=? WHERE id = ?";
        $datos = array($area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$usuario_activo,$fecha,$id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoEmpleados($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM empleado WHERE id = '$id' ";
        $data_empleado = $this->select($tomar_datos);
        $area_id =$data_empleado['area_id'];
        $nombres =$data_empleado['nombres'];
        $apellidos =$data_empleado['apellidos'];
        $dni =$data_empleado['dni'];
        $email =$data_empleado['email'];
        $fecha_nacimiento =$data_empleado['fecha_nacimiento'];
        $licencia_conducir =$data_empleado['licencia_conducir'];
        $profesion =$data_empleado['profesion'];
        $fecha =date("Y-m-d H:i:s");  
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if($estado==0){
            $evento ="ELIMINADO";
            $query = "UPDATE empleado SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha,$user,$estado,$id);
            $data = $this->save($query, $datos);
        }else{
            $evento ="RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM empleado WHERE (nombres = '$nombres' OR apellidos='$apellidos' ) AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE empleado SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha,$user,$estado,$id);
                $data = $this->save($query, $datos);
            }else{
                $data =2;
            }  
        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 
        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_empleado(empleado_id,area_id, nombres, apellidos, dni,email,fecha_nacimiento,licencia_conducir,profesion,user,evento,estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $datos_h = array($id,$area_id, $nombres, $apellidos, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$user,$evento,$estado );
        $data_h = $this->save($query_h, $datos_h);       
        return $data;
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
    public function buscarArea($valor)
    {
        $sql = "SELECT id, area AS text FROM area WHERE area LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
    
    public function IdEmpleados($nombre)
    {
        $sql = "SELECT id FROM empleado WHERE nombres = '$nombre' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }
    public function h_empleado($id,$area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$usuario_activo,$evento )
    {
        $query = "INSERT INTO h_empleado(empleado_id,area_id, nombres, apellidos, dni,email,fecha_nacimiento,licencia_conducir,profesion,user,evento) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $datos = array($id,$area, $nombre, $apellido, $dni,$email,$fecha_nacimiento,$licencia_conducir,$profesion,$usuario_activo,$evento );
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
}
