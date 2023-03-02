@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Minha Assinatura,
                        @if ($userIsSubscribed)
                            <span>Você é assinante
                                {{ $userSubscription->onGracePeriod() ? 'até : ' . $userSubscription->ends_at : null }}
                            </span>
                        @else
                            <span>Você não é assinante</span>
                        @endif
                    </div>

                    <div class="card-body">
                        @if ($userIsSubscribed)

                            @if ($userSubscription->onGracePeriod())
                                <a href="{{ route('subscriptions.resume') }}" class="btn btn-primary btn-sm">
                                    Reativar Assinatura
                                </a>
                            @else
                                <a href="{{ route('subscriptions.cancel') }}" class="btn btn-danger btn-sm">
                                    Cancelar Assinatura
                                </a>
                            @endif
                        @endif

                        @if (!$userIsSubscribed)
                            <a href="{{ route('subscriptions') }}" class="btn btn-primary btn-sm">
                                Assinar
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="card text-start">
                            <div class="card-body">
                                <h4 class="card-title">Invoices</h4>

                                <div class="table-responsive">
                                    <table
                                        class="table table-striped
                                    table-hover
                                    table-borderless
                                    align-middle">
                                        <thead class="table-light">
                                            <caption>Table Name</caption>
                                            <tr>
                                                <th>Data</th>
                                                <th>Quantia</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach ($invoices as $invoice)
                                                <tr>
                                                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                                    <td>{{ $invoice->total() }}</td>
                                                    <td>
                                                        <a download="" href="" class=""></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@append
