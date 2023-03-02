<?php

namespace App\Http\Controllers;

use App\Repositories\WebHookRepository;
use Illuminate\Http\Request;

class WebHookController extends Controller
{
    private $repository;

    public function __construct(WebHookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listener(Request $request, $provider)
    {
        if (!in_array($provider, array_keys(config('services')))) {
            return response()->json(['message' => 'Provider not found'], 404);
        }

        $provider = $this->repository->getProviderClass($request, $provider);

        return $provider->run($request);
    }
}
