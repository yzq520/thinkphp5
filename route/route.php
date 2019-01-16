<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});
//后台登录显示页
Route::rule('/admin/login','admin/LoginController/login');
//后台登录执行
Route::rule('/admin/do_login','admin/LoginController/do_login');
//检测用户名是否存在
Route::rule('/admin/search_uname','admin/UserController/search_uname');
//显示验证码
Route::rule('/admin/code','admin/LoginController/code');
//退出登录
Route::rule('/admin/logout','admin/LoginController/logout');
//admin用户管理路由组
Route::group([],function(){
//后台首页
Route::rule('/admin/index','admin/LoginController/index');
//显示用户列表
Route::get('/admin/user_index','admin/UserController/index');
//显示添加页
Route::rule('/admin/user_create','admin/UserController/create');
//执行添加
Route::rule('/admin/user_save','admin/UserController/save');
//删除用户
Route::rule('/admin/user_delete/:id','admin/UserController/delete');
//显示修改页
Route::rule('/admin/user_edit/:id','admin/UserController/edit');
//执行用户修改
Route::rule('/admin/user_update/:id','admin/UserController/update');
//显示修改密码页
Route::rule('/admin/user_editpwd/:id','admin/UserController/editpwd');
//执行用户密码修改
Route::rule('/admin/user_updatepwd/:id','admin/UserController/updatepwd');
//用户禁用
Route::rule('/admin/user_jy/:id','admin/UserController/jy');
//用户启用
Route::rule('/admin/user_qy/:id','admin/UserController/qy');
//用户回收站
Route::get('/admin/user_hui','admin/UserController/hui');
})->middleware('CheckAdmin');
//分类管理路由组
Route::group(['name'=>'/admin/','prefix'=>'admin/TypeController/'],function(){
	//分类列表页
	Route::rule('type_index','index');
	//显示添加页
	Route::rule('type_create/[:id]','create');
	//执行分类添加
	Route::rule('type_save','save');
	//显示修改页
	Route::rule('type_edit/:id','edit');
	//执行修改
	Route::rule('type_update/:id','update');
	//删除分类
	Route::rule('type_delete/:id','delete');
})->middleware('CheckAdmin');
//商品管理路由组
Route::group(['name'=>'/admin/','prefix'=>'admin/GoodsController/'],function(){
	//商品添加页
	Route::rule('goods_create','create');
	//执行商品添加
	Route::rule('goods_save','save');
	//商品显示页
	Route::rule('goods_index','index');
	//删除商品
	Route::rule('goods_delete/:id','delete');
	//修改商品页
	Route::rule('goods_edit/:id','edit');
	//执行修改商品
	Route::rule('goods_update/:id','update');
})->middleware('CheckAdmin');
//网站配置路由组
Route::group(['name'=>'/admin/','prefix'=>'admin/ConfigController/'],function(){
	//网站配置列表显示页
	Route::rule('config_index','index');
	//网站配置添显示加页
	Route::rule('config_create','create');
	//网站配置添加执行页
	Route::rule('config_save','save');
	//网站配置禁用
	Route::rule('config_jy/:id','jy');
	//网站配置启用
	Route::rule('config_qy/:id','qy');
	//网站配置修改显示页
	Route::rule('config_edit/:id','edit');
	//网站配置执行修改
	Route::rule('config_update/:id','update');
})->middleware('CheckAdmin');
//user用户管理路由组
Route::group(['name'=>'/admin/','prefix'=>'admin/HomeController/'],function(){
	//前台用户显示页
	Route::rule('home_index','index');
	//删除用户
	Route::rule('home_delete/:id','delete');
	//修改用户显示
	Route::rule('home_edit/:id','edit');
	//修改用户执行页
	Route::rule('home_update/:id','update');
	//用户禁用
	Route::rule('home_jy/:id','jy');
	//用户启用
	Route::rule('home_qy/:id','qy');
	//用户回收站
	Route::get('home_hui','hui');
})->middleware('CheckAdmin');
	//前台首页管理
	Route::rule('/home/index','home/IndexController/index');
	//前台商品列表页显示
	Route::rule('/home/goods_index/[:id]','home/GoodsController/index');