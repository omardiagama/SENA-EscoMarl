<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProductoController.php'; // Inclusión del controlador de productos

$action = $_GET['action'] ?? ($_GET['accion'] ?? 'dashboard');
$controlador = $_GET['controlador'] ?? '';

$authController = new AuthController();

// 1. Manejo de Inicio y Cierre de Sesión
if ($action === 'login' || ($action === 'index' && $controlador === 'auth')) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $authController->login();
    } else {
        $authController->mostrarLogin();
    }
    exit();
}

if ($action === 'logout') {
    $authController->logout();
    exit();
}

// 2. Control de Acceso: Si no hay sesión, muestra el login
if (!isset($_SESSION['usuario']) && !isset($_SESSION['usuario_id'])) {
    $authController->mostrarLogin();
    exit();
}

// 3. Enrutador con Ejecución de Controladores
    switch ($action) {
        case 'productos':
            require_once __DIR__ . '/controllers/ProductoController.php';
            $controller = new ProductoController();
            $controller->index();
            break;

        case 'productos_crear':
            require_once __DIR__ . '/controllers/ProductoController.php';
            $controller = new ProductoController();
            $controller->crear();
            break;

        case 'productos_editar':
            require_once __DIR__ . '/controllers/ProductoController.php';
            $controller = new ProductoController();
            $controller->editar();
            break;

        case 'productos_eliminar':
            require_once __DIR__ . '/controllers/ProductoController.php';
            $controller = new ProductoController();
            $controller->eliminar();
            break;

        case 'ventas':
            require_once __DIR__ . '/controllers/VentaController.php';
            $controller = new VentaController();
            $controller->index();
            break;

        case 'ventas_crear':
            require_once __DIR__ . '/controllers/VentaController.php';
            $controller = new VentaController();
            $controller->crear();
            break;

        case 'ventas_inhabilitar':  
        require_once __DIR__ . '/controllers/VentaController.php';  
        $controller = new VentaController();  
        $controller->inhabilitar();  
        break;  

        case 'ventas_habilitar':  
        require_once __DIR__ . '/controllers/VentaController.php';  
        $controller = new VentaController();  
        $controller->habilitar();  
        break;
        
        case 'clientes':
            require_once __DIR__ . '/controllers/ClienteController.php';
            $controller = new ClienteController();
            $controller->index();
            break;

        case 'clientes_crear':
            require_once __DIR__ . '/controllers/ClienteController.php';
            $controller = new ClienteController();
            $controller->crear();
            break;

        case 'clientes_editar':
            require_once __DIR__ . '/controllers/ClienteController.php';
            $controller = new ClienteController();
            $controller->editar();
            break;

        case 'empleados':
            require_once __DIR__ . '/controllers/EmpleadoController.php';
            $controller = new EmpleadoController();
            $controller->index();
            break;

        case 'empleados_crear':
            require_once __DIR__ . '/controllers/EmpleadoController.php';
            $controller = new EmpleadoController();
            $controller->crear();
            break;

        case 'empleados_editar':
            require_once __DIR__ . '/controllers/EmpleadoController.php';
            $controller = new EmpleadoController();
            $controller->editar();
            break;

        case 'empleados_eliminar':
            require_once __DIR__ . '/controllers/EmpleadoController.php';
            $controller = new EmpleadoController();
            $controller->eliminar();
            break;

        case 'dashboard':
        default:
            $file = __DIR__ . '/views/dashboard/index.php';
            if (file_exists($file)) require_once $file;
            break;
    }