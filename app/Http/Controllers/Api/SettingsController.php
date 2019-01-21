<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Settings;
use App\Tool\MyAjax;

class SettingsController extends Controller
{
    private $Request;
    private $Settings;
    public function __construct(
        Request $Request,
        Settings $Settings
        )
    {
        $this->Request = $Request;
        $this->Settings = $Settings;
    }
    
    public function edit()
    {
        $name  = $this->Request->input('name');
        $value = $this->Request->input('value');
        try{
           $setting = Settings::query()->where('name', $name)->first();
           $setting->value = $value;
           $res = $setting->save();
        }catch (\Exception $e ){
           $res = false;        
        }
        $res = [
            MyAjax::SUBMIT_SUCCESS => $res,
            MyAjax::SUBMIT_MSG => '保存失败，服务器错误'
        ];
        return response()->json($res);
    }
    
}
