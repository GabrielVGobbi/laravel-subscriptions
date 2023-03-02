@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ $subscription->name }}</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Cartão</label>
                            <form id="form" action="{{ route('subscriptions.store', $subscription->id) }}"
                                method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="input-card_name" class="form-label">Nome do Cartão</label>
                                    <input type="text" class="form-control" name="card.name" id="input-card_name">
                                </div>

                                <div class="my-3" id="card-element"></div>
                                <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-primary">
                                    Pagar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const stripe = Stripe("{{ config('cashier.key') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        //subscription
        const form = document.getElementById('form');
        const cardName = document.getElementById('input-card_name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardName.value
                        }
                    }
                }
            );

            if (error) {
                alert('Dados do cartão invalido');
                return;
            }

            let inputElementToken = document.createElement('input');
            inputElementToken.setAttribute('type', 'hidden')
            inputElementToken.setAttribute('name', 'payment_method_token');
            inputElementToken.setAttribute('value', setupIntent.payment_method);
            form.appendChild(inputElementToken);
            form.submit();
        })
    </script>
@append
