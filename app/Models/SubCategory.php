<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relacion uno a muchos
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    // En el modelo SubCategory.php

    
}
