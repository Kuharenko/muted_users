<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(RegisterRequest $request)
    {
        return User::create($request->validated());
    }

    public function show(User $user)
    {
        return $user;
    }

    public function destroy(User $user)
    {
        return $user->delete();
    }
}
