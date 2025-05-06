<?php
// Incluye controladores
include_once('../controllers/UsuarioController.php');
include_once('../controllers/OfertaLaboralController.php');
// Crear instancias de los controladores
$usuarioController = new UsuarioController();
$ofertaLaboralController = new OfertaLaboralController();
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear usuario////////////////////////////////////
if ($method === 'POST' && preg_match('/\/api\/usuarios$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $usuarioController->create($data);
}

if ($method === 'GET' && preg_match('/\/api\/usuarios$/', $requestUri)) {
    echo $usuarioController->getAll();
}

if ($method === 'GET' && preg_match('/\/api\/usuarios\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    echo $usuarioController->getById($id);
}

if ($method === 'PUT' && preg_match('/\/api\/usuarios\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $usuarioController->update($id, $data);
}

if ($method === 'DELETE' && preg_match('/\/api\/usuarios\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $usuarioController->delete($id);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear una nueva oferta laboral////////////////////////////////////

if ($method === 'POST' && preg_match('/\/api\/ofertas$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $ofertaLaboralController->create($data);
}

if ($method === 'GET' && preg_match('/\/api\/ofertas$/', $requestUri)) {
    echo $ofertaLaboralController->getAll();
}

if ($method === 'GET' && preg_match('/\/api\/ofertas\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    echo $ofertaLaboralController->getById($id);
}

if ($method === 'PUT' && preg_match('/\/api\/ofertas\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $ofertaLaboralController->update($id, $data);
}

if ($method === 'DELETE' && preg_match('/\/api\/ofertas\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $ofertaLaboralController->delete($id);
}


?>

