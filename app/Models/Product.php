<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'stock',
        'image',
        'category_id'

    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
