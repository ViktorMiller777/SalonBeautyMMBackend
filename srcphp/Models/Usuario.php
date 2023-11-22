<?php
namespace proyecto\Models;

use PDO;
use proyecto\Models\Table;
use proyecto\Response\Success;

class Usuario extends Models{
    public $id;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $correo;
    public $contrasena;
    public $telefono;
    public $id_rol;

    protected $filleable=[
        "nombre",
        "apellido_paterno",
        "apellido_materno",
        "correo",
        "contrasena",
        "telefono",
        "id_rol",
    ];

    public $table="usuarios";
}