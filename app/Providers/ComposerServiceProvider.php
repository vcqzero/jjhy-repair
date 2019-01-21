<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Http\ViewComposers\SidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\ViewComposers\WebsiteAdminComposer;
use App\Http\ViewComposers\ProfileComposer;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        
        // 使用基于类的 composer...
        $this->admin();
        $this->weixin();
    }
    
    private function admin()
    {
        //get admin website info
        View::composer([
            'admin.website.partial.tab-website-admin-setting',
            'admin.layout.layout*'
        ], WebsiteAdminComposer::class);
        
        //get identity
        View::composer([
            'admin.layout.partial.top-nav-profile',
        ], ProfileComposer::class);
        
        //sidebar
        View::composer('admin.layout.partial.sidebar', SidebarComposer::class);
    }
    
    private function weixin()
    {
        //get admin website info
        View::composer([
            'weixin.layout.layout*'
        ], WebsiteAdminComposer::class);
    }
}
