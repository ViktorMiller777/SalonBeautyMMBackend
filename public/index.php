<?php

namespace proyecto;
require("../vendor/autoload.php");

use PDO;
use proyecto\Models\Models;
use proyecto\Controller\SCitasController;
use proyecto\Controller\CategoriasController;
use proyecto\Controller\ServiciosController;
use proyecto\Response\Failure;
use proyecto\Response\Success;

Router::get('/servicios',[ServiciosController::class,'service']);
Router::get('/categorias',[CategoriasController::class,'cat']);
Router::get('/servicio_cita',[SCitasController::class,'citas']);
Router::get('/usuario/buscar/$id', function ($id) {

    $user= User::find($id);
    if(!$user)
    {
        $r= new Failure(404,"no se encontro el usuario");
        return $r->Send();
    }
   $r= new Success($user);
    return $r->Send();


});
Router::get('/respuesta', [crearPersonaController::class, "response"]);
Router::any('/404', '../views/404.php');
