<?php

use App\Models\User;
use App\Support\Constants;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Carbon\CarbonInterface;

/**
 * Makes translation fall back to specified value if definition does not exist
 *
 * @param string $key
 * @param null|string $fallback
 * @param null|string $locale
 * @param array|null $replace
 *
 * @return array|\Illuminate\Contracts\Translation\Translator|null|string
 */

function __trans($key = '', ?array $replace = [], ?string $fallback = null, ?string $locale = 'pt-BR')
{
    $keyM = minusculo($key);
    if (\Illuminate\Support\Facades\Lang::has($keyM, $locale) && !empty($keyM)) {
        if (gettype(trans($keyM, $replace, $locale)) == 'array') {
            return trans($keyM, $replace, $locale)[0];
        }
        return trans($keyM, $replace, $locale);
    }

    return ltrim($key);
}

function minusculo($text)
{
    return mb_strtolower($text ?? '', 'UTF-8');
}
