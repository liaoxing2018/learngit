<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('account/account-header', TEMPLATE_INCLUDEPATH)) : (include template('account/account-header', TEMPLATE_INCLUDEPATH));?>
<div class="alert alert-info hidden">
	<p><i class="fa fa-exclamation-circle"></i> 无主管理员时，创始人为默认主管理员；</p>
	<p><i class="fa fa-exclamation-circle"></i> 主管理员拥有公众号的所有权限，并且公众号的权限（模块、模板）根据主管理员来获取；</p>
	<p><i class="fa fa-exclamation-circle"></i> 操作员和管理员不允许删除公众号和编辑公众号资料；</p>
	<p><i class="fa fa-exclamation-circle"></i> 管理员可以管理操作员；</p>
</div>
<div id="js-account-manage-users" ng-controller="AccountManageUsers" ng-cloak>
	<table class="table we7-table table-hover">
		<col width="230px" />
		<col />
		<col />
		<tr>
			<th>权限</th>
			<th class="text-left">用户名</th>
			<th class="text-right">
				
				<?php  if($_W['isfounder'] && empty($owner)) { ?><span class="btn btn-link color-default" data-toggle="modal" data-target="#owner-modal">添加主管理员</span><?php  } ?>
				<span class="btn btn-link color-default" data-toggle="modal" data-target="#user-modal">添加使用者</span>
			</th>
		</tr>
		
		<tr>
			<td>主管理员</td>
			<td class="text-left" ng-bind="owner.username" ng-if="owner"></td>
			<td class="text-left" ng-bind="vice_founder.username" ng-if="!owner && vice_founder"></td>
			<td class="text-left" ng-if="!owner && !vice_founder">创始人</td>
			<td class="we7-padding-right text-right link-group">
			<?php  if(permission_check_account_user('see_account_manage_users_edit_owner')) { ?>
				<a href="javascript:;" ng-click="changeVice(owner.username)" ng-if="owner">修改</a>
				<a href="javascript:;" ng-click="delPermission(owner.uid)" ng-if="owner">删除</a>
			<?php  } ?>
			</td>
		</tr>
		<tr ng-repeat="item in manager" ng-if="manager">
			<td>管理员</td>
			<td class="text-left" ng-bind="item.username"></td>
			<td class="we7-padding-right text-right link-group">
			<?php  if(permission_check_account_user('see_account_manage_users_set_permission_for_manager')) { ?>
				<a href="javascript:;" ng-click="setPermission(item.uid)">权限设置</a>
			<?php  } ?>
			<?php  if(permission_check_account_user('see_account_manage_users_delmanager')) { ?>
				<a href="javascript:;" ng-click="delPermission(item.uid)">删除</a>
			<?php  } ?>
			</td>
		</tr>
		<tr ng-repeat="item in operator" ng-if="operator">
			<td>操作员</td>
			<td class="text-left" ng-bind="item.username"></td>
			<td class="we7-padding-right text-right link-group">
			<?php  if(permission_check_account_user('see_account_manage_users_set_permission_for_operator')) { ?>
				<a href="javascript:;" ng-click="setPermission(item.uid)">权限设置</a>
			<?php  } ?>
			<?php  if(permission_check_account_user('see_account_manage_users_deloperator')) { ?>
				<a href="javascript:;" ng-click="delPermission(item.uid)">删除</a>
			<?php  } ?>
			</td>
		</tr>

			
	</table>
	<!-- 添加主管理员模态框 -->
	<div class="modal" id="owner-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">添加账号主管理员</h3>
				</div>
				<div class="modal-body we7-form">
					<div class="form-group">
						<label class="col-sm-2 control-label">用户名</label>
						<div class="col-sm-10">
							<input id="add-owner-username" type="text" class="form-control">
							<span class="help-block">请输入完整的用户名。</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addOwner()">确认</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<!-- 添加账号操作员/管理模态框 -->
	<div class="modal" id="user-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">添加账号操作员/管理员</h3>
				</div>
				<div class="modal-body we7-form">
					<div class="form-group" ng-show="state == 'founder' || state == 'owner' || state == 'vice_founder'">
						<label class="control-label col-sm-2"></label>
						<div class="col-sm-10">
							<input type="radio" id="addtype-1" name="addtype" value="<?php echo ACCOUNT_MANAGE_TYPE_OPERATOR;?>" checked>
							<label for="addtype-1" class="radio-inline">操作员</label>
							<input class="addtype2" type="radio" id="addtype-2" name="addtype" value="<?php echo ACCOUNT_MANAGE_TYPE_MANAGER;?>">
							<label class="radio-inline" for="addtype-2">管理员</label>
							<?php  if(permission_check_account_user('see_account_manage_users_adduser')) { ?><a style="float: right" class="color-default" target = '_blank' href="<?php  echo url('user/create');?>">+添加用户</a><?php  } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">用户名</label>
						<div class="col-sm-10">
							<input id="add-username" type="text" class="form-control">
							<span class="help-block">请输入完整的用户名。</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addUsername()">确认</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="user-vice-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">添加账号副创始人</h3>
				</div>
				<div class="modal-body we7-form">
					<div class="form-group" ng-show="state == 'founder'">
						<label class="control-label col-sm-2"></label>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">创始人姓名</label>
						<div class="col-sm-10">
							<input id="add-vice-username" type="text" class="form-control">
							<span class="help-block">请输入完整的创始人名字。</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="addViceFounder()">确认</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	angular.module('accountApp').value('config', {
		vice_founder: <?php echo !empty($vice_founder) ? json_encode($vice_founder) : 'null'?>,
		owner: <?php echo !empty($owner) ? json_encode($owner) : 'null'?>,
		manager: <?php echo !empty($manager) ? json_encode($manager) : 'null'?>,
		operator: <?php echo !empty($operator) ? json_encode($operator) : 'null'?>,
		state: <?php echo !empty($state) ? json_encode($state) : 'null'?>,
		accountType: <?php echo !empty($_GPC['account_type']) ? json_encode($_GPC['account_type']) : '1'?>,
		links: {
			delete: "<?php  echo url('account/post-user/delete', array('acid' => $acid, 'uniacid' => $uniacid))?>",
			setPermission: "<?php  echo url('account/post-user/set_permission', array('acid' => $acid, 'uniacid' => $uniacid));?>",
			addUser: "<?php  echo url('account/post-user/set_manager', array('acid' => $acid, 'uniacid' => $uniacid))?>"
		}
	});
	angular.bootstrap($('#js-account-manage-users'), ['accountApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>