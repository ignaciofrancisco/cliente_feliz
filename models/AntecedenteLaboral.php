<?php
// Incluye el archivo de configuración de la base de datos, que contiene la conexión a la base de datos.
include_once('../config/database.php'); // Asegúrate de que este archivo esté en la ruta correcta

// Clase que maneja las operaciones CRUD para los antecedentes laborales.
class AntecedenteLaboral {

    private $pdo; // Atributo privado que guarda la conexión PDO con la base de datos.

    // Constructor de la clase. Recibe la conexión global de PDO.
    public function __construct() {
        global $pdo; // Usamos la conexión global definida en el archivo 'database.php'.
        $this->pdo = $pdo; // Asignamos la conexión PDO al atributo $pdo de la clase.
    }

    // Método para crear un nuevo antecedente laboral en la base de datos.
    public function create($data) {
        // Consulta SQL para insertar un nuevo antecedente laboral.
        $sql = "INSERT INTO antecedentelaboral (candidato_id, empresa, cargo, funciones, fecha_inicio, fecha_termino) 
                VALUES (:candidato_id, :empresa, :cargo, :funciones, :fecha_inicio, :fecha_termino)";
        
        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':empresa', $data['empresa']);
        $stmt->bindParam(':cargo', $data['cargo']);
        $stmt->bindParam(':funciones', $data['funciones']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_termino', $data['fecha_termino']);

        // Ejecutamos la consulta y verificamos si se ha ejecutado correctamente.
        if ($stmt->execute()) {
            // Si la ejecución es exitosa, retornamos un mensaje de éxito.
            return ['status' => 'success', 'message' => 'Antecedente laboral creado exitosamente'];
        } else {
            // Si ocurre un error en la ejecución, retornamos un mensaje de error.
            return ['status' => 'error', 'message' => 'Error al crear el antecedente laboral'];
        }
    }

    // Método para obtener todos los antecedentes laborales desde la base de datos.
    public function getAll() {
        // Consulta SQL para obtener todos los registros de antecedentes laborales.
        $sql = "SELECT * FROM antecedentelaboral";

        // Ejecutamos la consulta directamente, ya que no necesitamos parámetros.
        $stmt = $this->pdo->query($sql);

        // Retornamos los resultados en formato de array asociativo.
        return ['status' => 'success', 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }

    // Método para obtener un antecedente laboral específico por su ID.
    public function getById($id) {
        // Consulta SQL para obtener un antecedente laboral por su ID.
        $sql = "SELECT * FROM antecedentelaboral WHERE id = :id";

        // Preparamos la consulta con el parámetro ID.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id); // Vinculamos el ID a la consulta.

        // Ejecutamos la consulta.
        $stmt->execute();

        // Obtenemos el resultado en formato de array asociativo.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si se encuentra un registro, lo retornamos; si no, retornamos un mensaje de error.
        return $row ? ['status' => 'success', 'data' => $row] : ['status' => 'error', 'message' => 'No encontrado'];
    }

    // Método para actualizar un antecedente laboral específico por su ID.
    public function update($id, $data) {
        // Consulta SQL para actualizar los datos de un antecedente laboral.
        $sql = "UPDATE antecedentelaboral SET 
                    candidato_id = :candidato_id,
                    empresa = :empresa,
                    cargo = :cargo,
                    funciones = :funciones,
                    fecha_inicio = :fecha_inicio,
                    fecha_termino = :fecha_termino
                WHERE id = :id";

        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data y el ID.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':empresa', $data['empresa']);
        $stmt->bindParam(':cargo', $data['cargo']);
        $stmt->bindParam(':funciones', $data['funciones']);
        $stmt->bindParam(':fecha_inicio', $data['fecha_inicio']);
        $stmt->bindParam(':fecha_termino', $data['fecha_termino']);
        $stmt->bindParam(':id', $id); // Vinculamos el ID.

        // Ejecutamos la consulta y verificamos si la actualización fue exitosa.
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Actualizado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar'];
        }
    }

    // Método para eliminar un antecedente laboral específico por su ID.
    public function delete($id) {
        // Consulta SQL para eliminar un antecedente laboral por su ID.
        $sql = "DELETE FROM antecedentelaboral WHERE id = :id";

        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos el ID a la consulta.
        $stmt->bindParam(':id', $id);

        // Ejecutamos la consulta y verificamos si la eliminación fue exitosa.
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Eliminado correctamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al eliminar'];
        }
    }
}
?>
