<?php

require_once __DIR__ . '/../models/Empleado.php';

class EmpleadoController {
    private $empleadoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->empleadoModel = new Empleado();
    }

    public function index() {
        $empleados = $this->empleadoModel->obtenerTodos();
        require_once __DIR__ . '/../views/empleados/index.php';
    }

    public function crear() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombres    = trim($_POST['nombres'] ?? '');
            $apellidos  = trim($_POST['apellidos'] ?? '');
            $usuario    = trim($_POST['usuario'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');
            $rol        = $_POST['rol'] ?? 'Empleado';
            $cargo      = trim($_POST['cargo'] ?? 'Vendedor');
            $telefono   = trim($_POST['telefono'] ?? '');

            if (empty($nombres) || empty($apellidos) || empty($usuario) || empty($contrasena)) {
                $error = "Complete todos los campos obligatorios.";
            } else {
                if ($this->empleadoModel->crear($nombres, $apellidos, $usuario, $contrasena, $rol, $cargo, $telefono)) {
                    header('Location: index.php?action=empleados&msg=creado');
                    exit();
                } else {
                    $error = "No se pudo registrar el empleado en la base de datos.";
                }
            }
        }

        require_once __DIR__ . '/../views/empleados/crear.php';
    }

    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $empleado = $this->empleadoModel->obtenerPorId($id);

        if (!$empleado) {
            header('Location: index.php?action=empleados');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombres    = trim($_POST['nombres'] ?? '');
            $apellidos  = trim($_POST['apellidos'] ?? '');
            $usuario    = trim($_POST['usuario'] ?? '');
            $contrasena = trim($_POST['contrasena'] ?? '');
            $rol        = $_POST['rol'] ?? 'Empleado';
            $cargo      = trim($_POST['cargo'] ?? 'Vendedor');
            $telefono   = trim($_POST['telefono'] ?? '');

            if (empty($nombres) || empty($apellidos) || empty($usuario)) {
                $error = "Complete los campos obligatorios.";
            } else {
                if ($this->empleadoModel->actualizar($id, $nombres, $apellidos, $usuario, $rol, $cargo, $telefono, $contrasena)) {
                    header('Location: index.php?action=empleados&msg=actualizado');
                    exit();
                } else {
                    $error = "Error al actualizar la información del empleado.";
                }
            }
        }

        require_once __DIR__ . '/../views/empleados/editar.php';
    }

    public function eliminar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->empleadoModel->eliminar($id);
        }
        header('Location: index.php?action=empleados&msg=eliminado');
        exit();
    }
}