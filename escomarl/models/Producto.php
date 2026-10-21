<?php

require_once __DIR__ . '/../config/Database.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function obtenerTodos() {
        try {
            $sql = "SELECT p.IdProducto AS id, p.NombreProducto AS nombre, p.Precio AS precio_unitario, 
                           p.Stock AS stock_actual, p.Imagen AS imagen, c.NombreCategoria AS categoria 
                    FROM tblproductos p 
                    LEFT JOIN tblcategorias c ON p.IdCategoria = c.IdCategoria 
                    ORDER BY p.IdProducto DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT p.IdProducto AS id, p.NombreProducto AS nombre, p.Precio AS precio_unitario, 
                                           p.Stock AS stock_actual, p.Imagen AS imagen, p.IdCategoria, c.NombreCategoria AS categoria 
                                    FROM tblproductos p 
                                    LEFT JOIN tblcategorias c ON p.IdCategoria = c.IdCategoria 
                                    WHERE p.IdProducto = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCategorias() {
        try {
            $stmt = $this->db->query("SELECT IdCategoria AS id, NombreCategoria AS nombre FROM tblcategorias ORDER BY NombreCategoria ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Insertar con imagen
    public function crear($codigo, $nombre, $categoria_id, $unidad_medida, $stock_actual, $stock_minimo, $precio_unitario, $imagen = 'default.jpg') {
        $sql = "INSERT INTO tblproductos (NombreProducto, IdCategoria, Precio, Stock, Imagen) 
                VALUES (:nombre, :categoria_id, :precio, :stock, :imagen)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'       => $nombre,
            ':categoria_id' => $categoria_id,
            ':precio'       => $precio_unitario,
            ':stock'        => $stock_actual,
            ':imagen'       => $imagen
        ]);
    }

    // Actualizar con opción de nueva imagen
    public function actualizar($id, $codigo, $nombre, $categoria_id, $unidad_medida, $stock_actual, $stock_minimo, $precio_unitario, $imagen = null) {
        if (!empty($imagen)) {
            $sql = "UPDATE tblproductos 
                    SET NombreProducto = :nombre, 
                        IdCategoria = :categoria_id, 
                        Precio = :precio, 
                        Stock = :stock,
                        Imagen = :imagen 
                    WHERE IdProducto = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id'           => $id,
                ':nombre'       => $nombre,
                ':categoria_id' => $categoria_id,
                ':precio'       => $precio_unitario,
                ':stock'        => $stock_actual,
                ':imagen'       => $imagen
            ]);
        } else {
            $sql = "UPDATE tblproductos 
                    SET NombreProducto = :nombre, 
                        IdCategoria = :categoria_id, 
                        Precio = :precio, 
                        Stock = :stock 
                    WHERE IdProducto = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id'           => $id,
                ':nombre'       => $nombre,
                ':categoria_id' => $categoria_id,
                ':precio'       => $precio_unitario,
                ':stock'        => $stock_actual
            ]);
        }
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM tblproductos WHERE IdProducto = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Obtener los productos más vendidos según el historial de detalle de facturas
    public function obtenerMasVendidos($limit = 3) {
        try {
            $sql = "SELECT p.IdProducto AS id, 
                           p.NombreProducto AS nombre, 
                           p.Precio AS precio_unitario, 
                           p.Imagen AS imagen,
                           COALESCE(SUM(df.Cantidad), 0) AS total_vendidos
                    FROM tblproductos p
                    INNER JOIN tbldetallefactura df ON p.IdProducto = df.IdProducto
                    INNER JOIN tblfacturas f ON df.IdFactura = f.IdFactura
                    WHERE COALESCE(f.Estado, 'Activa') = 'Activa'
                    GROUP BY p.IdProducto, p.NombreProducto, p.Precio, p.Imagen
                    ORDER BY total_vendidos DESC
                    LIMIT :limit";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            $topProductos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Si no hay suficientes ventas aún, rellenar con los primeros productos del catálogo
            if (count($topProductos) < $limit) {
                $idsExistentes = array_column($topProductos, 'id');
                $faltantes = $limit - count($topProductos);

                $whereNotIn = !empty($idsExistentes) ? "WHERE IdProducto NOT IN (" . implode(',', $idsExistentes) . ")" : "";
                $sqlFallback = "SELECT IdProducto AS id, NombreProducto AS nombre, Precio AS precio_unitario, Imagen AS imagen, 0 AS total_vendidos 
                                FROM tblproductos $whereNotIn LIMIT $faltantes";
                
                $stmtFallback = $this->db->query($sqlFallback);
                $productosFallback = $stmtFallback->fetchAll(PDO::FETCH_ASSOC);
                $topProductos = array_merge($topProductos, $productosFallback);
            }

            return $topProductos;
        } catch (Exception $e) {
            return $this->obtenerTodos();
        }
    }
}