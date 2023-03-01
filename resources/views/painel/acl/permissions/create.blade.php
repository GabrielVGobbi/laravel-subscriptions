@extends('layouts.app')

@section('title', __('Create Permission'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Permission') }}</div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" method="POST">

                            <x-forms.form-permissions />

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                                <a href="{{ route('permissions.index') }}" class="btn btn-outline-danger">
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
