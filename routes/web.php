cat > routes/web.php << 'EOF'
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
})->name('home');

// CRUD de usuarios
Route::resource('users', UserController::class);

// Rutas de autenticación (si las necesitas para pruebas)
Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::get('/register', function () {
    return redirect('/');
})->name('register');

Route::get('/logout', function () {
    return redirect('/');
})->name('logout');
EOF