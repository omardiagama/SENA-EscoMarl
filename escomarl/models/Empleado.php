<?php

require_once __DIR__ . '/../config/Database.php';

class Empleado {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Obtener todos los empleados
    public function obtenerTodos() {
        try {
            $stmt = $this->db->query("SELECT IdEmpleado AS id, Nombres, Apellidos, Usuario, Rol, Cargo, Telefono FROM tblempleados ORDER BY IdEmpleado DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Obtener un empleado por ID
    public function obtenerPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT IdEmpleado AS id, Nombres, Apellidos, Usuario, Rol, Cargo, Telefono FROM tblempleados WHERE IdEmpleado = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    // Crear empleado en tblempleados Y automáticamente en usuarios
    public function crear($nombres, $apellidos, $usuario, $contrasena, $rol, $cargo, $telefono) {
        try {
            $this->db->beginTransaction();

            // 1. Insertar en tblempleados
            $sqlEmp = "INSERT INTO tblempleados (Nombres, Apellidos, Usuario, Contrasena, Rol, Cargo, Telefono) 
                       VALUES (:nombres, :apellidos, :usuario, :contrasena, :rol, :cargo, :telefono)";
            $stmtEmp = $this->db->prepare($sqlEmp);
            $stmtEmp->execute([
                ':nombres'    => $nombres,
                ':apellidos'  => $apellidos,
                ':usuario'    => $usuario,
                ':contrasena' => $contrasena,
                ':rol'        => $rol,
                ':cargo'      => $cargo,
                ':telefono'   => $telefono
            ]);

            // 2. Insertar automáticamente en la tabla usuarios para el Login
            $nombreCompleto = trim($nombres . ' ' . $apellidos);
            $rolId = (strtolower($rol) === 'administrador') ? 1 : 2;

            $sqlUser = "INSERT INTO usuarios (nombre, email, password, rol_id) 
                        VALUES (:nombre, :email, :password, :rol_id)";
            $stmtUser = $this->db->prepare($sqlUser);
            $stmtUser->execute([
                ':nombre'   => $nombreCompleto,
                ':email'    => $usuario,
                ':password' => $contrasena,
                ':rol_id'   => $rolId
            ]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }

    // Actualizar empleado en tblempleados Y sincronizar en usuarios
    public function actualizar($id, $nombres, $apellidos, $usuario, $rol, $cargo, $telefono, $contrasena = null) {
        try {
            $this->db->beginTransaction();

            // Obtener el usuario anterior para buscarlo en la tabla 'usuarios' por su correo/email anterior
            $empAnt = $this->obtenerPorId($id);
            $usuarioAnterior = $empAnt['Usuario'] ?? '';

            // 1. Actualizar tblempleados
            if (!empty($contrasena)) {
                $sqlEmp = "UPDATE tblempleados 
                           SET Nombres = :nombres, Apellidos = :apellidos, Usuario = :usuario, Contrasena = :contrasena, Rol = :rol, Cargo = :cargo, Telefono = :telefono 
                           WHERE IdEmpleado = :id";
                $stmtEmp = $this->db->prepare($sqlEmp);
                $stmtEmp->execute([
                    ':id' => $id, ':nombres' => $nombres, ':apellidos' => $apellidos, ':usuario' => $usuario, ':contrasena' => $contrasena, ':rol' => $rol, ':cargo' => $cargo, ':telefono' => $telefono
                ]);
            } else {
                $sqlEmp = "UPDATE tblempleados 
                           SET Nombres = :nombres, Apellidos = :apellidos, Usuario = :usuario, Rol = :rol, Cargo = :cargo, Telefono = :telefono 
                           WHERE IdEmpleado = :id";
                $stmtEmp = $this->db->prepare($sqlEmp);
                $stmtEmp->execute([
                    ':id' => $id, ':nombres' => $nombres, ':apellidos' => $apellidos, ':usuario' => $usuario, ':rol' => $rol, ':cargo' => $cargo, ':telefono' => $telefono
                ]);
            }

            // 2. Sincronizar en la tabla usuarios
            $nombreCompleto = trim($nombres . ' ' . $apellidos);
            $rolId = (strtolower($rol) === 'administrador') ? 1 : 2;

            if (!empty($contrasena)) {
                $sqlUser = "UPDATE usuarios 
                            SET nombre = :nombre, email = :email, password = :password, rol_id = :rol_id 
                            WHERE email = :usuario_ant";
                $stmtUser = $this->db->prepare($sqlUser);
                $stmtUser->execute([
                    ':nombre'      => $nombreCompleto,
                    ':email'       => $usuario,
                    ':password'    => $contrasena,
                    ':rol_id'      => $rolId,
                    ':usuario_ant' => $usuarioAnterior
                ]);
            } else {
                $sqlUser = "UPDATE usuarios 
                            SET nombre = :nombre, email = :email, rol_id = :rol_id 
                            WHERE email = :usuario_ant";
                $stmtUser = $this->db->prepare($sqlUser);
                $stmtUser->execute([
                    ':nombre'      => $nombreCompleto,
                    ':email'       => $usuario,
                    ':rol_id'      => $rolId,
                    ':usuario_ant' => $usuarioAnterior
                ]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }

    // Eliminar empleado de tblempleados Y de usuarios
    public function eliminar($id) {
        try {
            $this->db->beginTransaction();

            $emp = $this->obtenerPorId($id);
            $usuarioEmail = $emp['Usuario'] ?? '';

            // 1. Eliminar de tblempleados
            $stmt1 = $this->db->prepare("DELETE FROM tblempleados WHERE IdEmpleado = :id");
            $stmt1->execute([':id' => $id]);

            // 2. Eliminar de usuarios
            if (!empty($usuarioEmail)) {
                $stmt2 = $this->db->prepare("DELETE FROM usuarios WHERE email = :email");
                $stmt2->execute([':email' => $usuarioEmail]);
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            return false;
        }
    }
}