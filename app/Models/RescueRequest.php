<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'area_id', 'rescuer_id', 'dog_type', 'color', 'temperament',
        'gender', 'size', 'description', 'map_link', 'rescued',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rescuer()
    {
        return $this->belongsTo(User::class, 'rescuer_id'); #->optional();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
