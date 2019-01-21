<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileComposer
{
    public function __construct()
    {
        
    }
    
    public function compose(View $View)
    {
        $user = Auth::user();
        $View->with('identity', $user);
    }
}
