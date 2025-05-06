<?php
// Incluye controladores
include_once('../controllers/UsuarioController.php');
include_once('../controllers/OfertaLaboralController.php');
// Crear instancias de los controladores
$usuarioController = new UsuarioController();
$ofertaLaboralController = new OfertaLaboralController();
//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear usuario////////////////////////////////////
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['resource'] == 'usuario') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $usuarioController->create($data);
}

// Ruta para obtener todos los usuarios
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['resource'] == 'usuario') {
    echo $usuarioController->getAll();
}

// Ruta para obtener un usuario por ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $_GET['resource'] == 'usuario') {
    echo $usuarioController->getById($_GET['id']);
}

// Ruta para actualizar un usuario
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id']) && $_GET['resource'] == 'usuario') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $usuarioController->update($_GET['id'], $data);
}

// Ruta para eliminar un usuario
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id']) && $_GET['resource'] == 'usuario') {
    echo $usuarioController->delete($_GET['id']);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear una nueva oferta laboral////////////////////////////////////

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['resource'] == 'ofertalaboral') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $ofertaLaboralController->create($data);
}

// Ruta para obtener todas las ofertas laborales
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['resource'] == 'ofertalaboral') {
    echo $ofertaLaboralController->getAll();
}

// Ruta para obtener una oferta laboral por ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $_GET['resource'] == 'ofertalaboral') {
    echo $ofertaLaboralController->getById($_GET['id']);
}

// Ruta para actualizar una oferta laboral
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && preg_match('/\/api\/ofertas\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $controller = new OfertaLaboralController();
    $controller->update($id, $data);
}

// Eliminar (desactivar) una oferta laboral
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && preg_match('/\/api\/ofertas\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $id = $matches[1];
    $controller = new OfertaLaboralController();
    $controller->delete($id);
}


?>

