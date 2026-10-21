<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header de la vista -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase;">REGISTRAR NUEVO PRODUCTO</h2>
        <p style="color: #333; font-size: 0.9rem; margin-top: 4px;">Formulario de ingreso para esencias, frascos e insumos en <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=productos" style="padding: 8px 14px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.8rem;">
        ← Volver al Catálogo
    </a>
</div>

<!-- Mensaje de Error -->
<?php if (!empty($error)): ?>
    <div style="background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 20px; font-size: 0.9rem;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Formulario de Registro con enctype -->
<div style="background-color: rgba(15, 30, 18, 0.92); border: 1px solid #2d5a31; border-radius: 8px; padding: 25px; color: #ffffff; max-width: 600px; margin: 0 auto;">
    
    <form action="index.php?action=productos_crear" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
        
        <input type="hidden" name="codigo" value="PROD-001">
        <input type="hidden" name="unidad_medida" value="Unid">

        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Nombre del Producto / Fragancia *</label>
            <input type="text" name="nombre" required placeholder="Ej: BAHARA KING 100ml" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
        </div>

        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Categoría *</label>
            <select name="categoria_id" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                <option value="">-- Seleccionar Categoría --</option>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1">Esencias</option>
                    <option value="2">Frascos</option>
                    <option value="3">Gotas / Feromonas</option>
                <?php endif; ?>
            </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Precio ($) *</label>
                <input type="number" step="100" name="precio_unitario" required placeholder="60000" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Stock Inicial *</label>
                <input type="number" name="stock_actual" value="10" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
        </div>

        <!-- Campo Imagen -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Imagen del Producto (Opcional)</label>
            <input type="file" name="imagen" accept="image/*" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.85rem; box-sizing: border-box;">
        </div>

        <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="index.php?action=productos" style="padding: 10px 18px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem;">Cancelar</a>
            <button type="submit" style="padding: 10px 20px; background-color: #84cc16; color: #051c05; border: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                💾 Guardar Producto
            </button>
        </div>

    </form>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>