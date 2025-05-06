<?php
include_once('../config/database.php');

class Usuario {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create($data) {
        // Validar el rol
        $validRoles = ['Reclutador', 'Candidato'];
        if (!in_array($data['rol'], $validRoles)) {
            return ['status' => 'error', 'message' => 'Rol no válido'];
        }
    
        // Asignar los datos a variables
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        $contrasena = password_hash($data['contrasena'], PASSWORD_BCRYPT);
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $rol = $data['rol'];
    
        // Sentencia SQL para insertar
        $sql = "INSERT INTO Usuario (nombre, apellido, email, contrasena, fecha_nacimiento, telefono, direccion, rol) 
                VALUES (:nombre, :apellido, :email, :contrasena, :fecha_nacimiento, :telefono, :direccion, :rol)";
        $stmt = $this->pdo->prepare($sql);
    
        // Vincular los parámetros a las variables
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':rol', $rol);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Usuario creado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al crear el usuario'];
        }
    }
    
    
    
    
    

    public function getAll() {
        $sql = "SELECT * FROM Usuario";
        $stmt = $this->pdo->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['status' => 'success', 'data' => $usuarios];
    }

    public function getById($id) {
        $sql = "SELECT * FROM Usuario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario ? ['status' => 'success', 'data' => $usuario] : ['status' => 'error', 'message' => 'Usuario no encontrado'];
    }

    public function update($id, $data) {
        // Validar el rol
        $validRoles = ['Reclutador', 'Candidato'];
        if (!in_array($data['rol'], $validRoles)) {
            return ['status' => 'error', 'message' => 'Rol no válido'];
        }
    
        // Asignar los datos a variables
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        $contrasena = isset($data['contrasena']) ? password_hash($data['contrasena'], PASSWORD_BCRYPT) : null;
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $rol = $data['rol'];
    
        // Sentencia SQL para actualizar
        $sql = "UPDATE Usuario SET nombre = :nombre, apellido = :apellido, email = :email, 
                contrasena = COALESCE(:contrasena, contrasena), fecha_nacimiento = :fecha_nacimiento, 
                telefono = :telefono, direccion = :direccion, rol = :rol WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
    
        // Vincular los parámetros a las variables
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':id', $id);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Usuario actualizado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar el usuario'];
        }
    }
    
    

    public function delete($id) {
        $sql = "UPDATE Usuario SET estado = 'inactivo' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Usuario desactivado'];
        } else {
            return ['status' => 'error', 'message' => 'Error al desactivar el usuario'];
        }
    }
    
}
?>

