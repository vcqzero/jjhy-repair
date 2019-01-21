<?php
namespace App\Filter;

use Zend\Filter\HtmlEntities;

class WorkyardFilter extends MyInputFilter
{
    public function getRules()
    {
        return [
            'name'=>[
                'name' => 'name',
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
            
            'province'=>[
                'name' => 'province',
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
            'city'=>[
                'name' => 'city',
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
            'district'=>[
                'name' => 'district',
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
            'address'=>[
                'name' => 'address',
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