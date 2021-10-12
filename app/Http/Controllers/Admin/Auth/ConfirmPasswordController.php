<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;

class ConfirmPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
