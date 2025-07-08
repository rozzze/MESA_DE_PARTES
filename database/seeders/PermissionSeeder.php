<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permissions = [

            // Usuarios
            'ver-usuarios',
            'crear-usuario',
            'editar-usuario',
            'eliminar-usuario',

            // Documentos procesables
            'ver-documentos',
            'crear-documento',
            'editar-documento',
            'asignar-requisitos',

            // Requisitos
            'ver-requisitos',
            'crear-requisito',
            'editar-requisito',
            'eliminar-requisito',

            // Solicitudes de documentos
            'ver-solicitudes',
            'atender-solicitud',
            'aprobar-solicitud',
            'rechazar-solicitud',

            // Permisos para usuario normal
            'ver-mis-solicitudes',
            'crear-solicitud',

        ];

        foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
            }

    }
}
