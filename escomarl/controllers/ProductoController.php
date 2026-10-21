<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->productoModel = new Producto();
    }

    public function index() {
        $productos = $this->productoModel->obtenerTodos();
        $categoriaFiltro = $_GET['cat'] ?? null;
        if ($categoriaFiltro && !empty($productos)) {
            $productos = array_filter($productos, function($p) use ($categoriaFiltro) {
                $nombreCat = mb_strtolower($p['categoria'] ?? '');
                return strpos($nombreCat, mb_strtolower($categoriaFiltro)) !== false;
            });
        }
        require_once __DIR__ . '/../views/productos/index.php';
    }

    public function crear() {
        $categorias = $this->productoModel->obtenerCategorias();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $categoria_id = (int)($_POST['categoria_id'] ?? 0);
            $precio_unitario = (float)($_POST['precio_unitario'] ?? 0);
            $stock_actual = (int)($_POST['stock_actual'] ?? 0);

            // Manejo de la subida de imagen
            $nombreImagen = 'default.jpg';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombreImagen = time() . '_' . uniqid() . '.' . $ext;
                $dirDestino = __DIR__ . '/../assets/img/';
                
                if (!is_dir($dirDestino)) {
                    mkdir($dirDestino, 0777, true);
                }
                move_uploaded_file($_FILES['imagen']['tmp_name'], $dirDestino . $nombreImagen);
            }

            if (empty($nombre) || $categoria_id === 0) {
                $error = "Por favor complete todos los campos requeridos.";
            } else {
                if ($this->productoModel->crear('PROD', $nombre, $categoria_id, 'Unid', $stock_actual, 5, $precio_unitario, $nombreImagen)) {
                    header('Location: index.php?action=productos&msg=creado');
                    exit;
                } else {
                    $error = "Error al guardar el producto en la base de datos.";
                }
            }
        }
        require_once __DIR__ . '/../views/productos/crear.php';
    }

    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);

        if (!$producto) {
            header('Location: index.php?action=productos');
            exit;
        }

        $categorias = $this->productoModel->obtenerCategorias();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $categoria_id = (int)($_POST['categoria_id'] ?? 0);
            $precio_unitario = (float)($_POST['precio_unitario'] ?? 0);
            $stock_actual = (int)($_POST['stock_actual'] ?? 0);

            // Manejo de carga de nueva imagen
            $nombreImagen = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

                if (in_array($ext, $extensionesPermitidas)) {
                    $nombreImagen = time() . '_' . uniqid() . '.' . $ext;
                    $dirDestino = __DIR__ . '/../assets/img/';

                    if (!is_dir($dirDestino)) {
                        mkdir($dirDestino, 0777, true);
                    }

                    move_uploaded_file($_FILES['imagen']['tmp_name'], $dirDestino . $nombreImagen);
                }
            }

            if (empty($nombre) || $categoria_id === 0) {
                $error = "Complete todos los campos obligatorios.";
            } else {
                if ($this->productoModel->actualizar($id, 'PROD', $nombre, $categoria_id, 'Unid', $stock_actual, 5, $precio_unitario, $nombreImagen)) {
                    header('Location: index.php?action=productos&msg=actualizado');
                    exit;
                } else {
                    $error = "Error al guardar los cambios en la base de datos.";
                }
            }
        }
        require_once __DIR__ . '/../views/productos/editar.php';
    }

    public function eliminar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->productoModel->eliminar($id);
        }
        header('Location: index.php?action=productos&msg=eliminado');
        exit;
    }
}