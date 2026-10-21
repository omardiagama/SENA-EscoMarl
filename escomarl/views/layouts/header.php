<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) && !isset($_SESSION['usuario_id'])) {
    header("Location: index.php?action=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esencia & Co. - EscoMarl</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body style="background-color: #f4f6f0; background-image: url('public/img/fondo_general.png'); background-size: cover; background-attachment: fixed; background-position: center; margin: 0; padding: 0;">

    <!-- Banner Marca Esencia & Co. (Fondo verde oscuro profundo) -->
    <div class="brand-header" style="background-color: #0f1e12; color: #ffffff; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1a381d;">
        <div class="brand-title">
            <h1 style="margin: 0; font-size: 2.2rem; color: #d9f99d; font-family: 'Playfair Display', serif, Georgia;">Esencia & co.</h1>
            <div class="brand-subtitle" style="font-size: 0.85rem; color: #a3e635; letter-spacing: 1px;">aromas inspirados</div>
        </div>
        <div class="brand-badge" style="background-color: #84cc16; color: #051c05; padding: 4px 12px; border-radius: 4px; font-weight: bold; font-size: 0.85rem;">
            EscoMarl
        </div>
    </div>

    <!-- Menú de Navegación Superior -->
   <!-- Menú de Navegación Superior -->
    <nav style="background-color: #0b170e; display: flex; justify-content: space-between; align-items: center; padding: 10px 25px; border-bottom: 2px solid #84cc16;">
        <div style="display: flex; gap: 18px; align-items: center;">
            <a href="index.php?action=dashboard" style="color: #a3e635; text-decoration: none; font-weight: bold; font-size: 0.9rem;">PANEL PRINCIPAL</a>
            <a href="index.php?action=productos" style="color: #d9f99d; text-decoration: none; font-weight: bold; font-size: 0.9rem;">PRODUCTOS</a>
            <a href="index.php?action=ventas" style="color: #d9f99d; text-decoration: none; font-weight: bold; font-size: 0.9rem;">VENTAS</a>
            <a href="index.php?action=clientes" style="color: #d9f99d; text-decoration: none; font-weight: bold; font-size: 0.9rem;">CLIENTES</a>
            <a href="index.php?action=empleados" style="color: #d9f99d; text-decoration: none; font-weight: bold; font-size: 0.9rem;">PORTAL EMPLEADOS</a>
        </div>
        
        <div>
            <a href="index.php?action=logout" style="color: #ff6b6b; text-decoration: none; font-weight: bold; font-size: 0.9rem;">CERRAR SESIÓN</a>
        </div>
    </nav>

    <!-- Contenedor General -->
    <div class="app-container" style="display: block; padding: 20px 30px;">