<?php

namespace proyecto\Models;

use PDO;
use proyecto\Models\Table;
use proyecto\Response\Success;

class Servicio_cita extends Models{
    public $id;
    public $id_servicio;
    public $id_cliente;
    public $precio;
    public $duracion_min;
    public $fecha_hora;
    public $estado;

    protected $filleable=[
        "id_servicio",
        "id_cita",
        "precio",
        "duracion_min",
        "fecha_hora",
        "estado",
    ];

    public $table ="servicio_cita";
}
