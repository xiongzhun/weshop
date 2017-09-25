<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="we7-page-title">会员组</div>
<ul class="we7-page-tab">
	<li <?php  if(($do == 'display' || $do == 'post') && $_GPC['a'] == 'member') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('mc/member')?>">会员管理</a>
	</li>
	<li <?php  if($_GPC['a'] == 'group') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('mc/group')?>">会员组</a>
	</li>
	<li<?php  if($do == 'uc') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('site/editor/uc')?>">会员中心</a>
	</li>
	<li <?php  if($do == 'quickmenu') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('site/editor/quickmenu', array('type' => 4))?>">快捷菜单</a>
	</li>
	<li <?php  if($do == 'credit_setting') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('mc/member/credit_setting')?>">积分设置</a>
	</li>
	<li <?php  if($do == 'register_setting') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo url('mc/member/register_setting')?>">注册设置</a>
	</li>
</ul>
<div class="alert we7-page-alert">
	<p><strong class="text-danger"><i class="wi wi-info-sign"></i> 会员组的总积分是根据(积分+贡献)的值算出来的,管理员不能直接修改会员所在的会员组. 如果需要修改会员组,请通过设置积分或者贡献的值来影响总积分,系统会根据影响后的总积分自动算出对应的会员组</strong></p>
	<p><i class="wi wi-info-sign"></i>默认会员组的积分需设置为 0</p>
	<p><i class="wi wi-info-sign"></i> 系统会根据会员的总积分(积分+贡献)多少自动对会员的分组进行调整</p>
</div>
<div id="js-member-group" ng-controller="group" ng-cloak>
	<div class="text-right we7-margin-bottom">
		<button class="btn btn-default" data-toggle="modal" data-target="#modal-change-group">会员组变更设置</button>
		<button type="button" class="btn btn-primary" ng-click="set_group_detail_info()">增加会员组</button>
	</div>
	<table class="table we7-table table-hover vertical-middle">
		<col width="200px"/>
		<col />
		<col />
		<col width="200px"/>
		<tr>
			<th>会员组名称</th>
			<th>所需总积分(积分+贡献)</th>
			<th>会员数</th>
			<th class="text-right">操作</th>
		</tr>
		<tr ng-repeat="group in group_list">
			<td>
				{{ group.title }}
				<span class="label label-info" ng-if="group.isdefault == 1">默认</span>
			</td>
			<td>{{ group.credit }}</td>
			<td>{{ group_person_count[group.groupid].num == undefined ? 0 : group_person_count[group.groupid].num}}</td>
			<td>
				<div class="link-group">
					<a href="javascript:;" ng-click="set_group_detail_info(group.groupid)">编辑</a>
					<a href="javascript:;" class="del" ng-click="del_group(group.groupid)">删除</a>
					<a href="javascript:;" ng-if="group.isdefault != 1" ng-click="set_default(group.groupid)">设为默认</a>
				</div>
			</td>
		</tr>
	</table>

	<div class="modal fade modal-change-group" id="modal-change-group"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form we7-form" id="">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">会员组变更设置</h4>
					</div>
					<div class="modal-body we7-padding-horizontal">
						<div class="form-group">
							<input type="radio" name="grouplevel" value="0" id="group_level-0" ng-model="group_level"/>
							<label for="group_level-0">不自动变更</label>
							<span class="help-block">
								会员组的变更只能通过管理员来变更。
							</span>
						</div>
						<div class="form-group">
							<input type="radio" name="grouplevel" value="1" id="group_level-1" ng-model="group_level"/>
							<label for="group_level-1">根据积分多少自动升降</label>
							<span class="help-block">
								系统根据当前会员的总积分，按照每个会员组所需总积分的设置进行变更。可自动升降。
							</span>
						</div>
						<div class="form-group">
							<input type="radio" name="grouplevel" value="2" id="group_level-2" ng-model="group_level"/>
							<label for="group_level-2">根据积分多少只升不降</label>
							<span class="help-block">
								系统根据当前会员的总积分，如果会员的总积分达到更高一级的会员组，则变更会员组，如果积分少于当前所在会员组所需总积分，保持当前会员组不变，不会降级。
							</span>
						</div>
					</div>
					<div class="modal-footer">
						<button  class="btn btn-primary" type="button" ng-click="change_group_level()">保存</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<input type="hidden" name="token" value="c781f0df">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="group_detail"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog we7-modal-dialog" style="width:800px">
			<div class="modal-content">
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal form" id="form-info">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">{{ group_detail.groupid != unidefined ? '编辑' : '增加'}}会员组</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">会员组名称</label>
							<div class="col-sm-10">
								<input type="text" name="title" ng-model="group_detail.title" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">所需积分</label>
							<div class="col-sm-10">
								<input type="text" name="title" ng-model="group_detail.credit" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button  class="btn btn-primary" type="button" ng-click="save_group()">保存</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						<input type="hidden" name="token" value="c781f0df">
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<script>
	angular.module('memberAPP').value('config', {
		'group_level' : '<?php  echo $group_level;?>',
		'change_group_level_url' : "<?php  echo url('mc/group/change_group_level')?>",
		'group_list' : <?php  echo json_encode($group_list)?>,
		'group_person_count' : <?php  echo json_encode($group_person_count)?>,
		'save_group_url' : "<?php  echo url('mc/group/save_group')?>",
		'get_group_url' : "<?php  echo url('mc/group/get_group')?>",
		'set_default_url' : "<?php  echo url('mc/group/set_default')?>",
		'del_group_url' : "<?php  echo url('mc/group/del_group')?>",
		'default_group' : <?php  echo json_encode($default_group)?>
	});
	angular.bootstrap($('#js-member-group'), ['memberAPP']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
