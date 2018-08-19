<?php
/**
 * lx_article模块PC接口定义
 *
 * @author 药争先
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Lx_articleModuleWebapp extends WeModuleWebapp {
	public function doPageTest(){
		global $_GPC, $_W;
		$errno = 0;
		$message = '返回消息';
		$data = array();
		return $this->result($errno, $message, $data);
	}

}