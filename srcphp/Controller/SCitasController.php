<?php

namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Servicio_cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class SCitasController{
    
    public function citas(){
        $res=Table::query("select servicios.nombre as Servicio, usuarios.nombre as Cliente,
        servicio_cita.precio,  servicio_cita.duracion_min, fecha_hora, servicio_cita.estado from servicio_cita
        inner join servicios on servicio_cita.id_servicio=servicios.id
        inner join usuarios on servicio_cita.id_cliente=usuarios.id;
        ");
        $res=new Success($res);
        $res->Send();
    }
}
