<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrderGrade;

class RepairOrderGradeController extends Controller
{
    private $Request;
    public function __construct(
        Request $Request
        )
    {
        $this->Request = $Request;
    }
    
    public function getSelectData()
    {
        $repair_type = [];
        foreach (RepairOrderGrade::all() as $RepairType)
        {
            $repair_type[] = [
                'title' => $RepairType->desc,
                'value' => $RepairType->name,
            ];
        }
        return response()->json($repair_type);
    }
}
