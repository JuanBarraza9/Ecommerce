<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes')->withPivot('quantity')->withTimestamps();
    }
    
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors')->withPivot('quantity')->withTimestamps();
    }
}
