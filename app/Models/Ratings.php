<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;   

class Ratings extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'rate',
        'feedback',
    ];
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'custom_id');
    }
}
