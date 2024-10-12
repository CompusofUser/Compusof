<?php
session_start();
$activeTab = $_GET['tab'] ?? 'personal';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Ingeniero - Compusof</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="..\img\favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="..\css\estilosDash.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="dropdown me-3">
            <button class="btn btn-link" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Inicio</a></li>
                <li><a class="dropdown-item" href="#">Configuración</a></li>
                <li><a class="dropdown-item" href="#">Ayuda</a></li>
            </ul>
        </div>
        <a class="navbar-brand flex-grow-1" href="#">
            <img 
                src="..\img\logoCompusof.jpg" 
                alt="Compusof Logo" 
                class="img-fluid compusof-logo"
            />
        </a>
        
        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="btn btn-link position-relative" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell nav-icon"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                        <span class="visually-hidden">unread notifications</span>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                    <li><a class="dropdown-item" href="#">Notificación 1</a></li>
                    <li><a class="dropdown-item" href="#">Notificación 2</a></li>
                    <li><a class="dropdown-item" href="#">Notificación 3</a></li>
                </ul>
            </div>
            <div class="dropdown me-3">
                <button class="btn btn-link" type="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog nav-icon"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="settingsDropdown">
                    <li><a class="dropdown-item" href="#">Configuración de cuenta</a></li>
                    <li><a class="dropdown-item" href="#">Preferencias</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                </ul>
            </div>
            <i class="fas fa-question-circle nav-icon"></i>
            <div class="dropdown">
                <button class="btn btn-link p-0" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-initial">E</div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">Ver perfil</a></li>
                    <li><a class="dropdown-item" href="#">Editar perfil</a></li>
                    <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        <h1 class="mb-4">Perfil del Ingeniero</h1>
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $activeTab === 'personal' ? 'active' : ''; ?>" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">Datos Personales</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $activeTab === 'activity' ? 'active' : ''; ?>" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Historial de Actividad</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?php echo $activeTab === 'help' ? 'active' : ''; ?>" id="help-tab" data-bs-toggle="tab" data-bs-target="#help" type="button" role="tab" aria-controls="help" aria-selected="false">Ayuda</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade <?php echo $activeTab === 'personal' ? 'show active' : ''; ?>" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                <h2 class="mt-4 mb-4">Información Personal</h2>
                <form id="personalDataForm" method="POST" action="update_profile.php" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <img src="placeholder.jpg" alt="Foto de perfil" id="profilePhoto" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <input type="file" id="photoUpload" name="photo" accept="image/jpeg,image/png" style="display: none;">
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('photoUpload').click()">Cambiar Foto</button>
                            <p class="text-muted mt-1">Solo archivos PNG o JPG, máximo 5MB</p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ingrese sus nombres" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ingrese sus apellidos" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo (@compusof.mx)</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@compusof.mx" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone1" class="form-label">Teléfono 1 (máx. 10 dígitos)</label>
                            <input type="tel" class="form-control" id="phone1" name="phone1" placeholder="5551234567" maxlength="10" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone2" class="form-label">Teléfono 2 (máx. 10 dígitos)</label>
                            <input type="tel" class="form-control" id="phone2" name="phone2" placeholder="5559876543" maxlength="10">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Género</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Seleccione un género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serviceCenter" class="form-label">Centro de Servicio (opcional)</label>
                            <input type="text" class="form-control" id="serviceCenter" name="serviceCenter" placeholder="Centro de servicio">
                        </div>
                        <div class="col-md-6">
                            <label for="position" class="form-label">Puesto (opcional)</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Puesto">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="region" class="form-label">Región</label>
                            <select class="form-select" id="region" name="region" required>
                                <option value="">Seleccione una región</option>
                                <option value="Centro">Centro</option>
                                <option value="Metro">Metro</option>
                                <option value="Sur">Sur</option>
                                <option value="Occidente">Occidente</option>
                                <option value="Norte">Norte</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">Mostrar</button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>

            <div class="tab-pane fade <?php echo $activeTab === 'activity' ? 'show active' : ''; ?>" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                <h2 class="mt-4 mb-4">Historial de Actividad</h2>
                <ul class="list-group">
                    <li class="list-group-item">2024-09-26: Inicio de sesión</li>
                    <li class="list-group-item">2024-09-25: Actualización de perfil</li>
                    <li class="list-group-item">2024-09-24: Cambio de contraseña</li>
                </ul>
            </div>

            <div class="tab-pane fade <?php echo $activeTab === 'help' ? 'show active' : ''; ?>" id="help" role="tabpanel" aria-labelledby="help-tab">
                <h2 class="mt-4 mb-4">Ayuda</h2>
                <p>Contacto de soporte Compusof: <strong>555-COMPUSOF</strong></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="funcionPerfil.js"></script>
</body>
</html>


