<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">PORTAL DE EMPLEADOS Y NÓMINA</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Gestión de personal y accesos al sistema en <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=empleados_crear" style="padding: 10px 18px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 2px 6px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 8px;">
        ➕ REGISTRAR NUEVO EMPLEADO
    </a>
</div>

<!-- Tarjeta KPI -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; margin-bottom: 25px;">
    <?php $totalPersonal = !empty($empleados) ? count($empleados) : 0; ?>
    <div style="background-color: #0f1e12; border: 1px solid #84cc16; border-radius: 8px; padding: 15px; color: #ffffff;">
        <span style="color: #a3e635; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">TOTAL PERSONAL</span>
        <h3 style="color: #84cc16; font-size: 1.6rem; margin: 6px 0 0 0; font-weight: bold;"><?= $totalPersonal ?> Colaboradores</h3>
    </div>
</div>

<!-- Tabla de Empleados -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 20px; color: #ffffff; overflow-x: auto;">
    <h3 style="color: #84cc16; font-size: 1.2rem; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #2d5a31; padding-bottom: 10px; font-weight: bold;">
        👨‍💼 Lista de Empleados y Cargos
    </h3>

    <?php if (!empty($empleados)): ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #0f1e12; color: #ffffff;">
            <thead>
                <tr style="border-bottom: 2px solid #84cc16; color: #84cc16; font-size: 0.85rem; text-transform: uppercase; background-color: #051c05;">
                    <th style="padding: 12px; color: #84cc16;">ID</th>
                    <th style="padding: 12px; color: #84cc16;">Nombre Completo</th>
                    <th style="padding: 12px; color: #84cc16;">Usuario</th>
                    <th style="padding: 12px; color: #84cc16;">Cargo / Rol</th>
                    <th style="padding: 12px; color: #84cc16;">Teléfono</th>
                    <th style="padding: 12px; color: #84cc16; text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $emp): 
                    $idEmp = $emp['id'] ?? $emp['IdEmpleado'] ?? 0;
                    $nom = trim(($emp['Nombres'] ?? '') . ' ' . ($emp['Apellidos'] ?? ''));
                    $usr = $emp['Usuario'] ?? $emp['usuario'] ?? 'N/A';
                    $cargo = ($emp['Cargo'] ?? 'Vendedor') . ' (' . ($emp['Rol'] ?? 'Empleado') . ')';
                    $tel = $emp['Telefono'] ?? 'N/A';
                ?>
                    <tr style="border-bottom: 1px solid #2d5a31; background-color: #0f1e12;">
                        <td style="padding: 12px; font-weight: bold; color: #a3e635;">#<?= str_pad($idEmp, 3, '0', STR_PAD_LEFT) ?></td>
                        <td style="padding: 12px; color: #ffffff; font-weight: bold;"><?= htmlspecialchars($nom) ?></td>
                        <td style="padding: 12px; color: #a3e635; font-weight: bold;"><?= htmlspecialchars($usr) ?></td>
                        <td style="padding: 12px; color: #e2e8f0;"><?= htmlspecialchars($cargo) ?></td>
                        <td style="padding: 12px; color: #ffffff;"><?= htmlspecialchars($tel) ?></td>
                        <td style="padding: 12px; text-align: center; display: flex; gap: 8px; justify-content: center;">
                            <a href="index.php?action=empleados_editar&id=<?= $idEmp ?>" style="padding: 6px 12px; background-color: #2d5a31; color: #a3e635; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: bold; border: 1px solid #84cc16;">✏️ Editar</a>
                            <a href="index.php?action=empleados_eliminar&id=<?= $idEmp ?>" onclick="return confirm('¿Desea eliminar este empleado?');" style="padding: 6px 12px; background-color: #7f1d1d; color: #fca5a5; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: bold; border: 1px solid #f87171;">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #a3e635; text-align: center; padding: 25px 0; margin: 0;">Aún no hay empleados registrados en la base de datos.</p>
    <?php endif; ?>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>