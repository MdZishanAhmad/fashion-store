<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'customerId',
        'order_number',
        'status',
        'grand_total',
        'item_count',
        'is_paid',
        'payment_method',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'customerId');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
