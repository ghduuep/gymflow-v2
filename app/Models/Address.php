<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'complement',
        'city',
        'state',
        'zip_code',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}