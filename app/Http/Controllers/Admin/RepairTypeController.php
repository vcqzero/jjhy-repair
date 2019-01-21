<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ItemType;
use App\Model\RepairType;

class RepairTypeController extends Controller
{
    private $Request;
    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }
    
    public function index()
    {
        return response()->view('admin.repair-type.index');
    }
    
    public function add()
    {
        return response()->view('admin.repair-type.add');
    }
    public function edit($id)
    {
        $ItemType = RepairType::query()->find($id);
        return response()->view('admin.repair-type.edit', ['ItemType'=> $ItemType]);
    }
    public function delete($id)
    {
        $ItemType = RepairType::query()->find($id);
        return response()->view('admin.repair-type.delete', ['ItemType'=> $ItemType]);
    }
}
