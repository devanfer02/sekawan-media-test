<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role'])->paginate(10);

        return view('pages.users.index', compact('users'));
    }
}
