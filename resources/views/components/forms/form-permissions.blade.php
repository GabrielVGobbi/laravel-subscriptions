@csrf

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Nome da Permissão</label>
    <div class="col-md-6 col-sm-9">
        <input id="input-permissions_name" type="text" name="name"
            class="form-control @error('name') is-invalid @enderror" title="name."
            value="{{ $permission->name ?? old('name') }}" placeholder="" required="">
    </div>
</div>

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Grupo</label>
    <div class="col-md-6 col-sm-9">
        <input id="input-permissions_groups" type="text" name="groups"
            class="form-control @error('groups') is-invalid @enderror" title="groups."
            value="{{ $permission->groups ?? old('groups') }}" placeholder="">
    </div>
</div>

<div class="form-group row mt-2">
    <label class="col-sm-3 control-label text-sm-right pt-2">Descrição</label>
    <div class="col-md-6 col-sm-9">
        <input id="input-permissions_description" type="text" name="description"
            class="form-control @error('description') is-invalid @enderror" title="description."
            value="{{ $permission->description ?? old('description') }}" placeholder="">
    </div>
</div>
