<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Header del Módulo -->
<div style="border-bottom: 2px solid #84cc16; padding-bottom: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h2 style="color: #1a381d; font-size: 1.8rem; margin: 0; text-transform: uppercase; font-weight: 800;">HISTORIAL Y REPORTES DE VENTAS</h2>
        <p style="color: #1a381d; font-size: 0.95rem; margin-top: 4px; font-weight: 600;">Control de facturación, pedidos y reportes periódicos de <strong>Esencia & co.</strong></p>
    </div>
    <a href="index.php?action=ventas_crear" style="padding: 10px 18px; background-color: #84cc16; color: #051c05; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 2px 6px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 8px;">
        ➕ REGISTRAR NUEVA VENTA
    </a>
</div>

<!-- Filtros de Reportes (Diario, Mensual, Anual) -->
<?php $periodoActual = $_GET['periodo'] ?? 'todos'; ?>
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 15px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
    <span style="color: #a3e635; font-weight: bold; font-size: 0.9rem;">📊 FILTRAR REPORTE DE VENTAS:</span>
    <div style="display: flex; gap: 8px;">
        <a href="index.php?action=ventas&periodo=todos" style="padding: 8px 14px; border-radius: 5px; text-decoration: none; font-size: 0.85rem; font-weight: bold; <?= $periodoActual === 'todos' ? 'background-color: #84cc16; color: #051c05;' : 'background-color: #051c05; color: #a3e635; border: 1px solid #2d5a31;' ?>">
            Todas las Ventas
        </a>
        <a href="index.php?action=ventas&periodo=diario" style="padding: 8px 14px; border-radius: 5px; text-decoration: none; font-size: 0.85rem; font-weight: bold; <?= $periodoActual === 'diario' ? 'background-color: #84cc16; color: #051c05;' : 'background-color: #051c05; color: #a3e635; border: 1px solid #2d5a31;' ?>">
            📅 Reporte Hoy
        </a>
        <a href="index.php?action=ventas&periodo=mensual" style="padding: 8px 14px; border-radius: 5px; text-decoration: none; font-size: 0.85rem; font-weight: bold; <?= $periodoActual === 'mensual' ? 'background-color: #84cc16; color: #051c05;' : 'background-color: #051c05; color: #a3e635; border: 1px solid #2d5a31;' ?>">
            🗓️ Reporte Este Mes
        </a>
        <a href="index.php?action=ventas&periodo=anual" style="padding: 8px 14px; border-radius: 5px; text-decoration: none; font-size: 0.85rem; font-weight: bold; <?= $periodoActual === 'anual' ? 'background-color: #84cc16; color: #051c05;' : 'background-color: #051c05; color: #a3e635; border: 1px solid #2d5a31;' ?>">
            📈 Reporte Este Año
        </a>
    </div>
</div>

<!-- Tarjetas KPI -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
    
    <?php 
        $totalIngresos = 0;
        $totalVentasCount = 0;

        if (!empty($ventas)) {
            foreach ($ventas as $v) {
                $estado = $v['estado'] ?? 'Activa';
                if ($estado === 'Activa') {
                    $monto = $v['TotalVenta'] ?? $v['total'] ?? 0;
                    $totalIngresos += (float)$monto;
                    $totalVentasCount++;
                }
            }
        }
        $promedioVenta = $totalVentasCount > 0 ? ($totalIngresos / $totalVentasCount) : 0;
    ?>

    <div style="background-color: #0f1e12; border: 1px solid #84cc16; border-radius: 8px; padding: 15px; color: #ffffff;">
        <span style="color: #a3e635; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">TOTAL FACTURADO</span>
        <h3 style="color: #84cc16; font-size: 1.6rem; margin: 6px 0 0 0; font-weight: bold;">$<?= number_format($totalIngresos, 0, ',', '.') ?></h3>
    </div>

    <div style="background-color: #0f1e12; border: 1px solid #84cc16; border-radius: 8px; padding: 15px; color: #ffffff;">
        <span style="color: #a3e635; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">VENTAS EFECTIVAS</span>
        <h3 style="color: #84cc16; font-size: 1.6rem; margin: 6px 0 0 0; font-weight: bold;"><?= $totalVentasCount ?> pedidos</h3>
    </div>

    <div style="background-color: #0f1e12; border: 1px solid #84cc16; border-radius: 8px; padding: 15px; color: #ffffff;">
        <span style="color: #a3e635; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">TICKET PROMEDIO</span>
        <h3 style="color: #84cc16; font-size: 1.6rem; margin: 6px 0 0 0; font-weight: bold;">$<?= number_format($promedioVenta, 0, ',', '.') ?></h3>
    </div>

</div>

