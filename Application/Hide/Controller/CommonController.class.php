<?php
namespace Hide\Controller;
use Think\Controller;
/**
 *简述：公共控制器
 * 详情：
 * @date:2016-11-23
 * @author:mo
 * @version:1.1.0
 */
class CommonController extends Controller
{
    /**
     * 功能：初始化函数，验证后台用户是否登陆
     */
    public function _initialize()
    {
        if( !session('?adminInfo') )
        {
            $this->redirect('Login/login');
        }
    }
}