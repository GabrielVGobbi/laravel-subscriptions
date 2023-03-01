@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span> {{ __('Permissions') }}</span>
                        <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary">
                            {{ __('Create Permission') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-striped
                                table-hover
                                table-borderless
                                align-middle">
                                <thead class="table-light">
                                    {{-- <caption>{{ __('Permissions') }} - {{ $permissions->total() }}</caption> --}}
                                    <tr>
                                        <th>Nome</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($permissions as $permission)
                                        <tr class="">
                                            <td scope="row">{{ $permission->name }}</td>
                                            <td>
                                                <a href="{{ route('permissions.show', $permission->id) }}"
                                                    class="">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex">
                            {!! $permissions->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
