<?php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Venta.php';

class VentaController {
    private $productoModel;
    private $clienteModel;
    private $ventaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->productoModel = new Producto();
        $this->clienteModel  = new Cliente();
        $this->ventaModel    = new Venta();
    }

    public function index() {
        $periodo = $_GET['periodo'] ?? 'todos';
        $fecha   = $_GET['fecha'] ?? null;

        $ventas = $this->ventaModel->obtenerTodas($periodo, $fecha);
        
        require_once __DIR__ . '/../views/ventas/index.php';
    }

    public function inhabilitar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->ventaModel->inhabilitar($id);
        }
        $periodo = $_GET['periodo'] ?? 'todos';
        header("Location: index.php?action=ventas&periodo={$periodo}&msg=inhabilitada");
        exit();
    }

    public function habilitar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->ventaModel->habilitar($id);
        }
        $periodo = $_GET['periodo'] ?? 'todos';
        header("Location: index.php?action=ventas&periodo={$periodo}&msg=habilitada");
        exit();
    }

    public function crear() {
        $error = null;
        $productos = $this->productoModel->obtenerTodos();
        $clientes  = $this->clienteModel->obtenerTodos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_id  = (int)($_POST['cliente_id'] ?? 1);
            $producto_id = (int)($_POST['producto_id'] ?? 0);
            $cantidad    = (int)($_POST['cantidad'] ?? 1);
            $empleado_id = $this->ventaModel->obtenerEmpleadoValido();

            if (!$empleado_id) {
                $error = "No se encontró ningún empleado registrado en la tabla tblempleados.";
            } elseif ($producto_id > 0 && $cantidad > 0) {
                $producto = $this->productoModel->obtenerPorId($producto_id);
                
                if ($producto) {
                    $precioUnitario = (float)($producto['precio_unitario'] ?? $producto['Precio'] ?? 0);
                    $totalVenta     = $precioUnitario * $cantidad;
                    $stockActual    = (int)($producto['stock_actual'] ?? $producto['Stock'] ?? 0);

                    if ($stockActual < $cantidad) {
                        $error = "Stock insuficiente. Solo quedan " . $stockActual . " unidades.";
                    } else {
                        $detalleError = "";
                        $registroExitoso = $this->ventaModel->crear(
                            $cliente_id, 
                            $empleado_id, 
                            $producto_id, 
                            $cantidad, 
                            $precioUnitario, 
                            $totalVenta,
                            $detalleError
                        );

                        if ($registroExitoso) {
                            $nuevoStock = $stockActual - $cantidad;
                            $this->productoModel->actualizar(
                                $producto_id, 
                                'PROD', 
                                $producto['nombre'] ?? $producto['NombreProducto'], 
                                1, 
                                'Unid', 
                                $nuevoStock, 
                                5, 
                                $precioUnitario
                            );

                            header('Location: index.php?action=ventas&msg=registrada');
                            exit();
                        } else {
                            $error = "Falló la venta. " . $detalleError;
                        }
                    }
                } else {
                    $error = "El producto seleccionado no existe.";
                }
            } else {
                $error = "Selecciona un producto y cantidad válidos.";
            }
        }

        require_once __DIR__ . '/../views/ventas/crear.php';
    }
}