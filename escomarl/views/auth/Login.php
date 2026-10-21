<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esencia & co. - EscoMarl</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            /* Mantiene tu imagen de fondo original */
            background: url('public/img/login_bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Encabezado con la marca del cliente */
        .brand-header {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 15px;
        }

        .brand-header h1 {
            color: #70e000; /* Verde vibrante idéntico a las chispas del fondo */
            font-size: 2.2rem;
            font-family: 'Georgia', serif;
            font-style: italic;
            font-weight: bold;
            text-shadow: 0 2px 4px rgba(0,0,0,0.6);
            margin-bottom: 2px;
        }

        .brand-header p {
            color: #ffffff;
            font-size: 0.85rem;
            text-transform: lowercase;
            letter-spacing: 1px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.8);
            margin-bottom: 8px;
        }

        .brand-badge {
            display: inline-block;
            background-color: #70e000;
            color: #1a3800;
            font-size: 0.75rem;
            font-weight: bold;
            padding: 3px 12px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        /* Recuadro Blanco Centrado */
        .login-card {
            position: relative;
            z-index: 2;
            background-color: #ffffff;
            width: 100%;
            max-width: 360px;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .login-card h2 {
            color: #1a3800;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 22px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group label {
            display: block;
            color: #1a3800;
            font-size: 0.78rem;
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            background-color: #f7fcf5;
            border: 1px solid #c2f0a1;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #1a3800;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #70e000;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(112, 224, 0, 0.2);
        }

        /* Botón con Verde Lima que combina exactamente con los detalles del fondo */
        .btn-ingresar {
            width: 100%;
            padding: 12px;
            background-color: #70e000;
            color: #1a3800; /* Texto en verde oscuro para excelente contraste y legibilidad */
            border: none;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 4px 10px rgba(112, 224, 0, 0.3);
            transition: all 0.2s ease;
        }

        .btn-ingresar:hover {
            background-color: #5ce600;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(112, 224, 0, 0.4);
        }

        .btn-ingresar:active {
            transform: translateY(0);
        }

        .alert-error {
            background-color: #ffebee;
            color: #c62828;
            padding: 8px 10px;
            border-radius: 6px;
            font-size: 0.82rem;
            margin-bottom: 15px;
            border: 1px solid #ffcdd2;
        }
    </style>
</head>
<body>

    <!-- Encabezado de la Marca Esencia & co. -->
    <div class="brand-header">
        <h1>Esencia & co.</h1>
        <p>aromas inspirados</p>
        <span class="brand-badge">EscoMarl</span>
    </div>

    <!-- Formulario Limpio sobre la tarjeta blanca -->
    <div class="login-card">
        <h2>Acceder al sistema</h2>

        <?php if (isset($error) && !empty($error)): ?>
            <div class="alert-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="form-group">
                <label for="email">USUARIO:</label>
                <input type="text" id="email" name="email" required placeholder="Ingrese su usuario o correo">
            </div>

            <div class="form-group">
                <label for="password">CONTRASEÑA:</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-ingresar">INGRESAR</button>
        </form>
    </div>

</body>
</html>