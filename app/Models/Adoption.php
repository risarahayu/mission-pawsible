<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'dog_id',
        'status',
        'housing_type',
        'housing_permission',
        'housing_condition',
        'pet_experience',
        'residency_duration',
        'planned_residency_duration',
        'future_residency_country',
        'pet_migration_plan',
        'job',
        'house_occupants',
        'canine_residence',
        'vaccinated',
        'score'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dog()
    {
        return $this->belongsTo(Dog::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
