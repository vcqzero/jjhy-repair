<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    private $Request;
    
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
//         $file = '/storage/img/website/admin/JxATArIRdSHr1HyI50YRZyNA1N8dMiJ6XK47v6GA.ico';
//         $file = str_replace('storage', 'public', $file);
//         Storage::delete($file);
        return response()->view('admin.website.index');
    }
    
    public function api()
    {
        return response()->view('admin.website.api', 
            [
                'mail'  => config('mail'),
                'weixin'=> config('custome.weixin'),
            ]
            );
    }
}
