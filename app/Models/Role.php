<?php
// app/Models/Role.php

namespace App\Models;

// Importa el modelo Role de Spatie
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends SpatieRole // Asegúrate de extender el modelo de Spatie
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // Puedes mantener esto si necesitas fillables adicionales en tu rol,
    // pero Spatie ya maneja el 'name' y 'guard_name'.
    // protected $fillable = ['name', 'guard_name'];

    /**
     * Get the document types associated with the role.
     */
    public function documentTypes(): BelongsToMany
    {
        // Define la relación muchos a muchos con DocumentType
        // 'document_type_role' es el nombre de la tabla pivote
        return $this->belongsToMany(DocumentType::class, 'document_type_role');
    }

    // Si necesitas otras relaciones o métodos personalizados para tu Role, añádelos aquí.
}