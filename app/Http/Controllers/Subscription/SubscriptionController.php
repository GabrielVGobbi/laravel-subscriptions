<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewSubscription;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('web.subscription.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function show($subscriptionId): View
    {
        $subscription = (object) [
            'id' => 'price_1MhBKyC5C6Fi3gyRsuNCp8gT',
            'name' => 'Plano Teste',
            'slug' => 'plano_teste',
            'price' => '200',
        ];

        $intent = auth()->user()->createSetupIntent();

        return view('web.subscription.show', compact('subscription', 'intent'));
    }

    public function store(StoreNewSubscription $request, $subscriptionId)
    {
        $attributes = $request->validated();

        $request->user()
            ->newSubscription('default', $subscriptionId)
            ->create($attributes['payment_method_token']);

        return to_route('subscriptions.premium');
    }

    public function premium()
    {
        return view('web.subscription.premium');
    }

    public function account()
    {
        $invoices = auth()->user()->invoices();

        return view('web.subscription.account', [
            'invoices' => $invoices,
            'userIsSubscribed' => auth()->user()->subscribed('default'),
            'userSubscription' => auth()->user()->subscription('default'),
        ]);
    }

    public function cancel()
    {
        auth()->user()->subscription('default')->cancel();

        return to_route('subscriptions');
    }

    public function resume()
    {
        auth()->user()->subscription('default')->resume();

        return to_route('account');
    }

}
