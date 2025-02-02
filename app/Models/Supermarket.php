<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'images',
        'available_times',
        'location',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
        'available_times' => 'array',
    ];

    /**
     * Get the orders for the supermarket.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
