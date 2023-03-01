@csrf

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Nome </label>
    <div class="col-md-6 col-sm-9">
        <input id="input-users_name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            title="name." value="{{ $user->name ?? old('name') }}" placeholder="" required="">
    </div>
</div>

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Email </label>
    <div class="col-md-6 col-sm-9">
        <input id="input-users_email" type="email" name="email"
            class="form-control @error('email') is-invalid @enderror" title="email."
            value="{{ $user->email ?? old('email') }}" placeholder="" required="">
    </div>
</div>

@isset($user)
    <div class="mt-3">
        <label for="select-role" class="form-label">Função</label>
        <select class="form-select t-select" name="roles[]" id="select-role" multiple>
            @foreach ($roles as $role)
                <option {{ in_array($role['name'], $userRolesPluckName ?? []) ? 'selected' : null }}
                    value="{{ $role->id }}">
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
@endisset

@empty($user)
    <div class="form-group row mt-2">
        <label class="col-sm-3 control-label text-sm-right pt-2">Senha </label>
        <div class="col-md-6 col-sm-9">
            <input id="input-users_password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror" title="password."
                value="{{ $user->password ?? old('password') }}" placeholder="" required="">
        </div>
    </div>

    <div class="form-group row mt-2">
        <label class="col-sm-3 control-label text-sm-right pt-2"> Confirme sua senha </label>
        <div class="col-md-6 col-sm-9">
            <input id="input-users_password_confirmation" type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror" title="password_confirmation."
                value="{{ old('password_confirmation') }}" placeholder="" required="">
        </div>
    </div>
@endempty
