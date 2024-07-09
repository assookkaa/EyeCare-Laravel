<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'custom_id',
        'lastname',
        'firstname',
        'birthdate',
        'gender',
        'usertype',
        'status',
        'email',
        'password',
        'last_login_at',
        'login_at',
        'logout_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords(strtolower($value));
    }
    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords(strtolower($value));
    }
    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = date('M d, Y', strtotime($value));
    }
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $year = date('Y');
            $firstLetterLastName = strtoupper(substr($model->lastname, 0, 1));
            $firstLetterFirstName = strtoupper(substr($model->firstname, 0, 1));
            $id = $model->id ?? self::max('id') + 1;
            $model->custom_id = 'EC' . $year . $firstLetterLastName . $firstLetterFirstName . sprintf("%03s", $id);
        });
    }
}
