<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">EDITAR EMPLEADO</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Actualización de información laboral y accesos para <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=empleados" style="padding: 8px 14px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.8rem;">
        ← Volver al Portal
    </a>
</div>

<!-- Mensaje de Error (si aplica) -->
<?php if (!empty($error)): ?>
    <div style="background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 20px; font-size: 0.9rem;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Formulario de Edición -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 25px; color: #ffffff; max-width: 700px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.4);">
    
    <form action="index.php?action=empleados_editar&id=<?= $empleado['IdEmpleado'] ?? $empleado['id'] ?>" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        
        <!-- Nombres y Apellidos -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Nombres *</label>
                <input type="text" name="nombres" value="<?= htmlspecialchars($empleado['Nombres'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Apellidos *</label>
                <input type="text" name="apellidos" value="<?= htmlspecialchars($empleado['Apellidos'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
        </div>

        <!-- Usuario y Nueva Contraseña -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Usuario de Acceso *</label>
                <input type="text" name="usuario" value="<?= htmlspecialchars($empleado['Usuario'] ?? '') ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Contraseña (Opcional)</label>
                <input type="password" name="contrasena" placeholder="••••••••" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                <small style="color: #a3e635; font-size: 0.75rem;">Dejar en blanco si no desea cambiar la clave.</small>
            </div>
        </div>

        <!-- Cargo, Rol y Teléfono -->
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Cargo *</label>
                <input type="text" name="cargo" value="<?= htmlspecialchars($empleado['Cargo'] ?? 'Vendedor') ?>" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Rol de Sistema *</label>
                <?php $rolActual = $empleado['Rol'] ?? 'Empleado'; ?>
                <select name="rol" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
                    <option value="Empleado" <?= $rolActual === 'Empleado' ? 'selected' : '' ?>>Empleado</option>
                    <option value="Administrador" <?= $rolActual === 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Teléfono</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($empleado['Telefono'] ?? $empleado['Teléfono'] ?? '') ?>" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
        </div>

        <!-- Sueldo -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Sueldo Base ($)</label>
            <input type="number" name="sueldo" value="<?= (int)($empleado['Sueldo'] ?? 1300000) ?>" step="50000" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
        </div>

        <!-- Botones de Acción -->
        <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="index.php?action=empleados" style="padding: 10px 18px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem;">Cancelar</a>
            <button type="submit" style="padding: 10px 20px; background-color: #84cc16; color: #051c05; border: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                💾 Actualizar Empleado
            </button>
        </div>

    </form>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>