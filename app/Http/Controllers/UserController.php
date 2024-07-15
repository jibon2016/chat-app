<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser()
    {
        return User::where('id' ,'!=', auth()->id() )->get();
    }

    public function getAuthUser() 
    {
        return auth()->user();

    }
}
