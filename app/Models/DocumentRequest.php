<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    protected $fillable = ['user_id', 'document_type_id', 'estado', 'observaciones','respuesta_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
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
