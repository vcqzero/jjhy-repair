<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use Illuminate\Support\Facades\Hash;
use App\Model\Role;

class CreateSuperUser
{
    private $User;
    public function __construct(User $User){
        $this->User = $User;
    }
    /**
     * create super user if not exist
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $super_user = config('custome.super_user');
        $username = $super_user['username'];
        $password = $super_user['password'];
        $super_user['password']= Hash::make($password);
        $super_user['role']= Role::SUPER_USER;
//         $super_user['created_at'] = time();
        User::query()->firstOrCreate(['username'=> $username], $super_user);
        return $next($request);
    }
}
