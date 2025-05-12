<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'quantity',
        'productId', 
        'customerId' 
    ];
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productId'); // Specify custom foreign key
    }
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customerId'); // Specify custom foreign key
    }
    
}