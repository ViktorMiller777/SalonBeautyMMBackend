<?php
namespace proyecto\Models;

use PDO;
use proyecto\Models\Table;
use proyecto\Response\Success;

class Servicio extends Models{
    public $id;
    public $nombre;
    public $slug;
    public $precio;
    public $descripcion;
    public $img;
    public $duracion_img;
    public $categoria;
    public $activo;

    protected $filleable = [
        "nombre",
        "slug",
        "precio",
        "descripcion",
        "img",
        "duracion_img",
        "categoria",
        "activo",
    ];

    public $table="servicios";
}
