<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $data = $request->validated();
        if ($request->has('image')){
            $file = $request->file('image');
            $name = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets\uploads\users'), $name);
            $data['image'] = $name;
        }

        return redirect(route('users.index'));
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->has('image')){
            $file = $request->file('image');
            $name = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets\uploads\users'), $name);
            $data['image'] = $name;
        }
        $user->update($data);

        return redirect(route('users.index'));
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users.index'));
    }
}
