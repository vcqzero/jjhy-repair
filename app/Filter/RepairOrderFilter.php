<?php
namespace App\Filter;

use Zend\Filter\HtmlEntities;

class RepairOrderFilter extends MyInputFilter
{
    public function getRules()
    {
        return [
            'order'=>[
                'name' => 'order',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            
            'created_by'=>[
                'name' => 'created_by',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            'workyard_id'=>[
                'name' => 'workyard_id',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            
            'repair_type_id'=>[
                'name' => 'repair_type_id',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            'desc'=>[
                'name' => 'desc',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            
            'contact_user'=>[
                'name' => 'contact_user',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            'contact_tel'=>[
                'name' => 'contact_tel',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            'grade'=>[
                'name' => 'grade',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    [
                        'name' => \Zend\Filter\StringToUpper::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
            'status'=>[
                'name' => 'status',
                'filters' => [
                    [
                        'name' => \Zend\Filter\StringTrim::class,//去掉首位空格
                    ],
                    [
                        'name' => \Zend\Filter\StringToUpper::class,//去掉首位空格
                    ],
                    
                    [
                        'name' => HtmlEntities::class,//html安全过滤
                        'options' =>[
                            'quotestyle' => ENT_NOQUOTES,//保留单引号和双引号
                        ],
                    ],
                ],
            ],
        ];
    }
}