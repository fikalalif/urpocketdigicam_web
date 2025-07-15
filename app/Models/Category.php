<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id',
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
