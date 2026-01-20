<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Videoclub Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4><i class="bi bi-person-plus"></i> Registrarse como Cliente</h4>
                        <p class="mb-0">Videoclub Online</p>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nombre completo *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Contraseña *</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Confirmar Contraseña *</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>DNI/NIE (opcional)</label>
                                    <input type="text" name="dni" class="form-control">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Teléfono *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label>Dirección *</label>
                                <textarea name="address" class="form-control" rows="2" required></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Fecha de Nacimiento *</label>
                                    <input type="date" name="birth_date" class="form-control" required>
                                    <small class="text-muted">Debes ser mayor de 18 años</small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label>Tipo de Membresía *</label>
                                    <select name="membership_type" class="form-control" required>
                                        <option value="basic">Básica (3 alquileres max)</option>
                                        <option value="premium">Premium (5 alquileres max)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" required>
                                    <label class="form-check-label">
                                        Acepto los términos y condiciones
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-person-plus"></i> Registrarse
                                </button>
                                
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                    ¿Ya tienes cuenta? Inicia sesión
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>