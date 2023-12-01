<?php

namespace proyecto\Controller;

use PDO;
use proyecto\Models\Models;
use proyecto\Models\Table;
use proyecto\Models\Servicio_cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class ServiciosCitasController{
    
    public function citas(){
        $res=Table::query("select * from servicio_cita");
        $res=new Success($res);
        $res->Send();
    }
    public function crear_cita(){
        try{
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $sc = new servicio_cita();
            $sc->id_servicio=$dataObject->id_servicio;
            $sc->id_cliente=$dataObject->id_cliente;
            $sc->precio=$dataObject->precio;
            $sc->duracion_min=$dataObject->duracion_min;
            $sc->fecha_hora=$dataObject->fecha_hora;
            $sc->estado=$dataObject->estado;
            $sc->save();
            
            $sc = new Success($sc);
            return $sc->send();
        }catch(\Exception $e){
            $sc = new failure(400, "Error al crear cita verifica tus datos. info error:E-081927");
            return $sc ->Send();
        }
    }
}
