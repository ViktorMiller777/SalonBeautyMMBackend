<?php

namespace proyecto;
require("../vendor/autoload.php");

use PDO;
use proyecto\Models\Models;
use proyecto\Controller\UsuariosController;
use proyecto\Controller\ServiciosController;
use proyecto\Controller\CategoriasController;
use proyecto\Controller\RegistroCitasController;
use proyecto\Controller\ServiciosCitasController;
use proyecto\Response\Failure;
use proyecto\Response\Success;
// Metodo header para poder resivir solicitudes de cualquier dominio //
Router::headers();
//Metodos post//
Router::post('/servicio_cita/actualizar',[ServiciosCitasController::class,"actualizarServicioCita"]);
Router::post('/registro_citas/actualizar',[RegistroCitasController::class,"actualizarRegistroCita"]);
Router::post('/registrar_usuario',[UsuariosController::class,"Register"]);
Router::post('/eliminar_servicio',[ServiciosCitasController::class,"borrar_cita"]);
Router::post('/auth',[UsuariosController::class,"auth"]);
// Metodos get //
Router::get('/usuarios',[UsuariosController::class,"mostrarUsuarios"]);
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
