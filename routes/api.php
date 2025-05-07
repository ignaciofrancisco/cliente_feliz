<?php
header('Content-Type: application/json');

// Incluye controladores desde carpeta ../controllers/
include_once(__DIR__ . '/../controllers/UsuarioController.php');
include_once(__DIR__ . '/../controllers/OfertaLaboralController.php');
include_once(__DIR__ . '/../controllers/PostulacionController.php');
require_once(__DIR__ . '/../controllers/AntecedenteAcademicoController.php');




$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$requestUri = str_replace('/api/api.php', '/api', $requestUri);

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear usuario////////////////////////////////////////////////////
$usuarioController = new UsuarioController();
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
$ofertaLaboralController = new OfertaLaboralController();
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


//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear una postulacion////////////////////////////////////////////
$postulacionController = new PostulacionController();
// Crear
if ($method === 'POST' && preg_match('/\/api\/postulaciones$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $postulacionController->create($data);
}

// Obtener todas las postulaciones
if ($method === 'GET' && preg_match('/\/api\/postulaciones$/', $requestUri)) {
    header('Content-Type: application/json');  // Aseguramos el tipo de contenido
    $response = $postulacionController->getAll();
    echo json_encode($response);  // Respondemos en formato JSON
}

// Obtener una postulación por ID
if ($method === 'GET' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    header('Content-Type: application/json');  // Aseguramos el tipo de contenido
    $response = $postulacionController->getById($id);
    echo json_encode($response);  // Respondemos en formato JSON
}

// Actualizar una postulación
if ($method === 'PUT' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $data = json_decode(file_get_contents("php://input"), true);
    $response = $postulacionController->update($id, $data);
    header('Content-Type: application/json');
    echo json_encode($response);  // Respondemos en formato JSON
}

// Eliminar una postulación
if ($method === 'DELETE' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $id = $matches[1];
    $response = $postulacionController->delete($id);
    header('Content-Type: application/json');
    echo json_encode($response);  // Respondemos en formato JSON
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para crear AntecedentesAcademicos////////////////////////////////////////////
$antecedenteAcademicoController = new AntecedenteAcademicoController();
// Crear
if ($method === 'POST' && preg_match('/\/api\/antecedentes-academicos$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $antecedenteAcademicoController->create($data);
}

// Obtener todos
if ($method === 'GET' && preg_match('/\/api\/antecedentes-academicos$/', $requestUri)) {
    $antecedenteAcademicoController->getAll();
}

// Obtener por ID
if ($method === 'GET' && preg_match('/\/api\/antecedentes-academicos\/(\d+)/', $requestUri, $matches)) {
    $antecedenteAcademicoController->getById($matches[1]);
}

// Actualizar
if ($method === 'PUT' && preg_match('/\/api\/antecedentes-academicos\/(\d+)/', $requestUri, $matches)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $antecedenteAcademicoController->update($matches[1], $data);
}

// Eliminar
if ($method === 'DELETE' && preg_match('/\/api\/antecedentes-academicos\/(\d+)/', $requestUri, $matches)) {
    $antecedenteAcademicoController->delete($matches[1]);
}











?>

