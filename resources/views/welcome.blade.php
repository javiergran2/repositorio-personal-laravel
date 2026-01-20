cat > resources/views/welcome.blade.php << 'EOF'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h3 mb-0">
                    <i class="bi bi-people-fill"></i> Sistema de Gestión de Usuarios
                </h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <div class="text-center mb-4">
                    <h2>Bienvenido al CRUD de Usuarios</h2>
                    <p class="lead">Gestiona tus usuarios de manera eficiente</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-list-ul"></i> Ver Lista de Usuarios
                        </a>
                        
                        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg ms-3">
                            <i class="bi bi-person-plus"></i> Crear Nuevo Usuario
                        </a>
                    </div>
                </div>
                
                <hr>
                
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-eye-fill text-primary" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">Ver Usuarios</h4>
                                <p>Consulta la lista completa de usuarios registrados en el sistema.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-plus-circle-fill text-success" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">Crear Usuario</h4>
                                <p>Añade nuevos usuarios al sistema con todos sus datos.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card text-center h-100">
                            <div class="card-body">
                                <i class="bi bi-gear-fill text-warning" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">Gestionar</h4>
                                <p>Edita o elimina usuarios según sea necesario.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center text-muted">
                <small>Desarrollado con Laravel • {{ date('Y') }}</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>
EOF