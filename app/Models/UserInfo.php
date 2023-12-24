<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'birthday', 'whatsapp', 'facebook', 'instagram',
        'street_address', 'city', 'province', 'postal', 'map_link',
    ];

}
