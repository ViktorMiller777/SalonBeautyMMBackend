<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use poryecto\Models\Servicio;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class ServiciosController{
    public function service(){
        $res=Table::query('select * from servicios');
        $res=new Success($res);
        $res->Send();
    }
}