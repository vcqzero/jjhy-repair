<?php
namespace App\Filter;

use Zend\Filter\HtmlEntities;

class CheckWorkyardRecordFilter extends MyInputFilter
{
    public function getRules()
    {
        return [
            'workyard_id'=>[
                'name' => 'workyard_id',
                'filters' => [
                    [
                        'name' => \Zend\Filter\ToInt::class,//去掉首位空格
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
            
            'checked_by'=>[
                'name' => 'checked_by',
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
        ];
    }
}