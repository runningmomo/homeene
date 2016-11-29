<?php
return array(
	//'配置项'=>'配置值'
    //数据库的配置
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'homeene',          // 数据库名
    'DB_USER'               =>  'homeene',      // 用户名
    'DB_PWD'                =>  'myj123',          // 密码
    'DB_PORT'               =>  '3306',        // 端口

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>true,   //正式环境需注释掉

    'URL_MODEL'          => '2', //URL模式
    'SESSION_AUTO_START' => true, //是否开启session

    'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'hide'  => 'Hide',  // hide.domain.com域名指向Hide模块
        'www'   => 'Home',  // www.domain.com域名指向Home模块
    ),
);