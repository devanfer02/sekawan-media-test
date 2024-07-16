<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(Request $request)
    {
        $request->validate($this->loginRules(), $this->loginRulesMessage());

        try {
            $this->authService->login($request);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        $request->validate($this->registerRules(), $this->registerRulesMessage());

        try {
            $this->authService->register($request);

            return redirect()->route('login');
        } catch (\Exception $e) {
            return redirect()->route('auth.pages.register')->with('failed', $e->getMessage());
        }
    }

    private function registerRules(): array
    {
        return [
            'fullname' => 'required|min:4|max:150',
            'email' => 'required|email',
            'password' => 'required|min:6|max:50|alpha_num:ascii'
        ];
    }

    private function registerRulesMessage(): array
    {
        return [
            'fullname.required' => 'Fullname field is required',
            'fullname.min' => 'Fullname field min length is 4 characters',
            'fullname.max' => 'Fullname field max length is 150 characters',
            'email.required' => 'Email field is required',
            'email.email' => 'Email input is not a valid email',
            'password.required' => 'Password field is required',
            'password.min' => 'Password field min length is 6 characters',
            'password.max' => 'Password field max length is 50 characters',
            'password.alpha_num' => 'Password must contain alpha numeric characters'
        ];
    }

    private function loginRules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    private function loginRulesMessage(): array
    {
        return [
            'email.required' => 'Email field is required',
            'email.email' => 'Email input is not a valid email',
            'password.required' => 'Password field is required'
        ];
    }
}
