<?php
namespace proyecto\Models;

use PDO;
use Carbon\Carbon;
use proyecto\Auth;
use proyecto\Response\Failure;
use proyecto\Response\Response;
use proyecto\Response\Success;
use function json_encode;

class Usuario extends Models{
    public $id;
    public $user;
    public $apellido_paterno;
    public $apellido_materno;
    public $correo;
    public $contrasena;
    public $telefono;
    public $id_rol;

    protected $filleable=[
        "user",
        "apellido_paterno",
        "apellido_materno",
        "correo",
        "contrasena",
        "telefono",
        "id_rol",
    ];
    public $table="usuarios";
    
    public static function auth($user, $contrasena):Response
    {
        $class = get_called_class();
        $c = new $class();
        $stmt = self::$pdo->prepare("select *  from $c->table  where  user =:user");
        $stmt->bindParam(":user", $user);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_CLASS,Usuario::class);

        if ($resultados) {
            $hashpass=$resultados[0]->contrasena;
            if(password_verify($contrasena, $hashpass)){
                $r=new Success(["usuario"=>$resultados[0],"_token"=>Auth::generateToken([$resultados[0]->id])]);
                return  $r->Send();
            }
        }
        $r=new Failure(401,"Usuario o contraseña incorrectos");
        return $r->Send();
    }
}