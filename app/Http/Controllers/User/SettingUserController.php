<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SettingUserController extends Controller
{
    public function index()
    {
        return view('user.settings.index');
    }
}
