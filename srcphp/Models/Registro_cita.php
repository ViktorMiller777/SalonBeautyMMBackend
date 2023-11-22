<?php 
namespace proyecto\Models;

use PDO;
use proyecto\Models\Table;
use proyecto\Response\Success;

class Registro_cita extends Models{
    public $id;
    public $id_cita;
    public $costo;
    public $fecha_hora_inicio;
    public $fecha_hora_final;
    public $duracion_total;
    public $estado;
    public $fecha_cita;
    public $desc_rechazo;

    protected $filleable=[
        "id_cita",
        "costo",
        "fecha_hora_inicio",
        "fecha_hora_final",
        "duracion_total",
        "estado",
        "fecha_cita",
        "desc_rechazo",
    ];

    public $table="registro_citas";
}