<?php

namespace app\http\middleware;


class CheckAdmin
{
	use \traits\controller\Jump;
    public function handle($request, \Closure $next)
    {
    	if(empty(session('loginAdmin'))){
    		return $this->error('请您先去登录哦!','/admin/login');
    	}
    	return $next($request);
    }
}
