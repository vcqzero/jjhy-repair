<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Website;
use App\Tool\MyAjax;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestSmtp;
use App\Service\Weixiner;

class WebsiteController extends Controller
{
    private $Request;
    private $Website;
    public function __construct(
        Request $Request,
        Website $Website
        )
    {
        $this->Request = $Request;
        $this->Website = $Website;
    }
    
    public function editWebsite(Website $Website)
    {
        $website    = $this->Request->query('website');
        $key        = $this->Request->input('name');
        $value      = $this->Request->input('value');
        //获取用户提交表单
        $where = ['website' => $website];
        $website    = $this->Website->query()->firstOrNew($where, $where);
        $website->$key = $value;
        $res = $website->save();
        //ajax
        $res = [
            MyAjax::SUBMIT_MSG => $res,
            MyAjax::SUBMIT_SUCCESS => $res === true,
        ];
        return response()->json($res);
    }
    
    /**
    * upload ico logo
    * 
    * @param  
    * @return        
    */
    public function upload()
    {
        $name = $this->Request->input('name');
        $file = $this->Request->file($name);
        $website= $this->Request->input('website');
        try {
            //dir to store
            $dir_website = Website::DIR_WEBSITE . '/' . $website . '/' . $name;
            //delete old
            Storage::deleteDirectory('public/' . $dir_website);
            //filename
            $path = $this->Request->file($name)->store($dir_website, 'public');
            $url  = Storage::url($path);
            //update 
            $website    = $this->Website->query()->where('website', $website)->first();
            $website->$name = $url;
            $res = $website->save();
        } catch (\Exception $e ) {
            $url = $e->getMessage();
            $res = false;
        }
        
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res,
            'url' => $url,
        ];
        
        return response()->json($res);
    }
    
    public function testEmail()
    {
        try {
            $email = $this->Request->input('email');
            Mail::to($email)->send(new TestSmtp());
            $res = true;
        }catch (\Exception $e ) {
            $res = $e->getMessage();        
        }
        
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res === true,
            MyAjax::SUBMIT_MSG => $res,
        ];
        
        return response()->json($res);
    }
    
    public function testWeixin(Weixiner $Weixiner)
    {
        $res = $Weixiner->getAccessToken(true);       
        $res = [
            MyAjax::SUBMIT_SUCCESS => true,
            MyAjax::SUBMIT_MSG => $res,
        ];
        
        return response()->json($res);
    }
}
