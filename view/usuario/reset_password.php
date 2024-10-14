<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña - Compusof</title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilosSesion.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="../img/logoCompusof.jpg" alt="Compusof" class="logo">
                <h2>Restablecer Contraseña</h2>
            </div>
            <div class="card-content">
                <form method="POST" action="\Compusof\controller\procesar_reset.php">
                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Restablecer Contraseña</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>