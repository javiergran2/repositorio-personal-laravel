cat > database/seeders/DatabaseSeeder.php << 'EOF'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Solo ejecutamos UserSeeder
        $this->call([
            UserSeeder::class,
        ]);
        
        // Comentamos los seeders de grupos que no necesitamos
        // $this->call([
        //     GrupoSeeder::class,
        //     GrupoUserSeeder::class,
        // ]);
    }
}
EOF