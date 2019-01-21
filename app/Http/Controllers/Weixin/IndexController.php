<?php
namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RepairOrder;
use Illuminate\Support\Facades\Auth;
use App\Model\Workyard;
use App\Model\Role;

class IndexController extends Controller
{
    private $Request;
    private $address_area;

    public function __construct(Request $Request)
    {
        $this->Request = $Request;
    }

    /**
     * 进入微信主页
     * 获取当前所有项目等待报单的维修单
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        //如果是项目管理员需要重定向到项目管理员控制器
        if($role == Role::WORKYARD_ADMIN) {
            return response()->view('weixin.repair-order.index');
        }
        
        //如果不是项目管理员
        $address_area = $this->Request->query('address_area');
        $repair_type_id = $this->Request->query('repair_type_id');
        $repair_type_name = $this->Request->query('repair_type_name');
        $page = $this->Request->query('page');
        
        $orders = $this->getPaginator($address_area, $repair_type_id);
        
        if ($page > 1) {
            return response()->view('weixin.index.paginator', [
                'orders' => $orders
            ]);
        } else {
            return response()->view('weixin.index.index', [
                'orders' => $orders,
                'address_area' => $this->address_area,
                'repair_type_name' => $repair_type_name
            ]);
        }
    }

    private function getPaginator($address_area, $repair_type_id)
    {
        if ($address_area) {
            $address_area_info = explode(',', $address_area);
            $province = $address_area_info[0] ?? '';
            $city = $address_area_info[1] ?? '';
        } else {
            // query from user
            $user = Auth::user();
            $province = $user->province;
            $city = $user->city;
            $address_area = $province . ',' . $city;
        }
        $this->address_area = $province . ',' . $city;
        $where = [
            'status' => 'WAIR_WORKER'
        ];
        if ($repair_type_id)
            $where['repair_type_id'] = $repair_type_id;
        
        // 进行分页查询
        $orders = RepairOrder::query()->where($where)
            ->whereHas('workyard', function ($query) use ($city) {
                if ($city) {
                    $query->where('city', $city);
                }
            })->orderBy('created_at', 'desc')->simplePaginate(3);
        
        return $orders;
    }
}
