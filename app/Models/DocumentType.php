<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'dirigido_a'];

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'document_type_requirement');
    }

    public function requests()
    {
        return $this->hasMany(DocumentRequest::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'document_type_role');
    }
    
}
