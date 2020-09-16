<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserWasCreated;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
//        $users = User::all();
        $users = User::allowed()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $user = new User;
        $this->authorize('create', $user);
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->pluck('name', 'id');
//        dd($roles);
        return view('admin.users.create', compact('user', 'roles', 'permissions'));
//        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);
        // Validar el formulario
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        // Generar una contraseña
        $data['password'] = Str::random(8);

        // Creamos el usuario
        $user = User::create($data);
        // Asignamos los roles
        if($request->filled('roles')) {
            $user->assignRole($request->roles);
        }
        // Asignamos los permisos
        if($request->filled('permissions')) {
            $user->givePermissionTo($request->permissions);
        }

        // Enviamos el email
        UserWasCreated::dispatch($user, $data['password']);


        // Regresamos al usuario
        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido creado.');

    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
//        $roles = Role::all()->pluck('name', 'id');
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->pluck('name', 'id');
//        dd($roles);
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return void
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->validated());
        return redirect()->route('admin.users.edit', $user)->withFlash('Usuario actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->route('admin.users.index')->withFlash('Usuario eliminado.');
    }
}
