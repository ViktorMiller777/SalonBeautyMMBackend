<?php
namespace proyecto\Controller;

use PDO;
use proyecto\Models\Table;
use poryecto\Models\Servicio;
use proyecto\Response\Failure;
use proyecto\Response\Success;
use proyecto\Conexion;

class RegistroCitasController{
    private $conexion;
    public function __construct() {
        $this->conexion = new Conexion('estetica', 'localhost', 'root', '');
    }

    public function registros(){
        $res=Table::query('select registro_citas.id, usuarios.nombre as cliente, servicios.nombre as servicio,
        registro_citas.costo, registro_citas.duracion_total, registro_citas.fecha_hora_inicio, registro_citas.fecha_cita
        from registro_citas inner join usuarios on registro_citas.cliente=usuarios.id
        inner join servicio_cita on registro_citas.id=servicio_cita.id_cita
        inner join servicios on servicio_cita.id_servicio=servicios.id;');
        $res=new Success($res);
        $res->Send();
    }
    public function onlyservicios(){
        $res=Table::query('select servicio.id, servicios.id, servicios.nombre, servicios.duracion_min, servicios.precio, categorias.nombre as categoria 
        from servicios inner join categorias on servicios.categoria=categorias.id;');
        $res=new Success($res);
        $res->Send();
    }
    function actualizarRegistroCita()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
    
            // Checking if id is provided
            if (!property_exists($dataObject, 'id')) {
                throw new \Exception("Debe proporcionar el ID del servicio_cita para actualizar");
            }
    
            $id = $dataObject->id;
    
            $sql = "UPDATE registro_citas SET ";
            $values = [];
            
            if (property_exists($dataObject, 'cliente')) {
                $sql .= "cliente = :cliente, ";
                $values[':cliente'] = $dataObject->cliente;
            }
            if (property_exists($dataObject, 'costo')) {
                $sql .= "costo = :costo, ";
                $values[':costo'] = $dataObject->costo;
            }
            if (property_exists($dataObject, 'fecha_hora_inicio')) {
                $sql .= "fecha_hora_inicio = :fecha_hora_inicio, ";
                $values[':fecha_hora_inicio'] = $dataObject->fecha_hora_inicio;
            }
            if (property_exists($dataObject, 'fecha_hora_fin')) {
                $sql .= "fecha_hora_fin = :fecha_hora_fin, ";
                $values[':fecha_hora_fin'] = $dataObject->fecha_hora_fin;
            }
            if (property_exists($dataObject, 'duracion_total')) {
                $sql .= "duracion_total= :duracion_total, ";
                $values[':duracion_total'] = $dataObject->duracion_total;
            }
            if (property_exists($dataObject, 'estado')) {
                $sql .= "estado = :estado, ";
                $values[':estado'] = $dataObject->estado;
            }
            if (property_exists($dataObject, 'fecha_cita')) {
                $sql .= "fecha_cita = :fecha_cita, ";
                $values[':fecha_cita'] = $dataObject->fecha_cita;
            }
            if (property_exists($dataObject, 'desc_rechazo')) {
                $sql .= "desc_rechazo = :desc_rechazo, ";
                $values[':desc_rechazo'] = $dataObject->desc_rechazo;
            }
    
            // Remove trailing comma and add WHERE clause
            $sql = rtrim($sql, ', ') . " WHERE id = :id";
            $values[':id'] = $id;
    
            $stmt = $this->conexion->getPDO()->prepare($sql);
            $stmt->execute($values);
    
            $rowsAffected = $stmt->rowCount();
    
            if ($rowsAffected === 0) {
                throw new \Exception("No se encontró el cliente con el ID proporcionado");
            }
    
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Dato actualizado exitosamente.']);
            http_response_code(200);
    
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }
    // ACA HAY OTRO

    // ACA TERMINA  PUTO
    
}