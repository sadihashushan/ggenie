<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'supermarket_id',
        'order_items',
        'status',
        'payment_method',
        'payment_status',
        'notes',
        'genie_id', 
    ];

    // Cast order_items to an array
    protected $casts = [
        'order_items' => 'array', 
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supermarket()
    {
        return $this->belongsTo(Supermarket::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function genie()
    {
        return $this->belongsTo(Genie::class);
    }
}
