<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Model\Role;

class SidebarComposer
{
    public function __construct()
    {
        
    }
    
    public function compose(View $View)
    {
        $all_section_menus = $this->getMenu();
        
        $View->with('all_section_menus', $all_section_menus);
    }
    
    private function getMenu($role=Role::SUPER_USER)
    {
        $all_section_menus = $this->getAllSectionMenus();
        $all_section_menus = $this->filter($all_section_menus, $role);
        return $all_section_menus;
    }
    
    private function filter($all_section_menus, $role)
    {
        // 首先判断用户角色是否允许
        foreach ($all_section_menus as $section_key => $section) {
            $menus = $section['menus'];
            foreach ($menus as $menus_key => $menu) {
                $submenus = $menu['submenus'];
                foreach ($submenus as $submenus_key => $submenu) {
                    $allow = $submenu['allow'];
                    if (empty($allow)) {
                        continue;
                    }
                    if (in_array($role, $allow)) {
                        continue;
                    }
                    unset($all_section_menus[$section_key][$menus_key]['submenus'][$submenus_key]);
                }
            }
        }
        
        // 然后将不含子菜单的删除
        foreach ($all_section_menus as $section_key => $section) {
            $menus = $section['menus'];
            foreach ($menus as $key2 => $menu) {
                $submenus = $menu['submenus'];
                if (empty($submenus)) {
                    unset($navbars[$section_key][$key2]);
                }
            }
        }
        
        // 然后将不含子菜单的删除
        foreach ($all_section_menus as $section_key => $section) {
            $menus = $section['menus'];
            if (empty($menus)) {
                unset($navbars[$section_key]);
            }
        }
        
        return $all_section_menus;
    }
    
    private function getAllSectionMenus()
    {
        return [
            '操作台部分' => [
            //                 'section-title' => '首页',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'icon-home',
                        'title' =>'首页',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/',
                                'title' => '首页',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                ],//end menus
            ],
            
            '维修订单' => [
                'section-title' => '报修管理',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'fa fa-wrench',
                        'title' =>'报修管理',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/repair-order',
                                'title' => '报修订单',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                ],//end menus
            ],
            
            '工作统计' => [
                'section-title' => '工作统计',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'fa fa-list',
                        'title' =>'工作统计',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/worker/worker-job',
                                'title' => '工作统计',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                ],//end menus
            ],
            
            '项目/维修工程师' => [
                'section-title' => '项目/维修工程师',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'fa fa-road',
                        'title' =>'项目管理',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/workyard',
                                'title' => '项目管理',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                    'menu-2' =>  [
                        'icon'  => 'fa fa-binoculars',
                        'title' =>'项目管理员',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/workyard-admin',
                                'title' => '项目管理员',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                    'menu-3' =>  [
                        'icon'  => 'fa fa-users',
                        'title' =>'维修工程师',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/worker',
                                'title' => '维修工程师',
                                'allow' => [
                                    Role::SUPER_USER
                                ],
                            ],
                        ],//end submenus
                    ],
                ],//end menus
            ],
            
            '站点设置部分' => [
                'section-title' => '系统设置',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'icon-grid',
                        'title' => '设备管理',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/repair-type',
                                'title' => ' 设备管理',
                                'allow' => [
                                    Role::SUPER_USER,
                                ],
                            ],
                        ],//end submenus
                    ],
                    
                    'menu-2' =>  [
                        'icon'  => 'icon-settings',
                        'title' =>'基本设置',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/settings',
                                'title' => '基本设置',
                                'allow' => [
                                    Role::SUPER_USER,
                                ],
                            ],
                        ],//end submenus
                    ],
                    
                    'menu-3' =>  [
                        'icon'  => 'icon-screen-desktop',
                        'title' =>'站点设置',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/website',
                                'title' => '站点设置',
                                'allow' => [
                                    Role::SUPER_USER,
                                ],
                            ],
//                             'submenu-2'=>[
//                                 'icon' => '',
//                                 'href' => '/website/api',
//                                 'title' => 'API接口',
//                                 'allow' => [
//                                     Role::SUPER_USER,
//                                 ],
//                             ],
                        ],//end submenus
                    ],
                ],//end menus
            ],
            
            '账户中心' => [
                'section-title' => '账户中心',
                'menus' => [
                    'menu-1' =>  [
                        'icon'  => 'fa fa-user',
                        'title' =>'我的账户',
                        'submenus' => [
                            'submenu-1'=>[
                                'icon' => '',
                                'href' => '/account',
                                'title' => '个人中心',
                                'allow' => [
                                    Role::SUPER_USER,
                                ],
                            ],
                            
                        ],//end submenus
                    ],
                ],//end menus
            ],
        ];
    }
}
