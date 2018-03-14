<?php
namespace Oa\Controller;
use Think\Controller;

class EmptyController extends Controller {
	public function index(){
		header("HTTP/1.0 404 Not Found");//使HTTP返回404状态码
        $this->display("Error:404");
	}
}