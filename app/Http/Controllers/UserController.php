<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('dashboard.users.index', compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        CreateUser::run($request->validated());

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        dd($request->all());
    }


    public function destroy(User $user)
    {
        dd($user);
    }
}
