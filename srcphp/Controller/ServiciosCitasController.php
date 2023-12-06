<?php

namespace proyecto\Controller;

use PDO;
use proyecto\Models\Models;
use proyecto\Models\Table;
use proyecto\Models\Servicio_cita;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class ServiciosCitasController{
    
    public function citas(){
        $res=Table::query("select * from servicio_cita");
        $res=new Success($res);
        $res->Send();
    }
    public function crear_cita(){
        try{
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $sc = new servicio_cita();
            $sc->id_servicio=$dataObject->id_servicio;
            $sc->id_cliente=$dataObject->id_cliente;
            $sc->precio=$dataObject->precio;
            $sc->duracion_min=$dataObject->duracion_min;
            $sc->fecha_hora=$dataObject->fecha_hora;
            $sc->estado=$dataObject->estado;
            $sc->save();
            
            $sc = new Success($sc);
            return $sc->send();
        }catch(\Exception $e){
            $sc = new failure(400, "Error al crear cita verifica tus datos. info error:E-081927");
            return $sc ->Send();
        }
    }
    // funcion para borrar citas por la id//
    public function borrar_cita(){
        try{
            $JSONData = file_get_contents('php://input');
            $dataObject = json_decode($JSONData);
            $sc = new servicio_cita();
            $sc->id_servicio=$dataObject->id_servicio;
            $sc->id_cliente=$dataObject->id_cliente;
            $sc->precio=$dataObject->precio;
            $sc->duracion_min=$dataObject->duracion_min;
            $sc->fecha_hora=$dataObject->fecha_hora;
            $sc->estado=$dataObject->estado;
            $sc->delete();

            $sc = new Success($sc);
            return $sc->send();
        }catch(\Exception $e){
            $sc = new failure(400, "Error al crear cita verifica tus datos. info error:E-081927");
            return $sc ->Send();
        }
    }
    // funcion para actualizar el estado de las citas 
    function updateServicioCitas (){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $estado = $dataObject->estado;           

            $service = $this->updateServicioCitasQuerry($estado);
            $response = ['data' => $service];


            header('Content-Type: application/json');
            echo json_encode(['message' => 'Procedimiento ejecutado correctamente', 'data' => $response]);
            
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function updateServicioCitasQuerry($estado) {
        // aca va la consulta que hacer el update 
        $r = table::queryParams("CALL Consulta(:estado)",
            
            [
                'estado'=> $estado,
            ]
        
        );
        return $r;

    }
// funcion para actualizar la fecha_fin de servicio_cita 
    function updateFecha_fin (){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $fecha_fin = $dataObject->fecha_fin;           

            $service = $this->updateFecha_finQuerry($fecha_fin);
            $response = ['data' => $service];


            header('Content-Type: application/json');
            echo json_encode(['message' => 'Procedimiento ejecutado correctamente', 'data' => $response]);
            
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function updateFecha_finQuerry($fecha_fin) {
        // aca va la consulta que hacer el update 
        $r = table::queryParams("CALL consulta(:fecha_fin)",
            
            [
                'fecha_fin'=> $fecha_fin,
            ]
        
        );
        return $r;

    }
// funcion para actualizar fecha_inicio y fecha_fin de servicio_cita 
    function updataFechasCitas (){
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);

            $fecha_fin = $dataObject->fecha_fin;   
            $fecha_inicio = $dataObjecto->fecha_inicio;

            $service = $this->updateFechasQuerry($fecha_inicio, $fecha_fin);
            $response = ['data' => $service];


            header('Content-Type: application/json');
            echo json_encode(['message' => 'Procedimiento ejecutado correctamente', 'data' => $response]);
            
        } catch (\Exception $e) {
            $errorResponse = ['message' => "Error en el servidor: " . $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorResponse);
            http_response_code(500);
        }
    }

    function updateFechasQuerry($fecha_inicio, $fecha_fin) {
        // aca va la consulta que hacer el update 
        $r = table::queryParams("CALL Consulta(:fecha_inicio, :fecha_fin)",
            
            [
                'estado'=> $estado,
            ]
        
        );
        return $r;

    }
    
}

