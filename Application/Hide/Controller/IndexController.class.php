<?php
namespace Hide\Controller;

/**
 *简述：后台首页控制器
 * 详情：
 * @date:2016-11-23
 * @author:mo
 * @version:1.1.0
 */
class IndexController extends CommonController
{
    public function index()
    {
        $this->assign('adminInfo', $_SESSION['adminInfo']);
        $this->display();
    }

    public function welcome()
    {
        $this->display();
    }

}