<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'tracking_id',
        'name',
        'email',
        'phone',
        'country',
        'state',
        'city',
        'postal_code',
        'address_line_1',
        'address_line_2',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
