<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'subcategory_id', 'category_id', 'stock', 'image', 'status'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }




}
