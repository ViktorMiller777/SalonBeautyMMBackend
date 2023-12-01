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
}