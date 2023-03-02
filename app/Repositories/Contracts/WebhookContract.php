<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface WebHookContract
{
    public function run();
}
