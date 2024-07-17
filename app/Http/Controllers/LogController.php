<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')->paginate(10);

        return view('pages.logs.index', compact('logs'));
    }
}
