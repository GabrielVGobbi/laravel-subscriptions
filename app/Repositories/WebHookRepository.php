<?php

namespace App\Repositories;

use App\Managers\Stripe\Listeners\WebHookStripe;
use App\Repositories\Contracts\WebHookContract;
use Illuminate\Http\Request;
use Stripe\Stripe;

class WebHookRepository
{
    public function getProviderClass($request, string $provider)
    {
        return $this->getProvider($provider, $request);
    }

    public function getProvider(string $provider, Request $request): WebHookContract
    {
        return match ($provider) {
            'stripe' => new WebHookStripe($request)
        };
    }
}
