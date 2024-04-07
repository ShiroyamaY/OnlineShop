<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'title',
        'slug',
        'price',
        'thumbnail',
        'brand_id'
    ];
    public function brand(): void
    {
        $this->belongsTo(Brand::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
