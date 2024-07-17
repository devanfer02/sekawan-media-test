<?php

namespace App\Http\Services;

use App\Models\Log;

class LogService
{
    public function create(string $action)
    {
        Log::insert([
            'user_id' => auth()->user()->user_id,
            'action' => $action
        ]);
    }
}
