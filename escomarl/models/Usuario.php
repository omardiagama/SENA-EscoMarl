<?php

require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        
        if (method_exists($database, 'obtenerConexion')) {
            $this->db = $database->obtenerConexion();
        } elseif (method_exists($database, 'getConexion')) {
            $this->db = $database->getConexion();
        } elseif (method_exists($database, 'getConnection')) {
            $this->db = $database->getConnection();
        } elseif (isset($database->conn)) {
            $this->db = $database->conn;
        } else {
            $this->db = $database;
        }
    }

    private function obtenerRolId($rolNombre)
    {
        return (strcasecmp($rolNombre, 'Administrador') === 0) ? 1 : 2;
    }

    private function obtenerNombreRol($rolId)
    {
        return ($rolId == 1) ? 'Administrador' : 'Empleado';
    }

    public function obtenerPorEmail($email)
    {
        $query = "SELECT id, nombre, email, password, rol_id FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $usuario['rol'] = $this->obtenerNombreRol($usuario['rol_id']);
        }

        return $usuario;
    }

    public function obtenerTodos()
    {
        $query = "SELECT id, nombre, email, rol_id FROM usuarios ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as &$u) {
            $u['rol'] = $this->obtenerNombreRol($u['rol_id']);
        }

        return $usuarios;
    }

    public function obtenerPorId($id)
    {
        $query = "SELECT id, nombre, email, rol_id FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $usuario['rol'] = $this->obtenerNombreRol($usuario['rol_id']);
        }

        return $usuario;
    }

    public function crear($nombre, $email, $password, $rol = 'Empleado')
    {
        $rolId = $this->obtenerRolId($rol);

        $query = "INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (:nombre, :email, :password, :rol_id)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol_id', $rolId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function actualizar($id, $nombre, $email, $rol, $password = null)
    {
        $rolId = $this->obtenerRolId($rol);

        if (!empty($password)) {
            $query = "UPDATE usuarios SET nombre = :nombre, email = :email, password = :password, rol_id = :rol_id WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':password', $password);
        } else {
            $query = "UPDATE usuarios SET nombre = :nombre, email = :email, rol_id = :rol_id WHERE id = :id";
            $stmt = $this->db->prepare($query);
        }

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':rol_id', $rolId, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}