<?php
namespace Hide\Model;
use Think\Model;

/**
 * 简述：管理员模型
 * 详情：
 * @date:2016-11-25
 * @author:mo
 * @version:1.1.0
*/

class ManagerModel extends Model
{
    protected $_validate = array(
        array('username', '', '账号已存在', 0, 'unique'),
        array('password2', 'password', '密码不一致', 0, 'confirm'),
    );
}