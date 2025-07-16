<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de que este sea tu modelo de usuario
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear o encontrar el rol 'Admin'
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);

        // 2. Obtener todos los permisos existentes
        // Esto asume que tus permisos ya han sido creados por otro seeder o una migración.
        $allPermissions = Permission::pluck('name')->all();

        // 3. Asignar todos los permisos al rol 'Admin'
        $adminRole->syncPermissions($allPermissions);

        // 4. Crear el usuario administrador
        // Asegúrate de que el modelo de usuario (App\Models\User) esté importado correctamente
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'], // Busca por este email
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123admin'), // Contraseña fácil de recordar
                // Agrega aquí cualquier otro campo que tu modelo User requiera, ej:
                // 'email_verified_at' => now(),
            ]
        );

        // 5. Asignar el rol 'Admin' al usuario
        if (!$adminUser->hasRole('ADMIN')) {
            $adminUser->assignRole('ADMIN');
        }

        $this->command->info('Rol "Admin" y usuario "admin@example.com" con todos los permisos creados.');
    }
}