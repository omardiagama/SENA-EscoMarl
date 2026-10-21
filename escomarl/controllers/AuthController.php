<?php

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    private $usuarioModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->usuarioModel = new Usuario();
    }

    public function mostrarLogin()
    {
        if (isset($_SESSION['usuario']) || isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=dashboard');
            exit();
        }

        require_once __DIR__ . '/../views/auth/Login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Por favor ingrese usuario y contraseña.";
                require_once __DIR__ . '/../views/auth/Login.php';
                return;
            }

            $usuario = $this->usuarioModel->obtenerPorEmail($email);

            if ($usuario && $usuario['password'] === $password) {
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['usuario_rol'] = $usuario['rol'];

                // Redirección directa al Dashboard
                header('Location: index.php?action=dashboard');
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require_once __DIR__ . '/../views/auth/Login.php';
                return;
            }
        } else {
            $this->mostrarLogin();
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();

        header('Location: index.php?action=login');
        exit();
    }
}