<!-- Tabla del Historial de Ventas -->
<div style="background-color: #0f1e12; border: 1px solid #2d5a31; border-radius: 8px; padding: 20px; color: #ffffff; overflow-x: auto;">
    <h3 style="color: #84cc16; font-size: 1.2rem; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #2d5a31; padding-bottom: 10px; font-weight: bold;">
        📋 Historial de Pedidos y Facturas (<?= ucfirst($periodoActual) ?>)
    </h3>

    <?php if (!empty($ventas)): ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left; background-color: #0f1e12; color: #ffffff;">
            <thead>
                <tr style="border-bottom: 2px solid #84cc16; color: #84cc16; font-size: 0.85rem; text-transform: uppercase; background-color: #051c05;">
                    <th style="padding: 12px; color: #84cc16;">ID Factura</th>
                    <th style="padding: 12px; color: #84cc16;">Fecha y Hora</th>
                    <th style="padding: 12px; color: #84cc16;">Cliente</th>
                    <th style="padding: 12px; color: #84cc16;">Atendido por</th>
                    <th style="padding: 12px; color: #84cc16;">Estado</th>
                    <th style="padding: 12px; color: #84cc16; text-align: right;">Total</th>
                    <th style="padding: 12px; color: #84cc16; text-align: center;">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $v): 
                    $idFactura = $v['IdFactura'] ?? $v['id'] ?? 0;
                    $fechaFactura = $v['FechaFactura'] ?? $v['fecha'] ?? null;
                    $totalFactura = $v['TotalVenta'] ?? $v['total'] ?? 0;
                    $clienteNom = $v['cliente_nombre'] ?? $v['NombreCompleto'] ?? 'Consumidor Final';
                    $empleadoNom = $v['empleado_nombre'] ?? $v['Nombres'] ?? 'Administrador';
                    $estado = $v['estado'] ?? 'Activa';
                    $isInhabilitada = ($estado === 'Inhabilitada');
                ?>
                    <tr style="border-bottom: 1px solid #2d5a31; background-color: #0f1e12; <?= $isInhabilitada ? 'opacity: 0.55;' : '' ?>">
                        <td style="padding: 12px; font-weight: bold; color: #a3e635;">
                            #<?= str_pad($idFactura, 5, '0', STR_PAD_LEFT) ?>
                        </td>
                        <td style="padding: 12px; color: #ffffff;">
                            <?= !empty($fechaFactura) ? date('d/m/Y H:i', strtotime($fechaFactura)) : 'Fecha N/A' ?>
                        </td>
                        <td style="padding: 12px; color: #ffffff; font-weight: 500;">
                            <?= htmlspecialchars($clienteNom) ?>
                        </td>
                        <td style="padding: 12px; color: #e2e8f0;">
                            <?= htmlspecialchars($empleadoNom) ?>
                        </td>
                        <td style="padding: 12px;">
                            <?php if ($isInhabilitada): ?>
                                <span style="background-color: #7f1d1d; color: #fca5a5; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">🚫 Anulada</span>
                            <?php else: ?>
                                <span style="background-color: #064e3b; color: #6ee7b7; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">Activa</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 12px; color: #a3e635; font-weight: bold; font-size: 1rem; text-align: right; <?= $isInhabilitada ? 'text-decoration: line-through;' : '' ?>">
                            $<?= number_format((float)$totalFactura, 0, ',', '.') ?>
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <?php if (!$isInhabilitada): ?>
                                <a href="index.php?action=ventas_inhabilitar&id=<?= $idFactura ?>&periodo=<?= $periodoActual ?>" 
                                   onclick="return confirm('¿Inhabilitar esta venta? Se descontará del total.');" 
                                   style="padding: 5px 10px; background-color: #7f1d1d; color: #fca5a5; text-decoration: none; border-radius: 4px; font-size: 0.75rem; font-weight: bold; border: 1px solid #f87171;">
                                    🚫 Inhabilitar
                                </a>
                            <?php else: ?>
                                <a href="index.php?action=ventas_habilitar&id=<?= $idFactura ?>&periodo=<?= $periodoActual ?>" 
                                   onclick="return confirm('¿Volver a activar esta venta? Sumará nuevamente al total.');" 
                                   style="padding: 5px 10px; background-color: #2d5a31; color: #a3e635; text-decoration: none; border-radius: 4px; font-size: 0.75rem; font-weight: bold; border: 1px solid #84cc16;">
                                    ✅ Habilitar
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: #a3e635; text-align: center; padding: 25px 0; margin: 0;">No se registraron ventas en el período seleccionado.</p>
    <?php endif; ?>
</div>

</div> <!-- Cierre del app-container -->

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>