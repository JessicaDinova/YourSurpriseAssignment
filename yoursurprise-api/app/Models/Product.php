<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public function categoryInfo()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
}
