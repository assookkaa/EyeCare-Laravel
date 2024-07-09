<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_id',
        'patient_id',
        'time',
        'date',
        'status',
        'note',
        'has_rate',
    ];
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id', 'custom_id');
    }
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('M d, Y', strtotime($value));
    }
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $year = date('Y');
            $id = $model->id ?? self::max('id') + 1;
            $model->custom_id = 'ECA' . $year . sprintf("%03s", $id);
        });
    }
}
