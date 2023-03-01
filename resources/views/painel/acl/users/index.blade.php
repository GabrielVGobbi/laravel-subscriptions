@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span> {{ __('Users') }}</span>
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"> {{ __('Create User') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-striped
                                table-hover
                                table-borderless
                                align-middle">
                                <thead class="table-light">
                                    {{-- <caption>{{ __('Users') }} - {{ $users->total() }}</caption> --}}
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($users as $user)
                                        <tr class="">
                                            <td scope="row">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" class="">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex">
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
