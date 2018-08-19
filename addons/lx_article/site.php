<?php
/**
 * lx_article模块微站定义
 *
 * @author 药争先
 * @url 
 */
defined('IN_IA') or exit('Access Denied');

class Lx_articleModuleSite extends WeModuleSite {

	public function doMobilePoster_mange() {
		//这个操作被定义用来呈现 功能封面
		global $_W;
		$result=checkauth();
		$username=$_W["member"]["realname"]?$_W["member"]["realname"]:$_W["member"]["mobile"];
//		print_r($_W["fans"]);
		include $this->template('index');

	}
	public function doWebAdd_article() {
		//这个操作被定义用来呈现 管理中心导航菜单
		include $this->template('addop');
	}
	public function doWebArticle_list(){

		global $_GPC;
		if(isset($_GPC["op"])&&$_GPC["op"]=="add"){
			$add_data = array(
					'title' => $_GPC["title"],
					'author' => $_GPC["author"],
					'content' => $_GPC["content"],
			);
			$result = pdo_insert('articles_list', $add_data);
			if (!empty($result)) {
				message('添加成功！',referer(),"success");
			}
			include $this->template('list');

		}else if(isset($_GPC["op"])&&$_GPC["op"]=="edit"){
			$id = $_GPC["id"];
			$result = pdo_get('articles_list', array('Id =' => $id));

			include $this->template('edit');
		}else if(isset($_GPC["op"])&&$_GPC["op"]=="del") {
			$id = $_GPC["id"];
			$result = pdo_delete('articles_list', array('Id' => $id));
			if (!empty($result)) {
				message('删除成功');
			}
		}else if(isset($_GPC["op"])&&$_GPC["op"]=="update"){
			$id = $_GPC["id"];
			$user_data = array(
					'title' =>$_GPC["title"],
					'author'=>$_GPC["author"],
					'content'=>$_GPC["content"],
			);
			$result = pdo_update('articles_list', $user_data, array('id' => $id));
			if (!empty($result)) {
				message('更新成功');
			}
		}
//		$sql = "SELECT * FROM ".tablename('articles_list');
		$list1=pdo_getall("articles_list");

		include $this->template('list');
	}
	public function doWebDel_article() {
		//这个操作被定义用来呈现 管理中心导航菜单
	}
		public function doMobileLogo() {
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobileMy_index() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doWebIndependent_function() {
		//这个操作被定义用来呈现 微站独立功能
	}

	

}