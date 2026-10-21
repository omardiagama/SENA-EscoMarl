<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Formulario -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase;">REGISTRAR NUEVA VENTA</h2>
        <p style="color: #333; font-size: 0.9rem; margin-top: 4px;">Generación de facturas y salida de inventario para <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=ventas" style="padding: 8px 14px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.8rem;">
        ← Volver al Historial
    </a>
</div>

<!-- Mensaje de Error (si aplica) -->
<?php if (!empty($error)): ?>
    <div style="background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 20px; font-size: 0.9rem;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Formulario de Registro de Venta -->
<div style="background-color: rgba(15, 30, 18, 0.92); border: 1px solid #2d5a31; border-radius: 8px; padding: 25px; color: #ffffff; max-width: 650px; margin: 0 auto;">
    
    <form action="index.php?action=ventas_crear" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        
        <!-- Cliente -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Cliente *</label>
            <select name="cliente_id" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                <option value="1">Consumidor Final (Cliente Genérico)</option>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['IdCliente'] ?? $c['id'] ?>">
                            <?= htmlspecialchars($c['NombreCompleto'] ?? $c['nombreCompleto'] ?? $c['nombre']) ?> - <?= htmlspecialchars($c['Documento'] ?? $c['documento'] ?? '') ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Producto seleccionado -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Producto / Fragancia *</label>
            <select name="producto_id" required style="...">
    <option value="">-- Seleccionar Producto --</option>
    <?php if (!empty($productos)): ?>
        <?php foreach ($productos as $p): ?>
            <option value="<?= $p['id'] ?? $p['IdProducto'] ?>">
                <?= htmlspecialchars($p['nombre'] ?? $p['NombreProducto']) ?> — $<?= number_format($p['precio_unitario'] ?? $p['Precio'] ?? 0, 0, ',', '.') ?> (Stock: <?= $p['stock_actual'] ?? $p['Stock'] ?? 0 ?>)
            </option>
        <?php endforeach; ?>
    <?php endif; ?>
</select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <!-- Cantidad -->
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Cantidad *</label>
                <input type="number" name="cantidad" value="1" min="1" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>

            <!-- Método de Pago -->
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Método de Pago *</label>
                <select name="metodo_pago" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Nequi">Nequi</option>
                    <option value="Daviplata">Daviplata</option>
                    <option value="Tarjeta">Tarjeta Débito / Crédito</option>
                </select>
            </div>
        </div>

        <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="index.php?action=ventas" style="padding: 10px 18px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem;">Cancelar</a>
            <button type="submit" style="padding: 10px 20px; background-color: #84cc16; color: #051c05; border: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                💵 Confirmar Venta
            </button>
        </div>

    </form>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>