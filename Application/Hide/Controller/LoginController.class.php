<?php
namespace Hide\Controller;
use Think\Controller;
/**
 *简述：登录控制器
 * 详情：
 * @date:2016-11-23
 * @author:mo
 * @version:1.1.0
 */
class LoginController extends Controller
{
    /**
     *功能：后台管理员登录
     */
    public function login()
    {
        if( IS_POST )
        {
            //dump($_POST);die;
            //判断验证码
            $Verify = new \Think\Verify();
            if(!$Verify->check(I('post.code'))){
                $this->error('验证码错误');
            }
            $where['username'] = I('post.username');
            //以用户名为条件在数据库查询
            $manager = M('Manager')->where($where)->field('password,salt,state,last_time,last_ip,login_num')->find();
            // var_dump($manager);die;
            if( empty($manager) ){
                $this->error('用户名不存在');
            }else {
                if ($manager['state'] == 0) {
                    $this->error('你的账号已停用');
                }
                $password = md5(I('post.password').$manager['salt']);
                if( $password != $manager['password']){
                    $this->error('密码错误');
                }else{
                    $data['salt'] = time();
                    $data['password'] = md5(I('post.password').$data['salt']);
                    $data['last_time'] = date('Y-m-d H:i:s');
                    $data['last_ip'] = ip2long( get_client_ip());
                    $data['login_num'] = $manager['login_num'] + 1;
                    $newManager = M('manager')->where($where)->save($data);

                    $adminInfo['username'] = I('post.username');
                    $adminInfo['last_time'] = $manager['last_time'];
                    $adminInfo['last_ip'] = long2ip($manager['last_ip']);
                    $adminInfo['login_num'] = $manager['login_num'];

                    $_SESSION['adminInfo'] = $adminInfo;
                    $this->success('登录成功', U('Index/index'));
                }
            }
        }
        else
        {
            $this->display();
        }
    }

    /**
     * 功能：退出登录
    */
    public function logout()
    {
        $_SESSION['adminInfo'] = null;
        $this->redirect('login');
    }

    /**
     * 功能：生成后台登录验证码
     */
    public function code()
    {
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 16;
        $Verify->length   = 3;
        $Verify->useNoise = false;
        $Verify->fontttf = '5.ttf';
        $Verify->entry();
    }

    //添加初始管理员
    public function admin()
    {
        $manager = M('manager');
        $data['username'] = 'admin';
        $data['salt'] = time();
        $data['password'] = md5('admin'.$data['salt']);
        $manager->add($data);
    }
}