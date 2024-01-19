<?php
class Views{

    public function getView($controlador, $vista, $data="")
    {
        $validacionHistorial = $controlador;
        //se agrego un is_object para que no lo tome como null
        if(is_object($controlador)){
        $controlador = get_class($controlador);
    }
        //$controlador = $controlador;
        if ($controlador == "Home") {
            $vista = "Views/".$vista.".php";
        }
        // validacion necesaria para acumular todo en historial
        else if($validacionHistorial=="Historial"){
            $vista = "Views/Historial/".$vista.".php";
        }
        
        else{
            $vista = "Views/".$controlador."/".$vista.".php";
        }
        require $vista;
    }
}


?>