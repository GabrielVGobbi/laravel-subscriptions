<?php

namespace App\Http\Controllers\Painel\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\ACL\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permissions = Permission::paginate(15);

        return view('painel.acl.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('painel.acl.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePermission $request)
    {
        return Permission::create($request->validated()) ? back()
            ->with('message', __trans('Success')) : null;
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return view('painel.acl.permissions.show', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePermission $request, Permission $permission)
    {
        return $permission->update($request->validated()) ? back()
            ->with('message', __trans('Success')) : null;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('message', __trans('Deleted Success'));
    }
}
