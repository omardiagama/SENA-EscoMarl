<?php

session_start();

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';

$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;

    /* --- Rutas de Productos --- */
    case 'productos':
        $controller = new ProductoController();
        $controller->index();
        break;

    case 'productos_crear':
        $controller = new ProductoController();
        $controller->crear();
        break;

    case 'productos_editar':
        $controller = new ProductoController();
        $controller->editar();
        break;

    case 'productos_eliminar':
        $controller = new ProductoController();
        $controller->eliminar();
        break;

    /* --- Rutas de Usuarios --- */
    case 'usuarios':
        $controller = new UsuarioController();
        $controller->index();
        break;

    case 'usuarios_crear':
        $controller = new UsuarioController();
        $controller->crear();
        break;

    case 'usuarios_editar':
        $controller = new UsuarioController();
        $controller->editar();
        break;

    case 'usuarios_eliminar':
        $controller = new UsuarioController();
        $controller->eliminar();
        break;

    default:
        header('Location: index.php?action=dashboard');
        exit();
}