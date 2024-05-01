<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    public function index(){
        $users = User::all();
        return view('control',['users'=>$users]);
    }
    public function setAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        return redirect()->back()->with('notice', '用戶已更新為admin');
    }

}
