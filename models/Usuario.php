<?php
include_once('../config/database.php');

class Usuario {

    private $pdo;

    // Constructor que accede a la conexión global
    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Crear un nuevo usuario
    public function create($data) {
        try {
            // Validar rol permitido
            $validRoles = ['Reclutador', 'Candidato'];
            if (!in_array($data['rol'], $validRoles)) {
                return ['status' => 'error', 'message' => 'Rol no válido'];
            }

            // Validación básica de campos obligatorios
            if (empty($data['email']) || empty($data['nombre']) || empty($data['apellido']) || empty($data['contrasena'])) {
                return ['status' => 'error', 'message' => 'Faltan campos obligatorios'];
            }

            // Verificar si el email ya existe
            $checkSql = "SELECT id FROM Usuario WHERE email = :email";
            $checkStmt = $this->pdo->prepare($checkSql);
            $checkStmt->bindParam(':email', $data['email']);
            $checkStmt->execute();
            if ($checkStmt->fetch()) {
                return ['status' => 'error', 'message' => 'Ya existe un usuario con este email'];
            }

            // Preparar SQL de inserción
            $sql = "INSERT INTO Usuario (nombre, apellido, email, contrasena, fecha_nacimiento, telefono, direccion, rol) 
                    VALUES (:nombre, :apellido, :email, :contrasena, :fecha_nacimiento, :telefono, :direccion, :rol)";
            $stmt = $this->pdo->prepare($sql);

            // Encriptar la contraseña
            $contrasenaHasheada = password_hash($data['contrasena'], PASSWORD_BCRYPT);

            // Asignar valores a los parámetros
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':contrasena', $contrasenaHasheada);
            $stmt->bindParam(':fecha_nacimiento', $data['fecha_nacimiento']);
            $stmt->bindParam(':telefono', $data['telefono']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':rol', $data['rol']);

            // Ejecutar y retornar respuesta
            $stmt->execute();
            return ['status' => 'success', 'message' => 'Usuario creado exitosamente'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al crear el usuario', 'error' => $e->getMessage()];
        }
    }

    // Obtener todos los usuarios
    public function getAll() {
        try {
            $sql = "SELECT * FROM Usuario";
            $stmt = $this->pdo->query($sql);
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ['status' => 'success', 'data' => $usuarios];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al obtener usuarios', 'error' => $e->getMessage()];
        }
    }

    // Obtener un usuario por ID
    public function getById($id) {
        try {
            $sql = "SELECT * FROM Usuario WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ? ['status' => 'success', 'data' => $usuario] : ['status' => 'error', 'message' => 'Usuario no encontrado'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al buscar el usuario', 'error' => $e->getMessage()];
        }
    }

    // Actualizar un usuario existente
    public function update($id, $data) {
        try {
            // Validar rol
            $validRoles = ['Reclutador', 'Candidato'];
            if (!in_array($data['rol'], $validRoles)) {
                return ['status' => 'error', 'message' => 'Rol no válido'];
            }

            // Encriptar la contraseña si se envía una nueva
            $contrasena = isset($data['contrasena']) && !empty($data['contrasena']) 
                          ? password_hash($data['contrasena'], PASSWORD_BCRYPT)
                          : null;

            $sql = "UPDATE Usuario SET 
                        nombre = :nombre, 
                        apellido = :apellido, 
                        email = :email, 
                        contrasena = COALESCE(:contrasena, contrasena), 
                        fecha_nacimiento = :fecha_nacimiento, 
                        telefono = :telefono, 
                        direccion = :direccion, 
                        rol = :rol 
                    WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':apellido', $data['apellido']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':fecha_nacimiento', $data['fecha_nacimiento']);
            $stmt->bindParam(':telefono', $data['telefono']);
            $stmt->bindParam(':direccion', $data['direccion']);
            $stmt->bindParam(':rol', $data['rol']);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            return ['status' => 'success', 'message' => 'Usuario actualizado exitosamente'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al actualizar el usuario', 'error' => $e->getMessage()];
        }
    }

    // Desactivar un usuario (eliminar lógico)
    public function delete($id) {
        try {
            // Verificar si ya está inactivo
            $check = $this->pdo->prepare("SELECT estado FROM Usuario WHERE id = :id");
            $check->bindParam(':id', $id);
            $check->execute();
            $usuario = $check->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                return ['status' => 'error', 'message' => 'Usuario no encontrado'];
            }

            if ($usuario['estado'] === 'inactivo') {
                return ['status' => 'warning', 'message' => 'El usuario ya está inactivo'];
            }

            // Actualizar estado a 'inactivo'
            $sql = "UPDATE Usuario SET estado = 'inactivo' WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return ['status' => 'success', 'message' => 'Usuario desactivado'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Error al desactivar el usuario', 'error' => $e->getMessage()];
        }
    }
}
?>
