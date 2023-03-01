@extends('layouts.app')

@section('title', __('Updated Role'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <span> {{ __('Updated Role') }}</span>

                        <div class="d-flex">
                            <a href="javascript:void(0)" data-rel="all" class="js-select"> Selecionar tudo </a>
                            <div class="text-center mx-3"> <i class="fas fa-chevron-right"></i> </div>
                            <a href="javascript:void(0)" data-rel="empty" class="tx-light js-select"> Limpar tudo </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="POST">
                            @method('PUT')

                            <x-forms.form-roles :role="$role" />

                            <div class="row">
                                @foreach ($permissionsAll as $group => $permissions)
                                    <div class="col-md-4 mt-4">
                                        <h3> {{ $group }} </h3>
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-12 mg-0 pd-0">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" name="permissions[]"
                                                        {{ in_array($permission['name'], $rolePermissionsPluckName) ? 'checked' : '' }}
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

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Editar
                                    </button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-outline-danger">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.js-select').forEach(item => {
            item.addEventListener('click', selected);
        });

        function selected(e) {
            const t = e.target.getAttribute('data-rel')
            document.querySelectorAll('.checkbok-roles').forEach(item => {
                t == 'all' ? item.checked = true : item.checked = false;
            });
        }
    </script>
@append
