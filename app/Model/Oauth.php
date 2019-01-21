<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Zend\Filter\HtmlEntities;

class Oauth extends Model
{
    const TYPE_WEIXIN = 'WEIXIN';//微信公众号
    /**
     * tablename
     * @var string
     */
    protected $table = 'oauth';
    
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * 执行模型是否自动维护时间戳.
     * 默认情况下, Eloquent 会假定
     * 你的表中存在 created_at 和 updated_at 字段. 
     * 如果你不想让 Eloquent 自动管理这俩个列, 
     * 可以在你的模型中将 $timestamps 属性设置为 false:
     * @var bool
     */
    public $timestamps = true;
    
    public function getFilterRules()
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
        ];
    }
    
    /**
    * 获取该oauth登录记录所属于user
    * 
    * @return User       
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
