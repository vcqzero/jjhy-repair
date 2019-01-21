<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Settings;

class SettingsController extends Controller
{
    private $Request;
    private $Settings;
    
    public function __construct(Request $Request, Settings $Settings)
    {
        $this->Request = $Request;
        $this->Settings= $Settings;
    }
    
    public function index()
    {
        $check = Settings::query()->where('name', Settings::KEY_NEED_CHECK_WORKYARD_ON_CREAT)->first()->value;
        $offer = Settings::query()->where('name', Settings::KEY_CAN_OFFFER_REPAIR_ORDER)->first()->value;
        $offer_price = Settings::query()->where('name', Settings::KEY_CAN_OFFFER_PRICE)->first()->value;
        
        return response()->view('admin.settings.index', 
            [
                'check'  => $check,
                'offer'  => $offer,
                'offer_price'  => $offer_price,
            ]
            );
    }
}
