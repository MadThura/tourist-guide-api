<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContoller extends Controller
{
    public function toggleDarkMode()
    {
        session(['dark_mode' => !session('dark_mode', false)]);

        // Optional: redirect back with a message or just back
        return redirect()->back();
    }
}
