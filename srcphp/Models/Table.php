<?php

namespace proyecto\Models;

use PDO;
use proyecto\Conexion;
use Dotenv\Dotenv;

class Table
{
    public static $pdo = null;
    public function __construct()
    {

    }
    static  function getDataconexion(){




}
    static function query($query)
    {
        $cc = new  Conexion("estetica", "localhost:3306", "root", "1234");
        self::$pdo = $cc->getPDO();
        $stmt = self::$pdo->query($query);
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $resultados;
    }

}
