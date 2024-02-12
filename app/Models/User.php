<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Dog;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
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

    public function dogs()
    {
        return $this->hasMany(Dog::class);
    }

    public function rescueRequests()
    {
        return $this->hasMany(RescueRequest::class, 'user_id');
    }

    public function rescuedDogs()
    {
        return $this->hasMany(RescueRequest::class, 'rescuer_id');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
}
