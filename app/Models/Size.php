<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')->withPivot('quantity')->withTimestamps();
    }
    
    // relacion muchos a uno
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
