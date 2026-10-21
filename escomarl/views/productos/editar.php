<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">EDITAR PRODUCTO</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Modificar información de inventario, precios e imágenes en <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=productos" style="padding: 8px 14px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.8rem;">
        ← Volver al Catálogo
    </a>
</div>

<!-- Mensaje de Error (si existe) -->
<?php if (!empty($error)): ?>
    <div style="background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 20px; font-size: 0.9rem;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Formulario de Edición con multipart/form-data -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 25px; color: #ffffff; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.4);">
    
    <form action="index.php?action=productos_editar&id=<?= $producto['id'] ?? $producto['IdProducto'] ?>" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
        
        <input type="hidden" name="codigo" value="PROD-001">
        <input type="hidden" name="unidad_medida" value="Unid">

        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Nombre del Producto / Fragancia *</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre'] ?? $producto['NombreProducto'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Categoría *</label>
            <select name="categoria_id" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                <option value="">-- Seleccionar Categoría --</option>
                <?php 
                    $catActual = $producto['IdCategoria'] ?? $producto['categoria_id'] ?? 1;
                    if (!empty($categorias)): 
                ?>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?? $cat['IdCategoria'] ?>" <?= ($catActual == ($cat['id'] ?? $cat['IdCategoria'])) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nombre'] ?? $cat['NombreCategoria']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1" <?= ($catActual == 1) ? 'selected' : '' ?>>Esencias</option>
                    <option value="2" <?= ($catActual == 2) ? 'selected' : '' ?>>Frascos</option>
                    <option value="3" <?= ($catActual == 3) ? 'selected' : '' ?>>Gotas / Feromonas</option>
                <?php endif; ?>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Precio ($) *</label>
                <input type="number" step="100" name="precio_unitario" value="<?= (float)($producto['precio_unitario'] ?? $producto['Precio'] ?? 0) ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Stock Disponible *</label>
                <input type="number" name="stock_actual" value="<?= (int)($producto['stock_actual'] ?? $producto['Stock'] ?? 0) ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
        </div>

        <!-- Vista Previa de la Imagen Actual y Carga del Nuevo Archivo -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Imagen del Producto</label>
            
            <?php 
                $imgNombre = $producto['imagen'] ?? $producto['Imagen'] ?? '';
                if (!empty($imgNombre)): 
            ?>
                <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 12px; background-color: #051c05; padding: 10px; border-radius: 6px; border: 1px solid #2d5a31;">
                    <img src="assets/img/<?= htmlspecialchars($imgNombre) ?>" 
                         alt="Imagen Actual" 
                         style="width: 55px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #84cc16;"
                         onerror="this.src='https://via.placeholder.com/55?text=Sin+Imagen';">
                    <div>
                        <span style="font-size: 0.85rem; color: #d9f99d; display: block; font-weight: bold;">Imagen cargada:</span>
                        <span style="font-size: 0.75rem; color: #a3e635;"><?= htmlspecialchars($imgNombre) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <input type="file" name="imagen" accept="image/*" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.85rem; box-sizing: border-box;">
            <small style="color: #a3e635; font-size: 0.75rem; margin-top: 4px; display: block;">Seleccione un nuevo archivo únicamente si desea reemplazar la imagen actual.</small>
        </div>

        <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="index.php?action=productos" style="padding: 10px 18px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem;">Cancelar</a>
            <button type="submit" style="padding: 10px 20px; background-color: #84cc16; color: #051c05; border: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                💾 Actualizar Producto
            </button>
        </div>

    </form>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>