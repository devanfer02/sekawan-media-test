<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;

class AuthService
{
    public function login(Request $data)
    {
        $isMatch = Auth::attempt($data->only('email', 'password'), isset($data['remember']));

        if (!$isMatch)
        {
            throw new Exception("Credentials doesn't match");
        }
    }

    public function register(Request $data)
    {
        $data['password'] = Hash::make($data['password']);

        $role = Role::where('role_name', '=', 'Admin')->first();

        if (!isset($role))
        {
            throw new Exception("Role name Admin doesn't exists");
        }

        $data['role_id'] = $role->role_id;

        User::create($data->array());
    }
}
