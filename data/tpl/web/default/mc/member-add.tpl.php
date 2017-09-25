<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<?php  if($do == 'add') { ?>
<ol class="breadcrumb we7-breadcrumb">
	<a href="<?php  echo url('mc/member/display')?>"><i class="wi wi-back-circle"></i> </a>
	<li>
		<a href="<?php  echo url('mc/member/display')?>">会员管理</a>
	</li>
	<li>
		添加会员
	</li>
</ol>
<form action="./index.php?c=mc&a=member&do=add" method="post" class="we7-form" role="form" id="form1">
			<div class="form-group">
				<label class="col-sm-2 control-label">会员姓名</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" name="realname" value="" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">手机号</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" name="mobile" value="" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">登录密码</label>
				<div class="col-sm-9 col-xs-12">
					<input type="password" name="password" value="" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">邮箱</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" name="email" value="" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">积分</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" name="credit1" value="0" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">余额</label>
				<div class="col-sm-9 col-xs-12">
					<input type="text" name="credit2" value="0" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">会员组</label>
				<div class="col-sm-9 col-xs-12">
					<select name="groupid" class="form-control we7-select">
						<?php  if(is_array($_W['account']['groups'])) { foreach($_W['account']['groups'] as $group) { ?>
						<option value="<?php  echo $group['groupid'];?>"><?php  echo $group['title'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>

	<div class="form-group">
		<div class="">
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
			<input type="hidden" name="form" value="<?php  echo $_W['token'];?>"/>
			<input type="submit" value="提交" class="btn btn-primary"/>
		</div>
	</div>
</form>
<script>
	require(['validator'], function(){
		$(function(){
			$('#form1').bootstrapValidator({
				fields: {
					realname: {
						validators: {
							notEmpty: {
								message: '姓名不能为空'
							}
						}
					},
					mobile: {
						validators: {
							notEmpty: {
								message: '手机不能为空'
							},
							regexp: {
								regexp: /1\d{10}/,
								message: '手机号格式不正确'
							},
							remote: {
								url: "<?php  echo url('mc/member/add');?>",
								data: function(validator) {
									return {
										type: 'mobile',
										data: validator.getFieldElements('mobile').val()
									};
								},
								message: '手机号已经被占用'
							}
						}
					},
					email: {
						validators: {
							regexp: {
								regexp: /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/i,
								message: '邮箱格式不正确'
							},
							remote: {
								url: "<?php  echo url('mc/member/add');?>",
								data: function(validator) {
									return {
										type: 'email',
										data: validator.getFieldElements('email').val()
									};
								},
								message: '邮箱已经被占用'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: '密码不能为空'
							},
							stringLength: {
								min: 8,
								max: 15,
								message: '密码最少为8位'
							}
						}
					},
					credit1: {
						validators: {
							regexp: {
								regexp: /^[0-9]\d*$/i,
								message: '积分格式不正确'
							}
						}
					},
					credit2: {
						validators: {
							regexp: {
								regexp: /^[0-9]\d*$/i,
								message: '余额格式不正确'
							}
						}
					}
				}
			});
		});
	});
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
