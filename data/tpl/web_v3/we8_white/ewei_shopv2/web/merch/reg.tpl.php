<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
    当前位置：<span class="text-primary"><?php  if($_GPC['status']=='0') { ?>多商户入驻申请中 <?php  } else { ?>多商户入驻申请驳回 <?php  } ?></span>
</div>
<div class="page-content">
    <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
        <input type="hidden" name="c" value="site" />
        <input type="hidden" name="a" value="entry" />
        <input type="hidden" name="m" value="ewei_shopv2" />
        <input type="hidden" name="do" value="web" />
        <input type="hidden" name="r" value="merch.reg" />

        <div class="page-toolbar m-b-sm m-t-sm">
             <span class='pull-left'>
                <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('merch/user/add')?>"><i class="fa fa-plus"></i> 添加多商户</a>
            </span>
            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name='status' class='form-control  input-sm select-md' style="width:100px;"  >
                            <option value=''>状态</option>
                            <option value='0' <?php  if($_GPC['status']=='0') { ?>selected<?php  } ?>>申请中</option>
                            <option value='-1' <?php  if($_GPC['status']=='-1') { ?>selected<?php  } ?>>驳回</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="商户名称/联系人/手机号"/>
				 <span class="input-group-btn">
                                 <button class="btn btn-primary" type="submit"> 搜索</button>
				</span>
                </div>

            </div>
        </div>
    </form>
    <?php  if(count($list)>0) { ?>
    <div class="page-table-header">
        <input type="checkbox">
        <span   class="btn-group">
            <?php if(cv('merch.reg.delete')) { ?>
            <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/reg/delete')?>">
                <i class='icow icow-shanchu1'></i> 删除
            </button>
            <?php  } ?>
        </span>
    </div>
    <table class="table table-hover table-responsive">
        <thead class="navbar-inner" >
        <tr>
            <th style="width:25px;"></th>

            <th>商户名称</th>
            <th>主营项目</th>
            <th>联系人</th>
            <th>申请时间</th>
            <th>申请状态</th>
            <th style='width:65px;'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <tr rel="pop" data-title="ID: <?php  echo $row['id'];?> ">

            <td>
                <input type='checkbox'   value="<?php  echo $row['id'];?>"/>
            </td>
            <td><?php  echo $row['merchname'];?></td>
            <td><?php  echo $row['salecate'];?></td>
            <td><?php  echo $row['realname'];?><br/><?php  echo $row['mobile'];?></td>
            <td><?php  echo date('Y-m-d', $row['applytime'])?><br/><?php  echo date('H:i', $row['applytime'])?></td>
            <td>
                <?php  if($row['status']==0) { ?>
               <span class="label label-primary"> 申请中</span>
                <?php  } else if($row['status']==-1) { ?>
                <span class="label label-danger"> 驳回申请</span>
                <?php  } ?>
            </td>
            <td  style="overflow:visible;">

                <?php if(cv('merch.reg.detail')) { ?>
                <a  href="<?php  echo webUrl('merch/reg/detail', array('id' => $row['id']))?>" class="btn btn-default btn-sm btn-op btn-operation" >
                   <span data-toggle="tooltip" data-placement="top" title="" data-original-title="处理申请">
                        <i class='icow icow-bianji2'></i>
                   </span>
                </a>
                <?php  } ?>

                <?php if(cv('merch.reg.delete')) { ?>
                <a data-toggle='ajaxRemove' href="<?php  echo webUrl('merch/reg/delete', array('id' => $row['id']))?>"class="btn btn-default btn-sm btn-operation btn-op" data-confirm='确认要删除此商户吗?'>
                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="删除">
                         <i class='icow icow-shanchu1'></i>
                    </span>
                </a>
                <?php  } ?>

            </td>
        </tr>
        <?php  } } ?>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="checkbox"></td>
                <td>
                    <div class="input-group-btn">
                        <?php if(cv('merch.reg.delete')) { ?>
                        <button class="btn btn-default btn-sm btn-operation" type="button" data-toggle='batch-remove' data-confirm="确认要删除?" data-href="<?php  echo webUrl('merch/reg/delete')?>">
                            <i class='icow icow-shanchu1'></i> 删除
                        <?php  } ?>
                    </div>
                </td>
                <td class="text-right" colspan="5">
                    <?php  echo $pager;?>
                </td>
            </tr>
        </tfoot>
    </table>


    <?php  } else { ?>
    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何入驻申请!
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
