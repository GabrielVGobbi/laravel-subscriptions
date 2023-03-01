<?php

namespace App\Http\Controllers\Painel\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::where('slug', '<>', 'developer')->paginate(15);

        return view('painel.acl.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('painel.acl.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateRole $request)
    {
        Role::create($request->validated());

        return back()->with('message', __trans('Success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissionsAll = Permission::get()
            ->groupBy('groups')
            ->sortBy('name')
            ->toArray();

        $rolePermissionsPluckName = $role->permissions->pluck('name')->toArray();

        return view('painel.acl.roles.show', [
            'role' => $role,
            'rolePermissionsPluckName' => $rolePermissionsPluckName,
            'permissionsAll' => $permissionsAll,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRole $request, Role $role)
    {
        $role->update($request->validated());

        $role->permissions()->sync($request->validated()['permissions']);

        return back()->with('message', __trans('Success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('message', __trans('Deleted Success'));
    }
}
