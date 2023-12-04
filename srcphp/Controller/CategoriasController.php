<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Categoria;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class CategoriasController{
<<<<<<< HEAD
    public function cat(){
        $res=Table::query('Select * from categorias');
=======
    public function categories(){
        $res=Table::query("Select * from categorias");
>>>>>>> main
        $res=new Success($res);
        $res->Send();
    }
}