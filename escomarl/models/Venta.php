<?php

require_once __DIR__ . '/../config/Database.php';

class Venta {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function obtenerTodas($periodo = 'todos', $fechaEspecifica = null) {
        try {
            $sql = "SELECT f.IdFactura AS id, 
                           f.FechaFactura AS fecha, 
                           f.TotalVenta AS total, 
                           COALESCE(f.Estado, 'Activa') AS estado,
                           COALESCE(c.NombreCompleto, 'Consumidor Final') AS cliente_nombre, 
                           COALESCE(e.Nombres, 'Administrador') AS empleado_nombre
                    FROM tblfacturas f
                    LEFT JOIN tblclientes c ON f.IdCliente = c.IdCliente
                    LEFT JOIN tblempleados e ON f.IdEmpleado = e.IdEmpleado";

            $where = [];
            $params = [];

            if ($periodo === 'diario') {
                $fecha = $fechaEspecifica ?? date('Y-m-d');
                $where[] = "DATE(f.FechaFactura) = :fecha";
                $params[':fecha'] = $fecha;
            } elseif ($periodo === 'mensual') {
                $mes = $fechaEspecifica ?? date('Y-m');
                $where[] = "DATE_FORMAT(f.FechaFactura, '%Y-%m') = :mes";
                $params[':mes'] = $mes;
            } elseif ($periodo === 'anual') {
                $anio = $fechaEspecifica ?? date('Y');
                $where[] = "YEAR(f.FechaFactura) = :anio";
                $params[':anio'] = $anio;
            }

            if (!empty($where)) {
                $sql .= " WHERE " . implode(' AND ', $where);
            }

            $sql .= " ORDER BY f.IdFactura DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function inhabilitar($idFactura) {
        try {
            $sql = "UPDATE tblfacturas SET Estado = 'Inhabilitada' WHERE IdFactura = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $idFactura]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function habilitar($idFactura) {
        try {
            $sql = "UPDATE tblfacturas SET Estado = 'Activa' WHERE IdFactura = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $idFactura]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerEmpleadoValido() {
        try {
            $stmt = $this->db->query("SELECT IdEmpleado FROM tblempleados LIMIT 1");
            $emp = $stmt->fetch(PDO::FETCH_ASSOC);
            return $emp ? $emp['IdEmpleado'] : null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function crear($idCliente, $idEmpleado, $idProducto, $cantidad, $precioAplicado, $totalVenta, &$errorOut = null) {
        try {
            $this->db->beginTransaction();

            $sqlFactura = "INSERT INTO tblfacturas (IdCliente, IdEmpleado, FechaFactura, TotalVenta, Estado) 
                           VALUES (:cliente, :empleado, NOW(), :total, 'Activa')";
            $stmtFactura = $this->db->prepare($sqlFactura);
            $stmtFactura->execute([
                ':cliente'  => $idCliente,
                ':empleado' => $idEmpleado,
                ':total'    => $totalVenta
            ]);

            $idFactura = $this->db->lastInsertId();

            $sqlDetalle = "INSERT INTO tbldetallefactura (IdFactura, IdProducto, Cantidad, PrecioAplicado) 
                           VALUES (:factura, :producto, :cantidad, :precio)";
            $stmtDetalle = $this->db->prepare($sqlDetalle);
            $stmtDetalle->execute([
                ':factura'  => $idFactura,
                ':producto' => $idProducto,
                ':cantidad' => $cantidad,
                ':precio'   => $precioAplicado
            ]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            $errorOut = $e->getMessage();
            return false;
        }
    }
}