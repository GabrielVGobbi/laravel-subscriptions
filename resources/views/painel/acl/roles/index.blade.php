@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span> {{ __('Role') }}</span>
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Create Role') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-striped
                                table-hover
                                table-borderless
                                align-middle">
                                <thead class="table-light">
                                    {{-- <caption>{{ __('Role') }} - {{ $roles->total() }}</caption> --}}
                                    <tr>
                                        <th>Nome</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td scope="row">{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('roles.show', $role->id) }}">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex">
                            {!! $roles->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
