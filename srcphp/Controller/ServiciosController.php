<?php
namespace proyecto\Controller;

use PDO;
use proyecto\Models\Models;
use proyecto\Models\Table;
use proyecto\Models\Servicio;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class ServiciosController{
    public function servicios(){
        $res=Table::query("select * from servicios");
        $res=new Success($res);
        $res->Send();
    }
    public function mostrar(){
        $res=Table::query("select id,nombre,
        duracion_min as duracion,precio,categoria
        from servicios where activo=1");
        $res=new Success($res);
        $res->Send();
    }
    public function hola(){
        echo 'hola';
    }
}