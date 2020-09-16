<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveRolesRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.roles.index', [
           'roles' => Role::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.roles.create', [
            'permissions' => Permission::pluck('name', 'id'),
            'role' => new Role,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveRolesRequest $request)
    {
//        $data = $request->validate([
//            'name' => 'required|unique:roles',
//            'display_name' => 'required',
////            'guard_name' => 'required',
//        ], [
//            'name.required' => 'El campo <strong>identificador</strong> es obligatorio',
//            'name.unique' => 'Este <strong>identificador</strong> ya ha sido registrado',
//            'display_name.required' => 'El campo <strong>nombre</strong> es obligatorio',
//        ]);

        $role = Role::create($request->validated());

        if($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        return redirect()->route('admin.roles.index')->withFlash('El role fue creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id'),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $role
     * @return void
     */
    public function update(SaveRolesRequest $request, Role $role)
    {
//        return $request;
//        $data = $request->validate([
////            'name' => 'required|unique:roles,name,' . $role->id,
//            'display_name' => 'required',
////            'guard_name' => 'required',
//
//        ],[
//            'display_name.required' => 'El campo <strong>Nombre</strong> es obligatorio',
//        ]);

        $role->update($request->validated());
        $role->permissions()->detach();
        if($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        return redirect()->route('admin.roles.edit', $role)->withFlash('El role fue actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
