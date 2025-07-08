<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementUpload extends Model
{
    protected $fillable = ['document_request_id', 'requirement_id', 'archivo'];

    public function documentRequest()
    {
        return $this->belongsTo(DocumentRequest::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
