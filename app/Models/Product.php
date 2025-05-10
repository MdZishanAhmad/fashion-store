<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = ['name', 'price', 'category','description','quantity','photo'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category'); // use your correct foreign key here
    }
    
    

}


