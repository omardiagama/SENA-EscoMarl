<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase;">CATÁLOGO DE PRODUCTOS E INSUMOS</h2>
        <p style="color: #333; font-size: 0.9rem; margin-top: 4px;">Inventario de esencias, frascos y productos terminados de <strong>Esencia & co.</strong></p>
    </div>
    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'Administrador'): ?>
        <a href="index.php?action=productos_crear" style="padding: 10px 18px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
            + AGREGAR PRODUCTO
        </a>
    <?php endif; ?>
</div>

<!-- Filtros de Categorías (Barra Horizontal Superior) -->
<div style="background-color: rgba(15, 30, 18, 0.95); border: 1px solid #2d5a31; border-radius: 6px; padding: 12px 20px; display: flex; align-items: center; gap: 20px; margin-bottom: 25px;">
    <span style="color: #a3e635; font-weight: bold; font-size: 0.85rem;">FILTRAR POR:</span>
    <a href="index.php?action=productos" style="color: #d9f99d; text-decoration: none; font-size: 0.85rem; font-weight: bold;">TODOS</a>
    <a href="index.php?action=productos&cat=esencias" style="color: #d9f99d; text-decoration: none; font-size: 0.85rem; font-weight: bold;">ESENCIAS</a>
    <a href="index.php?action=productos&cat=frascos" style="color: #d9f99d; text-decoration: none; font-size: 0.85rem; font-weight: bold;">FRASCOS</a>
    <a href="index.php?action=productos&cat=feromonas" style="color: #d9f99d; text-decoration: none; font-size: 0.85rem; font-weight: bold;">GOTAS FEROMONAS</a>
</div>

<!-- Grilla del Catálogo -->
<div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 20px; margin-bottom: 30px;">

    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $p): ?>
            <div style="background-color: rgba(15, 30, 18, 0.92); border: 1px solid #2d5a31; border-radius: 8px; padding: 16px; text-align: center; color: #ffffff;">
                <div style="height: 160px; background-color: #051c05; border-radius: 6px; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
    <img src="assets/img/<?= !empty($p['imagen']) ? htmlspecialchars($p['imagen']) : 'default.jpg' ?>" 
         alt="<?= htmlspecialchars($p['nombre']) ?>" 
         style="max-width: 100%; max-height: 100%; object-fit: cover;"
         onerror="this.src='https://via.placeholder.com/180x160?text=Sin+Imagen';">
</div>
                
                <h3 style="color: #d9f99d; font-size: 1.05rem; margin-bottom: 6px;"><?= htmlspecialchars($p['nombre']) ?></h3>
                
                <p style="color: #a3e635; font-size: 1.15rem; font-weight: bold; margin-bottom: 8px;">
                    $<?= number_format($p['precio_unitario'] ?? $p['precio'] ?? 0, 0, ',', '.') ?>
                </p>

                <div style="margin-bottom: 12px;">
                    <span style="font-size: 0.75rem; color: #d9f99d; background-color: #2d5a31; padding: 3px 8px; border-radius: 4px;">
                        Stock: <?= number_format($p['stock_actual'] ?? $p['stock'] ?? 0, 0) ?> <?= htmlspecialchars($p['unidad_medida'] ?? 'Unid') ?>
                    </span>
                </div>

               <!-- Botones de Acción (Sin Carrito) -->
                <div style="display: flex; gap: 6px; justify-content: center; margin-top: 10px;">
                    <a href="index.php?action=productos_editar&id=<?= $p['id'] ?>" style="flex: 1; padding: 6px 10px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: bold; text-align: center;">Editar</a>
                    
                    <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'Administrador'): ?>
                        <a href="index.php?action=productos_eliminar&id=<?= $p['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar este producto?');" style="padding: 6px 10px; background-color: #7f1d1d; color: #fca5a5; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">✕</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div style="grid-column: 1 / -1; background-color: rgba(15, 30, 18, 0.92); border: 1px solid #2d5a31; border-radius: 8px; padding: 30px; text-align: center; color: #d9f99d;">
            <p style="font-size: 1.1rem; margin: 0;">No se encontraron productos registrados en esta categoría.</p>
        </div>
    <?php endif; ?>

</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>