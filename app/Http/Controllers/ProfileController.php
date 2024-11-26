<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('components.profile'); 
    }
    public function edit()
    {
        return view('components.edit');  // Load the edit.blade.php view
    }
}



