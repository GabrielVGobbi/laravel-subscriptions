@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ __('Subscriptions 1') }}</div>

                    <div class="card-body">

                        <a href="{{ route('subscriptions.show', 'price_1MhBKyC5C6Fi3gyRsuNCp8gT') }}" class="">
                            Escolher
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ __('Subscriptions 2') }}</div>

                    <div class="card-body">


                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">{{ __('Subscriptions 3') }}</div>

                    <div class="card-body">


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
