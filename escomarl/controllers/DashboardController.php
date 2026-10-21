<?php

require_once __DIR__ . '/../models/Producto.php';

class HomeController {
    private $productoModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->productoModel = new Producto();
    }

    public function index() {
        // Cargar los 3 productos más vendidos
        $masVendidos = $this->productoModel->obtenerMasVendidos(3);
        
        require_once __DIR__ . '/../views/dashboard.php'; // o views/home/index.php
    }
}