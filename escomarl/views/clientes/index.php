<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">GESTIÓN DE CLIENTES</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Directorio de compradores y fidelización en <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=clientes_crear" style="padding: 10px 18px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 2px 6px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 8px;">
        ➕ REGISTRAR NUEVO CLIENTE
    </a>
</div>

<!-- Tarjetas KPI -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; margin-bottom: 25px;">
    
    <?php $totalClientes = !empty($clientes) ? count($clientes) : 0; ?>

    <div style="background-color: #0f1e12; border: 1px solid #84cc16; border-radius: 8px; padding: 15px; color: #ffffff;">
        <span style="color: #a3e635; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">CLIENTES REGISTRADOS</span>
        <h3 style="color: #84cc16; font-size: 1.6rem; margin: 6px 0 0 0; font-weight: bold;"><?= $totalClientes ?> Compradores</h3>
    </div>

</div>

<!-- Tabla de Clientes con Fondo Oscuro Directo -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 20px; color: #ffffff; overflow-x: auto;">
    <h3 style="color: #84cc16; font-size: 1.2rem; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #2d5a31; padding-bottom: 10px; font-weight: bold;">
        👥 Directorio de Clientes
    </h3>

    <?php if (!empty($clientes)): ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #0f1e12; color: #ffffff;">
            <thead>
                <tr style="border-bottom: 2px solid #84cc16; color: #84cc16; font-size: 0.85rem; text-transform: uppercase; background-color: #051c05;">
                    <th style="padding: 12px; color: #84cc16;">ID</th>
                    <th style="padding: 12px; color: #84cc16;">Documento</th>
                    <th style="padding: 12px; color: #84cc16;">Nombre Completo</th>
                    <th style="padding: 12px; color: #84cc16;">Celular</th>
                    <th style="padding: 12px; color: #84cc16;">Correo</th>
                    <th style="padding: 12px; color: #84cc16; text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cli): 
                    $idCli = $cli['IdCliente'] ?? $cli['id'] ?? 0;
                    $doc = $cli['Documento'] ?? $cli['documento'] ?? 'N/A';
                    $nombre = $cli['NombreCompleto'] ?? $cli['nombreCompleto'] ?? 'Cliente General';
                    $celular = $cli['Celular'] ?? $cli['celular'] ?? 'Sin Registro';
                    $correo = $cli['Correo'] ?? $cli['correo'] ?? 'Sin Registro';
                ?>
                    <tr style="border-bottom: 1px solid #2d5a31; background-color: #0f1e12;">
                        <td style="padding: 12px; font-weight: bold; color: #a3e635;">
                            #<?= str_pad($idCli, 4, '0', STR_PAD_LEFT) ?>
                        </td>
                        <td style="padding: 12px; color: #ffffff; font-weight: bold;">
                            <?= htmlspecialchars($doc) ?>
                        </td>
                        <td style="padding: 12px; color: #ffffff;">
                            <?= htmlspecialchars($nombre) ?>
                        </td>
                        <td style="padding: 12px; color: #e2e8f0;">
                            <?= htmlspecialchars($celular) ?>
                        </td>
                        <td style="padding: 12px; color: #e2e8f0;">
                            <?= htmlspecialchars($correo) ?>
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="index.php?action=clientes_editar&id=<?= $idCli ?>" style="padding: 6px 12px; background-color: #2d5a31; color: #a3e635; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: bold; border: 1px solid #84cc16;">
                                ✏️ Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #a3e635; text-align: center; padding: 25px 0; margin: 0;">Aún no hay clientes registrados en la base de datos.</p>
    <?php endif; ?>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>