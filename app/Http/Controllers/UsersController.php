<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arResult['users'] = User::all();
        return view('admin.user.index', $arResult);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $arResult['user'] = $user;
        $arResult['roles'] = $roles;
        return view('admin.user.edit', $arResult);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $adminRoles = DB::table('role_user')->where('role_id', 1)->get();
        $currentRole = DB::table('role_user')->where('user_id', $request->user_id)->get();
        if ($currentRole->count() != 0
            && $currentRole[0]->role_id == 1
            && $adminRoles->count() == 1
            && $request->role_id != 1) {
            return redirect()->route('users.index');
        }
        if ($currentRole->count() != 0) {
            //У пользователя есть активные роли - мы их удаляем
            DB::table('role_user')->where('user_id', $request->user_id)->delete();
        }
        $currentRole = DB::table('role_user')->insert(['user_id' => $request->user_id, 'role_id' => $request->role_id]);
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (User::all()->count() > 1) {
            $counter = 0;
            foreach (User::all() as $item) {
                if ($item->roles->count() > 0 && $item->roles[0]->id === 1) {
                    $counter++;
                }
            }
            if ($counter > 1 || $user->roles->count() == 0) {
                DB::table('role_user')->where('user_id', $user->id)->delete();
                $user->delete();
            }
        }
        return redirect()->route('users.index');
    }
}
