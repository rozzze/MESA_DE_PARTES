<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentRequestFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_request_id',
        'requirement_id',
        'file_path',
    ];

    public function documentRequest()
    {
        return $this->belongsTo(DocumentRequest::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
