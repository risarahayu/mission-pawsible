<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function dogs()
    {
        return $this->hasMany(Dog::class);
    }

    public function userInfos()
    {
        return $this->hasMany(UserInfo::class);
    }
}
