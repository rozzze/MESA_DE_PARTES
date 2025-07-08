<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function documentTypes()
    {
        return $this->belongsToMany(DocumentType::class, 'document_type_requirement');
    }

    public function uploads()
    {
        return $this->hasMany(RequirementUpload::class);
    }

    public function files()
    {
        return $this->hasMany(DocumentRequestFile::class);
    }

}
