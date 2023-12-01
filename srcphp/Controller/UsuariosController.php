<?php
namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Usuario;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class UsuariosController{
    public function mostrarUsuarios(){
        $res=Table::query('select * from usuarios;');
        $res=new Success($res);
        $res->Send();
    }
    public function RegistrarUsuario(){
        try {
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $user = new usuarios();
            $user->nombre=$dataObject->nombre;
            $user->apellido_paterno=$dataObject->apellido_paterno;
            $user->apellido_materno=$dataObject->apellido_materno;
            $user->correo=$dataObject->correo;
            $user->contrasena=$dataObject->contrasena;
            $user->telefono=$dataObject->telefono;
            $user->Save();

        } catch (error) {
            console.error('error en nose donde');
        }
    }
}