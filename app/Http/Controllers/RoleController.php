<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RoleController extends Controller
{
    public function index(){
        $users = User::all();
        if(Auth::user()->role !== User::ROLE_ADMIN){
            abort(403, '你是user 請你離開');
            return view('/');
        }
        return view('control',['users'=>$users]);
    }
    public function setAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        return redirect()->back()->with('notice', '用戶已更新為admin');
    }
    public function setUser(User $user)
    {
        $user->update(['role' => 'user']);
        return redirect()->back()->with('notice', '已送用戶下去為user');
    }    
    public function handle(Request $request, Closure $next)
    {
        $role = $request->route('user')->role;

        // 根据你的逻辑检查用户是否允许访问路由
        if ($role !== User::ROLE_ADMIN) {
            abort(403, 'Unauthorized'); // 如果不允许访问，抛出 403 错误
        }

        return $next($request);
    }

}
