<?php
// Incluir el modelo para manejar las postulaciones.
include_once('../models/Postulacion.php');

class PostulacionController {

    // Método para crear una nueva postulación.
    public function create($data) {
        $postulacion = new Postulacion();
        $result = $postulacion->create($data);

        if ($result) {
            // Respuesta exitosa con código 201 (Creado)
            http_response_code(201);
            echo json_encode([
                'status' => 'success',
                'mensaje' => 'Postulación creada exitosamente'
            ]);
        } else {
            // Respuesta de error con código 500 (Error interno)
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'mensaje' => 'Error al crear la postulación'
            ]);
        }
    }

    // Método para obtener todas las postulaciones.
    public function getAll() {
        $postulacion = new Postulacion();
        $result = $postulacion->getAll();

        // Depuración: Verifica los datos devueltos antes de enviarlos.
        $resultJson = json_encode($result);
        
        // Verifica si el resultado es un JSON válido
        if (json_last_error() === JSON_ERROR_NONE) {
            // Enviar respuesta exitosa en formato JSON
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'data' => $result  // Asegúrate de enviar solo los datos aquí
            ]);
        } else {
            // Si no es válido, enviar un mensaje de error
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'mensaje' => 'Error al convertir la respuesta a JSON',
                'detalle' => json_last_error_msg()  // Detalle del error JSON
            ]);
        }
    }

    // Método para obtener una postulación específica por ID.
    public function getById($id) {
        $postulacion = new Postulacion();
        $result = $postulacion->getById($id);

        // Depuración: Verifica los datos devueltos antes de enviarlos.
        $resultJson = json_encode($result);
        
        // Verifica si el resultado es un JSON válido
        if (json_last_error() === JSON_ERROR_NONE) {
            // Respuesta exitosa con código 200 (OK)
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'data' => $result  // Enviar la postulación encontrada aquí
            ]);
        } else {
            // Si no es válido, enviar un mensaje de error
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'mensaje' => 'Error al convertir la respuesta a JSON',
                'detalle' => json_last_error_msg()  // Detalle del error JSON
            ]);
        }
    }

    // Método para actualizar una postulación existente.
    public function update($id, $data) {
        $postulacion = new Postulacion();
        $result = $postulacion->update($id, $data);

        if ($result) {
            // Respuesta exitosa con código 200 (OK)
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'mensaje' => 'Postulación actualizada'
            ]);
        } else {
            // Respuesta de error con código 500 (Error interno)
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'mensaje' => 'Error al actualizar la postulación'
            ]);
        }
    }

    // Método para eliminar una postulación por ID.
    public function delete($id) {
        $postulacion = new Postulacion();
        $result = $postulacion->delete($id);

        if ($result) {
            // Respuesta exitosa con código 200 (OK)
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'mensaje' => 'Postulación eliminada'
            ]);
        } else {
            // Respuesta de error con código 500 (Error interno)
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'mensaje' => 'Error al eliminar la postulación'
            ]);
        }
    }
}
?>






