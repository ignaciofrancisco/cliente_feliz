<?php
include_once('../models/Usuario.php');
include_once('../utils/response.php');

class UsuarioController {

    public function create($data) {
        $usuario = new Usuario();
        $result = $usuario->create($data);
        return Response::json($result);
    }

    public function getAll() {
        $usuario = new Usuario();
        $result = $usuario->getAll();
        return Response::json($result);
    }

    public function getById($id) {
        $usuario = new Usuario();
        $result = $usuario->getById($id);
        return Response::json($result);
    }

    public function update($id, $data) {
        $usuario = new Usuario();
        $result = $usuario->update($id, $data);
        return Response::json($result);
    }

    public function delete($id) {
        $usuario = new Usuario();
        $result = $usuario->delete($id);
        return Response::json($result);
    }
}
?>
