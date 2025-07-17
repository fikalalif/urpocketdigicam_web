<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'hub_category_id',
        'is_active',
        'is_visible',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }

            if (is_null($model->is_active)) {
                $model->is_active = true;
            }

            if (is_null($model->is_visible)) {
                $model->is_visible = true;
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}