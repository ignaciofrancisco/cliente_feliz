<?php
include_once('../models/OfertaLaboral.php');
include_once('../utils/response.php');

class OfertaLaboralController {

    public function create($data) {
        $ofertaLaboral = new OfertaLaboral();
        $result = $ofertaLaboral->create($data);
        
        // Convertir el resultado a formato JSON
        echo json_encode($result);
    }
    

    public function getAll() {
        $oferta = new OfertaLaboral();
        $result = $oferta->getAll();
        return Response::json($result);
    }

    public function getById($id) {
        $oferta = new OfertaLaboral();
        $result = $oferta->getById($id);
        return Response::json($result);
    }

    public function update($id, $data) {
        $oferta = new OfertaLaboral();
        $result = $oferta->update($id, $data);
        return Response::json($result);
    }

    public function delete($id) {
        $oferta = new OfertaLaboral();
        $result = $oferta->delete($id);
        return Response::json($result);
    }
}
?>
