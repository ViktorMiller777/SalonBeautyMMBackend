<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Categoria;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class CategoriasController{
    public function cat(){
        $res=Table::query('Select * from categorias');
        $res=new Success($res);
        $res->Send();
    }

    public function patron(){
        echo "hola bienvenido";
    }
}