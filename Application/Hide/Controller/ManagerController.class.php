<?php
namespace Hide\Controller;

/**
 *简述：管理员管理控制器
 * 详情：
 * @date:2016-11-24
 * @author:mo
 * @version:1.1.0
 */
class ManagerController extends CommonController
{
    /**
     * 功能：管理员列表
    */
    public function index()
    {
        $managers = M('manager')->field('id,username,state,last_time,last_ip,login_num,create_date')->select();
        //dump($managers);die;
        $count = count($managers);
        $this->assign('managers', $managers);
        $this->assign('count', $count);
        $this->display();
    }

    /**
     *功能：添加管理员
    */
    public function add()
    {
        if( IS_POST ){
            $manager = D('Manager');
            if( !$manager->create() ){
                exit('添加失败! 原因：'.$manager->getError());
            }else{
                $manager->salt = time();
                $manager->password = md5(I('post.password').$manager->salt);
                $manager->create_date = date('Y-m-d H:i:s');
                if( $manager->add() ){
                    $this->success('添加成功', U('Manager/index'));
                }else{
                    $this->error('添加失败');
                }
            }
        }else{
            $this->display();
        }
    }

    /**
     * 功能：编辑管理员
    */
    public function edit()
    {
        if( IS_POST ){
            $manager = D('Manager');
            if( !$manager->create() ){
                exit('编辑失败! 原因：'.$manager->getError());
            }else{
                if(I('post.password')){
                    $manager->salt = time();
                    $manager->password = md5(I('post.password').$manager->salt);
                }else{
                    unset($manager->password);
                }
                if( $manager->save() ){
                    $this->success('编辑成功', U('Manager/index'));
                }else{
                    $this->error('编辑失败');
                }
            }
        }else{
            $map['id'] = I('get.id');
            if( $_SESSION['adminInfo']['username'] != 'admin'){
                $this->error('只有超级管理员才有此权限');
            }
            $manager = M('manager')->where($map)->field('id,username')->find();
            if($manager['username'] == 'admin'){
                $this->error('超级管理员不能被编辑');
            }
            $this->assign('manager', $manager);
            $this->display();
        }
    }

    /**
     * 功能：停用管理员
    */
    public function stop()
    {
        $map['id'] = I('get.id');
        if( $_SESSION['adminInfo']['username'] != 'admin'){
            $this->ajaxReturn('只有超级管理员才有此权限');
        }
        $manager = M('manager')->where($map)->field('username')->find();
        if($manager['username'] == 'admin'){
            $this->ajaxReturn('超级管理员不能被停用');
        }
        $data['id'] = $map['id'];
        $data['state'] = 0;
        $admin = M('manager');
        if( $admin->save($data) ){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn($admin->getError());
        }
    }

    /**
     * 功能：启用管理员
    */
    public function start()
    {
        $map['id'] = I('get.id');
        if( $_SESSION['adminInfo']['username'] != 'admin'){
            $this->ajaxReturn('只有超级管理员才有此权限');
        }
        $manager = M('manager')->where($map)->field('username')->find();
        $data['id'] = $map['id'];
        $data['state'] = 1;
        $admin = M('manager');
        if( $admin->save($data) ){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn($admin->getError());
        }
    }

    /**
     * 功能：删除管理员
    */
    public function del()
    {
        $map['id'] = I('get.id');
        if( $_SESSION['adminInfo']['username'] != 'admin'){
            $this->ajaxReturn('只有超级管理员才有此权限');
        }
        $manager = M('manager')->where($map)->field('username')->find();
        if($manager['username'] == 'admin'){
            $this->ajaxReturn('超级管理员不能被删除');
        }
        $admin = M('manager');
        if( $admin->where($map)->delete() ){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn($admin->getError());
        }

    }

}