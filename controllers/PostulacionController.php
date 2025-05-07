<?php
include_once('../models/Postulacion.php');
include_once('../utils/response.php');

class PostulacionController {
    public function create($data) {
        $postulacion = new Postulacion();
        $result = $postulacion->create($data);
        
        // Convertir el resultado a formato JSON
        echo json_encode($result);
    }
    

    public function getAll() {
        $oferta = new postulacion();
        $result = $oferta->getAll();
        return Response::json($result);
    }

    public function getById($id) {
        $oferta = new postulacion();
        $result = $oferta->getById($id);
        return Response::json($result);
    }

    public function update($id, $data) {
        $oferta = new postulacion();
        $result = $oferta->update($id, $data);
        return Response::json($result);
    }

    public function delete($id) {
        $oferta = new postulacion();
        $result = $oferta->delete($id);
        return Response::json($result);
    }
}

?>

