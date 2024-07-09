<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_id',
        'patient_id',
        'appointment_id',
        'os_sph',
        'os_cyl',
        'os_axis',
        'od_sph',
        'od_cyl',
        'od_axis',
        'add',
        'pd',
        'note',
    ];
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $year = date('Y');
            $id = $model->id ?? self::max('id') + 1;
            $model->custom_id = 'ECC' . $year . sprintf("%03s", $id);
        });
    }
}
