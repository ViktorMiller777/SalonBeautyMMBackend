<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use poryecto\Models\Servicio;
use proyecto\Models\Registro_cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class RegistroCitasController{
    public function registros(){
        $res=Table::query('select registro_citas.id, usuarios.nombre as cliente, servicios.nombre as servicio,
        registro_citas.costo, registro_citas.duracion_total, registro_citas.fecha_hora_inicio, registro_citas.fecha_cita
        from registro_citas inner join usuarios on registro_citas.cliente=usuarios.id
        inner join servicio_cita on registro_citas.id=servicio_cita.id_cita
        inner join servicios on servicio_cita.id_servicio=servicios.id;');
        $res=new Success($res);
        $res->Send();
    }
    public function citas(){
        $res=Table::query('
        select id,fecha_hora_inicio as fechaInicio,duracion_total as duracionTotal,cliente as clienteId from registro_citas where estado = "confirmado";');
        $res=new Success($res);
        $res->Send();
    }
  
    public function onlyservicios(){
        $res=Table::query('select servicio.id, servicios.id, servicios.nombre, servicios.duracion_min, servicios.precio, categorias.nombre as categoria 
        from servicios inner join categorias on servicios.categoria=categorias.id;');
        $res=new Success($res);
        $res->Send();
    }

    public function crear_registro_cita(){
        try{
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $sc = new Registro_cita();
            $sc->cliente=$dataObject->cliente;
            $sc->costo=$dataObject->costo;
            $sc->fecha_hora_inicio=$dataObject->fecha_hora_inicio;
            $sc->fecha_hora_fin=$dataObject->fecha_hora_fin;
            $sc->duracion_total=$dataObject->duracion_total;
            $sc->estado=$dataObject->estado;
            $sc->fecha_cita=$dataObject->fecha_cita;
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