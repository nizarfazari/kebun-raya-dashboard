<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'image',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_categories');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => asset('storage/category/' . $image),
        );
    }
}
