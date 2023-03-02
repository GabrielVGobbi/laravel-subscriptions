@extends('layouts.painel')

@section('title', __('Create Role'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Role') }}</div>
                    <div class="card-body">
                        <form action="{{ route('roles.store') }}" method="POST">

                            <x-forms.form-roles />

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                                <a href="{{ route('roles.index') }}" class="btn btn-outline-danger">
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
