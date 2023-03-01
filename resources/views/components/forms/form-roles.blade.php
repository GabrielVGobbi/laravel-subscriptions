@csrf

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Nome </label>
    <div class="col-md-6 col-sm-9">
        <input id="input-role_name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            title="name." value="{{ $role->name ?? old('name') }}" placeholder="" required="">
    </div>
</div>
