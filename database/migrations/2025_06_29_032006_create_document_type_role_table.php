<?php
// Ejemplo de migración para document_type_role (si no la tienes ya)
// database/migrations/YYYY_MM_DD_HHMMSS_create_document_type_role_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_type_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // 'roles' es el nombre por defecto de la tabla de Spatie
            $table->timestamps();

            // Opcional: Asegurar unicidad de la combinación
            $table->unique(['document_type_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_type_role');
    }
};