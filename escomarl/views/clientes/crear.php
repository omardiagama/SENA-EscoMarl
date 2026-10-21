<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">REGISTRAR NUEVO CLIENTE</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Ingreso de datos de clientes para facturación en <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=clientes" style="padding: 8px 14px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.8rem;">
        ← Volver al Listado
    </a>
</div>

<!-- Mensaje de Error (si aplica) -->
<?php if (!empty($error)): ?>
    <div style="background-color: #7f1d1d; color: #fca5a5; padding: 12px; border-radius: 6px; border: 1px solid #f87171; margin-bottom: 20px; font-size: 0.9rem;">
        ⚠️ <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Formulario de Registro -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 25px; color: #ffffff; max-width: 600px; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.4);">
    
    <form action="index.php?action=clientes_crear" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        
        <!-- Documento de Identidad / Cédula -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Documento / Cédula *</label>
            <input type="text" name="documento" required placeholder="Ej: 1019283746" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
        </div>

        <!-- Nombre Completo -->
        <div>
            <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Nombre Completo *</label>
            <input type="text" name="nombreCompleto" required placeholder="Ej: Maria Paula Rodriguez" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
        </div>

        <!-- Teléfono Celular y Correo en 2 columnas -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Celular / WhatsApp</label>
                <input type="text" name="celular" placeholder="3001234567" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>

            <div>
                <label style="display: block; color: #a3e635; font-size: 0.85rem; font-weight: bold; margin-bottom: 5px;">Correo Electrónico</label>
                <input type="email" name="correo" placeholder="cliente@correo.com" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #2d5a31; background-color: #051c05; color: #ffffff; font-size: 0.9rem; box-sizing: border-box;">
            </div>
        </div>

        <!-- Botones de Acción -->
        <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="index.php?action=clientes" style="padding: 10px 18px; background-color: #2d5a31; color: #d9f99d; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem;">Cancelar</a>
            <button type="submit" style="padding: 10px 20px; background-color: #84cc16; color: #051c05; border: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                👤 Guardar Cliente
            </button>
        </div>

    </form>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>