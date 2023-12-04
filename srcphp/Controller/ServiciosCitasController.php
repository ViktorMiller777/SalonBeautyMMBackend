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
    public function mostrar(){
        $res=Table::query("select servCita.id as id,servCita.id_cita as idCita,servCita.id_servicio as idServicio,servCita.precio as precio,
        servCita.duracion_min as duracion,servCita.fecha_hora as fechaServicio,servCita.tipo as tipo,servicio.categoria 
        as catalogo from servicio_cita as servCita
        inner join registro_citas as cita on cita.id=servCita.id_cita inner join
        servicios as servicio on servicio.id = servCita.id_servicio where cita.estado = 'confirmado';");
        $res=new Success($res);
        $res->Send();
    }
    public function mostrar_bloqueos(){
        $res=Table::query("select servCita.id as id,servCita.id_cita as idCita,servCita.id_servicio as idServicio,
        servCita.duracion_min as duracion,servCita.fecha_hora as fechaServicio,servCita.tipo as tipo from servicio_cita as servCita 
        where servCita.tipo=1;");
        $res=new Success($res);
        $res->Send();
    }
    public function crear_cita(){
        try{
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $sc = new servicio_cita();
            $sc->id_servicio=$dataObject->id_servicio;
            $sc->precio=$dataObject->precio;
            $sc->duracion_min=$dataObject->duracion_min;
            $sc->fecha_hora=$dataObject->fecha_hora;
            $sc->tipo=$dataObject->tipo;
            $sc->save();
            
            $r = new Success($sc);
            return $r->send();
        }catch(\Exception $e){
            $sc = new failure(400, "Error al crear cita verifica tus datos. info error:E-081927");
            return $sc ->Send();
        }
    }
}
