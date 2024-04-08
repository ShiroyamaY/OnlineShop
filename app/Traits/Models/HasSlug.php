<?php

namespace App\Traits\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function(Model $item){
            if (!isset($item->slug)){
                $newSlug = str($item->{static::slugFrom()})->slug();
                $item->slug = self::createUniqueSlugFrom($newSlug);
            }
        });
    }
    public static function createUniqueSlugFrom($newSlug){
        if (self::where("slug", (string)$newSlug)->exists()) {
            $check = preg_match('/([0-9]+)/', (string)$newSlug, $match);
            if(!$check){
                return self::createUniqueSlugFrom($newSlug . "_1");
            }
            $newSlug = preg_replace('/([0-9]+)$/',$match[1] + 1,$newSlug);
            return self::createUniqueSlugFrom($newSlug);
        }else{
            return $newSlug;
        }
    }
    public static function slugFrom(): string{
        return 'title';
    }
}
