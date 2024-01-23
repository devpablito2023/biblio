<?php
class CotizacionModel extends Query
{
    public function __construct() 
    {
        parent::__construct();
    }
    public function getCotizacion()
    {
       if($_SESSION['id_usuario']==1){
        $sql = "SELECT i.*, c.cliente FROM cotizacion i INNER JOIN cliente c ON i.cliente_id = c.id";
        $res = $this->selectAll($sql);
        }else{
            $sql = "SELECT i.*, c.cliente FROM cotizacion i INNER JOIN cliente c ON i.cliente_id = c.id WHERE i.estado=1";
            $res = $this->selectAll($sql);
        }
        return $res;
    }
    public function insertarCotizacion($codigoCotizacion, $cliente, $monto, $asunto, $usuario_activo)
    { 
        $verificar = "SELECT * FROM cotizacion WHERE numero_cotizacion = '$codigoCotizacion' ";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $query = "INSERT INTO cotizacion(numero_cotizacion, cliente_id, monto, asunto,user_c) VALUES (?,?,?,?,?)";
            $datos = array($codigoCotizacion, $cliente, $monto, $asunto,$usuario_activo);
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
    public function editCotizacion($id)
    {
        //$sql = "SELECT l.* , a.autor AS textAutor , e.editorial  AS textEditorial , m.materia AS textMateria FROM libro l INNER JOIN autor a  ON l.id_autor = a.id  INNER JOIN editorial e ON l.id_editorial = e.id INNER JOIN materia m ON l.id_materia = m.id WHERE l.id = $id";
        $sql = "SELECT i.*, c.cliente AS textCliente FROM cotizacion i INNER JOIN cliente c ON i.cliente_id = c.id  WHERE i.id = $id";
        $res = $this->select($sql);
        return $res;
    }
    public function analizarCotizacion($codigoCotizacion,$cliente)
    {
        $sql = "SELECT id from cotizacion WHERE (numero_cotizacion='$codigoCotizacion' OR cliente_id='$cliente' ) AND estado=1" ; 
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

    public function actualizarCotizacion($codigoCotizacion, $cliente, $monto, $asunto,$usuario_activo,$id)
    {
        $fecha =date("Y-m-d H:i:s");  
        $query = "UPDATE cotizacion SET numero_cotizacion = ?, cliente_id=?, monto=?,asunto=?, user_m=? ,updated_at=? WHERE id = ?";
        $datos = array($codigoCotizacion, $cliente, $monto, $asunto,$usuario_activo,$fecha,$id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoCotizacion($estado, $id)
    {
        // primero seleccionamos los datos 
        $tomar_datos = "SELECT * FROM cotizacion WHERE id = '$id' ";
        $data_cotizacion = $this->select($tomar_datos);
        $numero_cotizacion =$data_cotizacion['numero_cotizacion'];
        $cliente =$data_cotizacion['cliente_id'];
        $monto =$data_cotizacion['monto'];
        $asunto =$data_cotizacion['asunto'];
        $fecha =date("Y-m-d H:i:s");  
        $user = $_SESSION['id_usuario'];
        // validamos el evento con el estado
        if($estado==0){
            $evento ="ELIMINADO";
            $query = "UPDATE cotizacion SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
            $datos = array($fecha,$user,$estado,$id);
            $data = $this->save($query, $datos);
        }else{
            $evento ="RESTAURADO";
            // debe haber paso previo de validacion para no restaurar duplicados 
            $validarDuplicado = "SELECT * FROM cotizacion WHERE (numero_cotizacion = '$numero_cotizacion' OR cliente_id='$cliente' ) AND estado=1";
            $existe = $this->select($validarDuplicado);
            if (empty($existe)) {
                $query = "UPDATE cotizacion SET  updated_at = ?  ,user_m = ? ,estado = ? WHERE id = ?";
                $datos = array($fecha,$user,$estado,$id);
                $data = $this->save($query, $datos);
            }else{
                $data =2;
            }  
        }
        // aqui actualizamos los datos en estado 0 para elimminar logicamente la receta en vista 
        // aqui guardamos el evento en el historico
        $query_h = "INSERT INTO h_cotizacion(cotizacion_id,numero_cotizacion, cliente_id, monto, asunto,user,evento,estado) VALUES (?,?,?,?,?,?,?,?)";
        $datos_h = array($id,$numero_cotizacion, $cliente, $monto, $asunto,$user,$evento,$estado );
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
    public function buscarCliente($valor)
    {
        $sql = "SELECT id, cliente AS text FROM cliente WHERE cliente LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
    
    public function IdCotizacion($codigoCotizacion)
    {
        $sql = "SELECT id FROM cotizacion WHERE numero_cotizacion = '$codigoCotizacion' AND estado=1";
        $res = $this->select($sql);
        return $res;
    }
    public function h_cotizacion($id,$codigoCotizacion, $cliente, $monto, $asunto,$usuario_activo,$evento )
    {
        $query = "INSERT INTO h_cotizacion(cotizacion_id,numero_cotizacion, cliente_id, monto, asunto,user,evento) VALUES (?,?,?,?,?,?,?)";
        $datos = array($id,$codigoCotizacion, $cliente, $monto, $asunto,$usuario_activo,$evento );
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
}
