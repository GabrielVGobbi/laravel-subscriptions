@extends('layouts.painel')

@section('title', __('Updated User'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Updated User') }}</div>
                    <div class="card-body p-3">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @method('PUT')

                            <x-forms.form-users :user="$user" :roles="$roles" :userRolesPluckName="$userRolesPluckName" />

                            <div class="card mt-4">
                                <div class="row p-3">
                                    <h4 class="card-title">Permissões</h4>
                                    @foreach ($permissionsAll as $group => $permissions)
                                        <div class="col-md-4 mt-4">
                                            <h3> {{ $group }} </h3>
                                            @foreach ($permissions as $permission)
                                                <div class="col-md-12 mg-0 pd-0">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input type="checkbox" name="permissions[]"
                                                            {{ in_array($permission['name'], $userPermissionsPluckName) ? 'checked' : '' }}
                                                            class="custom-control-input checkbok-roles"
                                                            id="customCheck{{ $permission['id'] }}"
                                                            value="{{ $permission['id'] }}">
                                                        <label class="custom-control-label"
                                                            for="customCheck{{ $permission['id'] }}">{{ $permission['name'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Editar
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-danger">
                                    Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
