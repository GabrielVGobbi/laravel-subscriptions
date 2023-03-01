<?php

namespace App\Supports\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HandlesSlug
{
    public static function bootHandlesSlug()
    {
        static::creating(function (Model $model) {
            $model->slug = Str::slug(mb_strtolower($model->name, 'UTF-8'), '_');
        });
    }
}
