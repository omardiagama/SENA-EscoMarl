<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $clienteModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->clienteModel = new Cliente();
    }

    public function index() {
        $clientes = $this->clienteModel->obtenerTodos();
        require_once __DIR__ . '/../views/clientes/index.php';
    }

    public function crear() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $documento = trim($_POST['documento'] ?? '');
            $nombre = trim($_POST['nombreCompleto'] ?? '');
            $celular = trim($_POST['celular'] ?? '');
            $correo = trim($_POST['correo'] ?? '');

            if (empty($documento) || empty($nombre)) {
                $error = "El documento y el nombre completo son obligatorios.";
            } else {
                if ($this->clienteModel->crear($documento, $nombre, $celular, $correo)) {
                    header('Location: index.php?action=clientes&msg=creado');
                    exit();
                } else {
                    $error = "No se pudo registrar el cliente. Verifique si el documento ya existe.";
                }
            }
        }

        require_once __DIR__ . '/../views/clientes/crear.php';
    }

    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $cliente = $this->clienteModel->obtenerPorId($id);

        if (!$cliente) {
            header('Location: index.php?action=clientes');
            exit();
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $documento = trim($_POST['documento'] ?? '');
            $nombre = trim($_POST['nombreCompleto'] ?? '');
            $celular = trim($_POST['celular'] ?? '');
            $correo = trim($_POST['correo'] ?? '');

            if (empty($documento) || empty($nombre)) {
                $error = "El documento y el nombre completo son obligatorios.";
            } else {
                if ($this->clienteModel->actualizar($id, $documento, $nombre, $celular, $correo)) {
                    header('Location: index.php?action=clientes&msg=actualizado');
                    exit();
                } else {
                    $error = "Error al actualizar la información del cliente.";
                }
            }
        }

        require_once __DIR__ . '/../views/clientes/editar.php';
    }
}