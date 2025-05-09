<?php
// Se incluye el modelo que maneja la lógica de las ofertas laborales.
include_once('../models/OfertaLaboral.php');

// Se incluye un archivo utilitario para dar formato a las respuestas JSON (no usado aquí directamente).
include_once('../utils/response.php');

class OfertaLaboralController {

    // Método para crear una nueva oferta laboral.
    public function create($data) {
        // Se instancia el modelo.
        $ofertaLaboral = new OfertaLaboral();
        // Se llama al método de creación con los datos.
        $result = $ofertaLaboral->create($data);

        if ($result) {
            // Si se crea exitosamente, se responde con código 201 (Created).
            http_response_code(201);
            echo json_encode(['mensaje' => 'Oferta laboral creada exitosamente']);
        } else {
            // Si hay un error, se responde con código 500.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al crear la oferta laboral']);
        }
    }

    // Método para obtener todas las ofertas laborales.
    public function getAll() {
        $oferta = new OfertaLaboral();
        $result = $oferta->getAll();

        // Se responde con los datos y código 200 (OK).
        http_response_code(200);
        echo json_encode($result);
    }

    // Método para obtener una oferta laboral por su ID.
    public function getById($id) {
        $oferta = new OfertaLaboral();
        $result = $oferta->getById($id);

        if ($result) {
            // Si se encuentra la oferta, se responde con código 200.
            http_response_code(200);
            echo json_encode($result);
        } else {
            // Si no se encuentra, se responde con código 404.
            http_response_code(404);
            echo json_encode(['mensaje' => 'Oferta laboral no encontrada']);
        }
    }

    // Método para actualizar una oferta laboral existente.
    public function update($id, $data) {
        $oferta = new OfertaLaboral();

        if ($oferta->update($id, $data)) {
            // Si se actualiza correctamente, código 200.
            http_response_code(200);
            echo json_encode(['mensaje' => 'Oferta laboral actualizada']);
        } else {
            // Si hay error, código 500.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al actualizar la oferta laboral']);
        }
    }

    // Método para eliminar una oferta laboral por ID.
    public function delete($id) {
        $oferta = new OfertaLaboral();

        if ($oferta->delete($id)) {
            // Si se elimina, código 200.
            http_response_code(200);
            echo json_encode(['mensaje' => 'Oferta laboral eliminada']);
        } else {
            // Si falla, código 500.
            http_response_code(500);
            echo json_encode(['mensaje' => 'Error al eliminar la oferta laboral']);
        }
    }
}
?>

