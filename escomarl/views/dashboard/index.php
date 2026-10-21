<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px;">
    <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">PANEL DE CONTROL</h2>
    <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Bienvenido al sistema de gestión de <strong>Esencia & co. - EscoMarl</strong></p>
</div>

<!-- Tarjetas Principales de Módulos -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; margin-bottom: 25px;">
    
    <!-- Módulo Productos -->
    <div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 18px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3 style="color: #84cc16; font-size: 1.1rem; margin: 0 0 6px 0; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                🧴 PRODUCTOS
            </h3>
            <p style="color: #d1d5db; font-size: 0.85rem; margin: 0 0 15px 0;">Gestión de esencias, frascos e inventario.</p>
        </div>
        <a href="index.php?action=productos" style="display: inline-block; padding: 8px 14px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.85rem; text-align: center; width: fit-content;">
            Ver Catálogo
        </a>
    </div>

    <!-- Módulo Ventas -->
    <div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 18px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3 style="color: #84cc16; font-size: 1.1rem; margin: 0 0 6px 0; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                🛍️ VENTAS
            </h3>
            <p style="color: #d1d5db; font-size: 0.85rem; margin: 0 0 15px 0;">Registro de pedidos y facturación.</p>
        </div>
        <a href="index.php?action=ventas" style="display: inline-block; padding: 8px 14px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.85rem; text-align: center; width: fit-content;">
            Ir a Ventas
        </a>
    </div>

    <!-- Módulo Clientes -->
    <div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 18px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3 style="color: #84cc16; font-size: 1.1rem; margin: 0 0 6px 0; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                👥 CLIENTES
            </h3>
            <p style="color: #d1d5db; font-size: 0.85rem; margin: 0 0 15px 0;">Base de datos e historial de clientes.</p>
        </div>
        <a href="index.php?action=clientes" style="display: inline-block; padding: 8px 14px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.85rem; text-align: center; width: fit-content;">
            Gestionar Clientes
        </a>
    </div>

    <!-- Módulo Empleados -->
    <div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 18px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3 style="color: #84cc16; font-size: 1.1rem; margin: 0 0 6px 0; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                💼 EMPLEADOS
            </h3>
            <p style="color: #d1d5db; font-size: 0.85rem; margin: 0 0 15px 0;">Control de personal y permisos de acceso.</p>
        </div>
        <a href="index.php?action=empleados" style="display: inline-block; padding: 8px 14px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.85rem; text-align: center; width: fit-content;">
            Ver Empleados
        </a>
    </div>

</div>

<!-- Barra de Categorías -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 6px; padding: 12px 20px; margin-bottom: 30px; display: flex; align-items: center; gap: 20px;">
    <span style="color: #84cc16; font-weight: 800; font-size: 0.85rem; text-transform: uppercase;">CATEGORÍAS:</span>
    <div style="display: flex; gap: 15px;">
        <a href="index.php?action=productos&cat=esencias" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 0.85rem;">ESENCIAS</a>
        <a href="index.php?action=productos&cat=frascos" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 0.85rem;">FRASCOS</a>
        <a href="index.php?action=productos&cat=gotas" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 0.85rem;">GOTAS FEROMONAS</a>
    </div>
</div>

<!-- Sección Dinámica: Nuestras Esencias Más Vendidas -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px;">
    <h2 style="color: #1a381d; font-size: 1.5rem; margin: 0; text-transform: uppercase; font-weight: 800;">
        NUESTRAS ESENCIAS MÁS VENDIDAS
    </h2>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">
    <?php if (!empty($masVendidos)): ?>
        <?php foreach ($masVendidos as $index => $prod): 
            $puesto = $index + 1;
            $nombre = $prod['nombre'] ?? $prod['NombreProducto'] ?? 'Producto';
            $precio = (float)($prod['precio_unitario'] ?? $prod['Precio'] ?? 0);
            $img = $prod['imagen'] ?? $prod['Imagen'] ?? 'default.jpg';
            $vendidos = $prod['total_vendidos'] ?? 0;
        ?>
            <div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 10px; padding: 15px; text-align: center; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
                
                <!-- Imagen del Producto -->
                <div style="height: 180px; background-color: #051c05; border-radius: 8px; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 5px;">
                    <img src="assets/img/<?= htmlspecialchars($img) ?>" 
                         alt="<?= htmlspecialchars($nombre) ?>" 
                         style="max-width: 100%; max-height: 100%; object-fit: contain;"
                         onerror="this.src='https://via.placeholder.com/180x180?text=Sin+Imagen';">
                </div>

                <!-- Detalles y Rank -->
                <div>
                    <h3 style="color: #ffffff; font-size: 1.1rem; margin: 5px 0; font-weight: bold;">
                        <?= htmlspecialchars($nombre) ?>
                    </h3>
                    
                    <p style="color: #84cc16; font-size: 1.25rem; font-weight: 800; margin: 4px 0;">
                        $<?= number_format($precio, 0, ',', '.') ?>
                    </p>

                    <div style="margin-top: 10px; background-color: #84cc16; color: #051c05; font-size: 0.8rem; font-weight: 800; padding: 8px; border-radius: 5px; text-transform: uppercase;">
                        Top #<?= $puesto ?> Más Vendido <?= $vendidos > 0 ? "({$vendidos} unids)" : "" ?>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #1a381d; font-weight: bold;">No hay ventas registradas aún para calcular los más vendidos.</p>
    <?php endif; ?>
</div>

</div> <!-- Cierre del app-container principal -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>