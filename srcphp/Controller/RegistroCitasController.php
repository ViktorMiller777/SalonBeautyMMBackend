<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use poryecto\Models\Servicio;
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
    public function onlyservicios(){
        $res=Table::query('select servicio.id, servicios.id, servicios.nombre, servicios.duracion_min, servicios.precio, categorias.nombre as categoria 
        from servicios inner join categorias on servicios.categoria=categorias.id;');
        $res=new Success($res);
        $res->Send();
    }
}