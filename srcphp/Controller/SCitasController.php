<?php

namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Servicio_cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class SCitasController{
    
    public function citas(){
        $res=Table::query("select servicio_cita.id as id, servicios.nombre as Servicio, concat(usuarios.nombre,' ',usuarios.apellido_paterno,' ',apellido_materno ) as Cliente,
        servicio_cita.precio,  servicio_cita.duracion_min, fecha_hora, registro_citas.estado from servicio_cita
        inner join servicios on servicio_cita.id_servicio=servicios.id
        inner join registro_citas on registro_citas.id = servicio_cita.id_cita
        inner join usuarios on registro_citas.cliente=usuarios.id;");
        $res=new Success($res);
        $res->Send();
    }
 
}
