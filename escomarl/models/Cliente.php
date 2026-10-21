<?php

require_once __DIR__ . '/../config/Database.php';

class Cliente {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los clientes
    public function obtenerTodos() {
        try {
            $stmt = $this->db->query("SELECT IdCliente AS id, Documento AS documento, NombreCompleto AS nombreCompleto, Celular AS celular, Correo AS correo FROM tblclientes ORDER BY IdCliente DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Obtener un cliente por su ID para el formulario de edicion
    public function obtenerPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT IdCliente AS id, IdCliente, Documento, NombreCompleto, Celular, Correo FROM tblclientes WHERE IdCliente = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    // Crear un nuevo cliente
    public function crear($documento, $nombreCompleto, $celular, $correo) {
        try {
            $sql = "INSERT INTO tblclientes (Documento, NombreCompleto, Celular, Correo, UltimaVisita) 
                    VALUES (:documento, :nombre, :celular, :correo, NOW())";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':documento' => $documento,
                ':nombre'    => $nombreCompleto,
                ':celular'   => $celular,
                ':correo'    => $correo
            ]);
        } catch (Exception $e) {
            return false;
        }
    }

    // Actualizar un cliente existente
    public function actualizar($id, $documento, $nombreCompleto, $celular, $correo) {
        try {
            $sql = "UPDATE tblclientes 
                    SET Documento = :documento, 
                        NombreCompleto = :nombre, 
                        Celular = :celular, 
                        Correo = :correo 
                    WHERE IdCliente = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id'        => $id,
                ':documento' => $documento,
                ':nombre'    => $nombreCompleto,
                ':celular'   => $celular,
                ':correo'    => $correo
            ]);
        } catch (Exception $e) {
            return false;
        }
    }
}