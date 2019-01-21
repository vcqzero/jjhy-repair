<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Model\Website;
/**
 * 会将所有站点的配置信息返回
 * 
 * @author 12508
 *
 */
class WebsiteAdminComposer
{
    public function __construct()
    {
        
    }
    
    public function compose(View $View)
    {
        $record = '';
        $title  = '';
        $ico    = '';
        $admin  = Website::query()->where('website', 'admin')->first();
        if($admin) {
            $record = $admin->record;
            $title  = $admin->title;
            $ico    = $admin->ico;
        }
        
        $View->with('record', $record);
        $View->with('title', $title);
        $View->with('ico', $ico);
    }

}
