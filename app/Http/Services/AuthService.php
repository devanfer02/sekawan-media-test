<?php

namespace App\Http\Services;

use App\Exceptions\ServiceException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class AuthService
{
    public function login(Request $data)
    {
        try {
            $isMatch = Auth::attempt($data->only('email', 'password'), isset($data['remember']));

            if (!$isMatch)
            {
                throw new ServiceException("Credentials doesn't match");
            }
        } catch (\Exception $e) {
            error_log("AuthService: " . $e->getMessage());

            if (!($e instanceof ServiceException))
            {
                throw new Exception("Failed to login user");
            }

            throw $e;
        }
    }

    public function register(Request $data)
    {
        try {
            $role = Role::where('role_name', '=', 'Approver')->first();

            if (!isset($role))
            {
                throw new ServiceException("Role Approver doesn't exists");
            }

            User::insert([
                'user_id' => Uuid::uuid7(),
                'role_id' => $role->role_id,
                'email' => $data['email'],
                'fullname' => $data['fullname'],
                'password' => Hash::make($data['password']),
            ]);

        } catch (\Exception $e) {
            error_log("AuthService: " . $e->getMessage());

            if (!($e instanceof ServiceException))
            {
                throw new Exception("Failed to register user");
            }

            throw $e;
        }
    }
}
