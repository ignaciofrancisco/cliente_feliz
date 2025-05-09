<?php
// Incluye el archivo de configuración de la base de datos, que contiene la conexión a la base de datos.
include_once('../config/database.php'); // o la ruta correcta si está en otro directorio

// Clase que maneja las operaciones CRUD para las ofertas laborales.
class OfertaLaboral {

    private $pdo; // Atributo privado que almacena la conexión PDO con la base de datos.

    // Constructor de la clase. Recibe la conexión global de PDO.
    public function __construct() {
        global $pdo; // Usamos la conexión global definida en el archivo 'database.php'.
        $this->pdo = $pdo; // Asignamos la conexión PDO al atributo $pdo de la clase.
    }

    // Método para crear una nueva oferta laboral.
    public function create($data) {
        // Depuración para ver el contenido de $data
        error_log(print_r($data, true));  // Ver los datos que recibes
        
        // Consulta SQL para insertar una nueva oferta laboral.
        $sql = "INSERT INTO ofertalaboral (titulo, descripcion, ubicacion, salario, tipo_contrato, fecha_publicacion, fecha_cierre, estado, reclutador_id) 
                VALUES (:titulo, :descripcion, :ubicacion, :salario, :tipo_contrato, :fecha_publicacion, :fecha_cierre, :estado, :reclutador_id)";
        
        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);
        
        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data.
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':salario', $data['salario']);
        $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
        $stmt->bindParam(':fecha_publicacion', $data['fecha_publicacion']);
        $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':reclutador_id', $data['reclutador_id']);
        
        // Ejecutamos la consulta y verificamos si se ha ejecutado correctamente.
        if ($stmt->execute()) {
            // Si la ejecución es exitosa, retornamos un mensaje de éxito.
            return ['status' => 'success', 'message' => 'Oferta laboral creada exitosamente'];
        } else {
            // Si ocurre un error en la ejecución, retornamos un mensaje de error.
            return ['status' => 'error', 'message' => 'Error al crear la oferta laboral'];
        }
    }

    // Método para obtener todas las ofertas laborales.
    public function getAll() {
        // Consulta SQL para obtener todas las ofertas laborales.
        $sql = "SELECT * FROM ofertalaboral";
        
        // Ejecutamos la consulta directamente, ya que no necesitamos parámetros.
        $stmt = $this->pdo->query($sql);
        
        // Obtenemos todos los resultados en formato de array asociativo.
        $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornamos los resultados junto con el estado de la operación.
        return ['status' => 'success', 'data' => $ofertas];
    }

    // Método para obtener una oferta laboral específica por su ID.
    public function getById($id) {
        // Consulta SQL para obtener una oferta laboral por su ID.
        $sql = "SELECT * FROM ofertalaboral WHERE id = :id";
        
        // Preparamos la consulta con el parámetro ID.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id); // Vinculamos el ID a la consulta.
        
        // Ejecutamos la consulta.
        $stmt->execute();
        
        // Obtenemos el resultado en formato de array asociativo.
        $oferta = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si se encuentra la oferta, la retornamos; si no, retornamos un mensaje de error.
        return $oferta ? ['status' => 'success', 'data' => $oferta] : ['status' => 'error', 'message' => 'Oferta no encontrada'];
    }

    // Método para actualizar una oferta laboral específica por su ID.
    public function update($id, $data) {
        // Consulta SQL para actualizar los datos de una oferta laboral.
        $sql = "UPDATE ofertalaboral SET 
                    titulo = :titulo,
                    descripcion = :descripcion,
                    ubicacion = :ubicacion,
                    salario = :salario,
                    tipo_contrato = :tipo_contrato,
                    fecha_publicacion = :fecha_publicacion,
                    fecha_cierre = :fecha_cierre,
                    estado = :estado,
                    reclutador_id = :reclutador_id
                WHERE id = :id";
        
        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);
        
        // Vinculamos los parámetros de la consulta con los valores proporcionados en el array $data y el ID.
        $stmt->bindParam(':titulo', $data['titulo']);
        $stmt->bindParam(':descripcion', $data['descripcion']);
        $stmt->bindParam(':ubicacion', $data['ubicacion']);
        $stmt->bindParam(':salario', $data['salario']);
        $stmt->bindParam(':tipo_contrato', $data['tipo_contrato']);
        $stmt->bindParam(':fecha_publicacion', $data['fecha_publicacion']);
        $stmt->bindParam(':fecha_cierre', $data['fecha_cierre']);
        $stmt->bindParam(':estado', $data['estado']);
        $stmt->bindParam(':reclutador_id', $data['reclutador_id']);
        $stmt->bindParam(':id', $id); // Vinculamos el ID de la oferta laboral a actualizar.
        
        // Ejecutamos la consulta y verificamos si la actualización fue exitosa.
        $stmt->execute();
        
        // Retornamos un mensaje de éxito tras la actualización.
        return ["status" => "success", "message" => "Oferta laboral actualizada exitosamente"];
    }

    // Método para desactivar (eliminar) una oferta laboral al cambiar su estado.
    public function delete($id) {
        // Consulta SQL para actualizar el estado de la oferta laboral a 'Cerrada'.
        $sql = "UPDATE ofertalaboral SET estado = 'Cerrada' WHERE id = :id";
        
        // Preparamos la consulta SQL.
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id); // Vinculamos el ID de la oferta laboral a desactivar.
        
        // Ejecutamos la consulta para marcar la oferta como cerrada.
        $stmt->execute();
        
        // Retornamos un mensaje indicando que la oferta fue desactivada.
        return ["status" => "success", "message" => "Oferta laboral desactivada"];
    }
}
?>
