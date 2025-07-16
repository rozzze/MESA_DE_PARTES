<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
        {
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
                'eliminar-documento',

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

                //Permisos para administrar roles
                'administrar-roles',
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
