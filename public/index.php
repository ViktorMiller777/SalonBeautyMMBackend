<?php

namespace proyecto;
require("../vendor/autoload.php");

use PDO;
use proyecto\Models\Models;
use proyecto\Controller\ServiciosController;
use proyecto\Controller\CategoriasController;
use proyecto\Controller\RegistroCitasController;
use proyecto\Response\Failure;
use proyecto\Response\Success;

//Metodos post//

// Metodos get //
Router::get('/servicios',[ServiciosController::class,'servicios']);
Router::get('/registro_citas',[RegistroCitasController::class,'registros']);
Router::get('/categorias',[CategoriasController::class,'categories']);


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
