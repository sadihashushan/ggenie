<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'city',
    ];

    /**
     * Relationship: An Address belongs to an Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }
}
