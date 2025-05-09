<?php
// Incluir el modelo Usuario para interactuar con los datos de usuario.
include_once('../models/Usuario.php');
include_once('../utils/response.php');

class UsuarioController {

    // Método para crear un nuevo usuario.
    public function create($data) {
        $usuario = new Usuario();
        $result = $usuario->create($data);
        
        // Si la creación es exitosa, respondemos con código 201 (Creado).
        if ($result) {
            http_response_code(201);  // Código HTTP 201: Creado
            return Response::json([
                'status' => 'success',
                'mensaje' => 'Usuario creado exitosamente'
            ]);
        } else {
            // Si ocurre un error al crear, respondemos con código 500 (Error Interno).
            http_response_code(500);  // Código HTTP 500: Error interno del servidor
            return Response::json([
                'status' => 'error',
                'mensaje' => 'Error al crear el usuario'
            ]);
        }
    }

    // Método para obtener todos los usuarios.
    public function getAll() {
        $usuario = new Usuario();
        $result = $usuario->getAll();
        
        // Si la solicitud es exitosa, respondemos con código 200 (OK).
        http_response_code(200);  // Código HTTP 200: OK
        return Response::json([
            'status' => 'success',
            'data' => $result
        ]);
    }

    // Método para obtener un usuario específico por ID.
    public function getById($id) {
        $usuario = new Usuario();
        $result = $usuario->getById($id);
        
        if ($result) {
            // Si se encuentra el usuario, respondemos con código 200 (OK).
            http_response_code(200);  // Código HTTP 200: OK
            return Response::json([
                'status' => 'success',
                'data' => $result
            ]);
        } else {
            // Si no se encuentra el usuario, respondemos con código 404 (No Encontrado).
            http_response_code(404);  // Código HTTP 404: No encontrado
            return Response::json([
                'status' => 'error',
                'mensaje' => 'Usuario no encontrado'
            ]);
        }
    }

    // Método para actualizar un usuario específico por ID.
    public function update($id, $data) {
        $usuario = new Usuario();
        $result = $usuario->update($id, $data);
        
        if ($result) {
            // Si la actualización es exitosa, respondemos con código 200 (OK).
            http_response_code(200);  // Código HTTP 200: OK
            return Response::json([
                'status' => 'success',
                'mensaje' => 'Usuario actualizado exitosamente'
            ]);
        } else {
            // Si ocurre un error al actualizar, respondemos con código 500 (Error Interno).
            http_response_code(500);  // Código HTTP 500: Error interno del servidor
            return Response::json([
                'status' => 'error',
                'mensaje' => 'Error al actualizar el usuario'
            ]);
        }
    }

    // Método para eliminar un usuario por ID.
    public function delete($id) {
        $usuario = new Usuario();
        $result = $usuario->delete($id);
        
        if ($result) {
            // Si la eliminación es exitosa, respondemos con código 200 (OK).
            http_response_code(200);  // Código HTTP 200: OK
            return Response::json([
                'status' => 'success',
                'mensaje' => 'Usuario eliminado exitosamente'
            ]);
        } else {
            // Si ocurre un error al eliminar, respondemos con código 500 (Error Interno).
            http_response_code(500);  // Código HTTP 500: Error interno del servidor
            return Response::json([
                'status' => 'error',
                'mensaje' => 'Error al eliminar el usuario'
            ]);
        }
    }
}
?>

