<?php
// Establece el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');

// Incluye todos los controladores necesarios desde la carpeta controllers
include_once(__DIR__ . '/../controllers/UsuarioController.php');
include_once(__DIR__ . '/../controllers/OfertaLaboralController.php');
include_once(__DIR__ . '/../controllers/PostulacionController.php');
require_once(__DIR__ . '/../controllers/AntecedenteAcademicoController.php');
require_once(__DIR__ . '/../controllers/AntecedenteLaboralController.php');

// Detecta el método HTTP y la URI solicitada
$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Ajusta la URI para eliminar la parte del script api.php si está presente
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
// Crear una postulación
if ($method === 'POST' && preg_match('/\/api\/postulaciones$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $postulacionController->create($data);
}

// Obtener todas las postulaciones
if ($method === 'GET' && preg_match('/\/api\/postulaciones$/', $requestUri)) {
    $postulacionController->getAll();
}

// Obtener una postulación por ID
if ($method === 'GET' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $postulacionController->getById($matches[1]);
}

// Actualizar una postulación por ID
if ($method === 'PUT' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $postulacionController->update($matches[1], $data);
}

// Eliminar una postulación por ID
if ($method === 'DELETE' && preg_match('/\/api\/postulaciones\/(\d+)/', $requestUri, $matches)) {
    $postulacionController->delete($matches[1]);
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

///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////// //////////Ruta para AntecedentesLaborales/////////////////////////////////////////////////

$antecedenteLaboralController = new AntecedenteLaboralController();

// Crear
if ($method === 'POST' && preg_match('/\/api\/antecedentes-laborales$/', $requestUri)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $antecedenteLaboralController->create($data);
}

// Obtener todos
if ($method === 'GET' && preg_match('/\/api\/antecedentes-laborales$/', $requestUri)) {
    $antecedenteLaboralController->getAll();
}

// Obtener por ID
if ($method === 'GET' && preg_match('/\/api\/antecedentes-laborales\/(\d+)/', $requestUri, $matches)) {
    $antecedenteLaboralController->getById($matches[1]);
}

// Actualizar
if ($method === 'PUT' && preg_match('/\/api\/antecedentes-laborales\/(\d+)/', $requestUri, $matches)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $antecedenteLaboralController->update($matches[1], $data);
}

// Eliminar
if ($method === 'DELETE' && preg_match('/\/api\/antecedentes-laborales\/(\d+)/', $requestUri, $matches)) {
    $antecedenteLaboralController->delete($matches[1]);
}










?>

