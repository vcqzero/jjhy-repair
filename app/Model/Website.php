<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    const CONFIG_NAME_WEBSITE = 'websites.php';
    
    const WEBSITE_ADMIN = 'admin';
    
    const DIR_AVATAR  = '/avatar';//保存用户头像的文件，相对于public
    const DIR_WEBSITE = '/website';//保存站点ico或loge等文件，相对于public
    
    protected $table = 'websites';
    
    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
}
