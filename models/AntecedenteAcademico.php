<?php
// Incluye el archivo de configuración de la base de datos, que contiene la conexión a la base de datos.
include_once('../config/database.php'); // Ajusta según tu estructura

// Clase que maneja las operaciones CRUD para los antecedentes académicos.
class AntecedenteAcademico {

    private $pdo; // Atributo privado que guarda la conexión PDO con la base de datos.

    // Constructor de la clase. Recibe la conexión global de PDO.
    public function __construct() {
        global $pdo; // Usamos la conexión global definida en el archivo 'database.php'.
        $this->pdo = $pdo; // Asignamos la conexión PDO al atributo $pdo de la clase.
    }

    // Método para crear un nuevo antecedente académico en la base de datos.
    public function create($data) {
        // Consulta SQL para insertar un nuevo antecedente académico.
        $sql = "INSERT INTO antecedenteacademico (candidato_id, institucion, titulo_obtenido, anio_ingreso, anio_egreso) 
                VALUES (:candidato_id, :institucion, :titulo_obtenido, :anio_ingreso, :anio_egreso)";
        
        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':institucion', $data['institucion']);
        $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
        $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
        $stmt->bindParam(':anio_egreso', $data['anio_egreso']);

        // Ejecutamos la consulta y verificamos si se ha ejecutado correctamente.
        if ($stmt->execute()) {
            // Si la ejecución es exitosa, retornamos un mensaje de éxito.
            return ['status' => 'success', 'message' => 'Antecedente académico creado exitosamente'];
        } else {
            // Si ocurre un error en la ejecución, retornamos un mensaje de error.
            return ['status' => 'error', 'message' => 'Error al crear el antecedente académico'];
        }
    }

    // Método para obtener todos los antecedentes académicos desde la base de datos.
    public function getAll() {
        // Consulta SQL para obtener todos los registros de antecedentes académicos.
        $sql = "SELECT * FROM antecedenteacademico";

        // Ejecutamos la consulta directamente, ya que no necesitamos parámetros.
        $stmt = $this->pdo->query($sql);

        // Retornamos los resultados en formato de array asociativo.
        return ['status' => 'success', 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
    }

    // Método para obtener un antecedente académico específico por su ID.
    public function getById($id) {
        // Consulta SQL para obtener un antecedente académico por su ID.
        $sql = "SELECT * FROM antecedenteacademico WHERE id = :id";

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

    // Método para actualizar un antecedente académico específico por su ID.
    public function update($id, $data) {
        // Consulta SQL para actualizar los datos de un antecedente académico.
        $sql = "UPDATE antecedenteacademico SET 
                    candidato_id = :candidato_id,
                    institucion = :institucion,
                    titulo_obtenido = :titulo_obtenido,
                    anio_ingreso = :anio_ingreso,
                    anio_egreso = :anio_egreso
                WHERE id = :id";

        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);

        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data y el ID.
        $stmt->bindParam(':candidato_id', $data['candidato_id']);
        $stmt->bindParam(':institucion', $data['institucion']);
        $stmt->bindParam(':titulo_obtenido', $data['titulo_obtenido']);
        $stmt->bindParam(':anio_ingreso', $data['anio_ingreso']);
        $stmt->bindParam(':anio_egreso', $data['anio_egreso']);
        $stmt->bindParam(':id', $id); // Vinculamos el ID.

        // Ejecutamos la consulta y verificamos si la actualización fue exitosa.
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Actualizado exitosamente'];
        } else {
            return ['status' => 'error', 'message' => 'Error al actualizar'];
        }
    }

    // Método para eliminar un antecedente académico específico por su ID.
    public function delete($id) {
        // Consulta SQL para eliminar un antecedente académico por su ID.
        $sql = "DELETE FROM antecedenteacademico WHERE id = :id";

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

