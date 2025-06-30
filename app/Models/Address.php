<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'street',
        'number',
        'complement',
        'city',
        'state',
        'country',
        'zip_code',
    ];

    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}