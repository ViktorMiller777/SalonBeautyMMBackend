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

    public static function auth($correo, $contrasena):Response
    {
        $class = get_called_class();
        $c = new $class();
        $stmt = self::$pdo->prepare("select *  from $c->table  where  correo =:correo  and contra=:contrasna");
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":contrasena", $contra);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_CLASS,Usuarios::class);

        if ($resultados) {
//            Auth::setUser($resultados[0]);  pendiente
            $r=new Success(["usuario"=>$resultados[0],"_token"=>Auth::generateToken([$resultados[0]->id])]);
            return  $r->Send();
        }
        $r=new Failure(401,"Correo o contraseña incorrectos");
        return $r->Send();

    }
}