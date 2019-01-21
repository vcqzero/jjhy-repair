<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $prefix = Request::route()->getPrefix();
        
        if ($prefix == '/weixin') return route('weixin/login');
        //默认情况下进行pc login 页面
        return route('admin/login');
    }
}
