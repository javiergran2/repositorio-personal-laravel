cat > database/seeders/UserSeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Usuario de prueba
        User::create([
            'name' => 'Cliente Demo',
            'email' => 'cliente@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123') // Contraseña simple para pruebas
        ]);

        // Más usuarios de prueba
        User::factory(20)->create();
        
        echo "Usuarios de prueba creados:\n";
        echo "- cliente@test.com / password123\n";
        echo "- 20 usuarios aleatorios\n";
    }
}
EOF