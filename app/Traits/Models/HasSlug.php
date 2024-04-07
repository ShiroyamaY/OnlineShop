<?php

namespace App\Traits\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {

        static::creating(function (Model $item) {
            $item->slug = $item->slug ?? str($item::slugFrom())
                                            //TODO implement function for checking if slug already exists
                                            ->append(time() + rand(1,2000))
                                            ->slug();
        });
    }
    public static function slugFrom(): string{
        return 'title';
    }
}
