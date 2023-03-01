<?php

namespace App\Supports\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HandlesUuid
{
    public static function HandlesUuid()
    {
        static::creating(function (Model $model) {
            $model->uuid = Str::uuid();
        });
    }
}
