<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Genie extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'image',
        'street_address',
        'city',
        'age',
        'phone_number',
        'email',
        'password', 
    ];

    protected $casts = [
        'image' => 'array'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
