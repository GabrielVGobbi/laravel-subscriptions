<?php

namespace App\Http\Controllers\Painel\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\ACL\Permission;
use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::paginate(15);

        return view('painel.acl.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('painel.acl.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUser $request)
    {
        return User::create($request->validated()) ? back()
            ->with('message', __trans('Success')) : null;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $permissionsAll = Permission::get()
            ->groupBy('groups')
            ->sortBy('name')
            ->toArray();

        $userPermissionsPluckName = $user->permissions->pluck('name')->toArray();

        $userRolesPluckName = $user->roles->pluck('name')->toArray();

        return view('painel.acl.users.show', [
            'user' => $user,
            'roles' => Role::all(),
            'userRolesPluckName' => $userRolesPluckName,
            'permissionsAll' => $permissionsAll,
            'userPermissionsPluckName' => $userPermissionsPluckName,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUser $request, User $user)
    {
        $user->update($request->validated());

        $user->permissions()->sync($request->validated()['permissions'] ?? null);

        $user->roles()->sync($request->validated()['roles'] ?? null);

        return back()->with('message', __trans('Success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
