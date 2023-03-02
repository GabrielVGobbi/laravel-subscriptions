<?php

namespace App\Managers\Stripe\Listeners;

use App\Repositories\Contracts\WebHookContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WebHookStripe implements WebHookContract
{
    protected $stripe, $event;

    public function __construct(Request $request)
    {
        $this->event = $this->validateRequest($request);

        $this->stripe = new \Stripe\StripeClient(
            config('services.stripe.secret')
        );
    }

    public function run()
    {
        error_log($this->event);
        dd($this->event);
    }

    private function validateRequest(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook.secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response()->json(['message' => 'Invalid'], 404);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['message' => 'Invalid'], 404);
        }

        return $event;
    }
}
