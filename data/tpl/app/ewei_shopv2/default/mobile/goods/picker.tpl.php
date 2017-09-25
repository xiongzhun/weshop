<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="option-picker">
    <div class="option-picker">
	<div class="option-picker-inner">
	<div class="option-picker-cell goodinfo">
	    <div class="closebtn"><i class="icon icon-guanbi1"></i></div>
	    <div class="img"><img class='thumb' src="<%goods.thumb%>" /></div>
	    <div class="info info-price text-danger">
			<?php  if($threen &&(!empty($threenprice['price'])||!empty($threenprice['discount']))) { ?>
			<span>&yen<span class=''>
			<?php  if(!empty($threenprice['price'])) { ?>
			<?php  echo $threenprice['price'];?>
			<?php  } else if(!empty($threenprice['discount'])) { ?>
			<?php  echo $threenprice['discount']*$goods['minprice'];?>
			<?php  } ?>
			<?php  } else { ?>
			<span>
				￥
				<span class='price'>
				<?php  if($taskGoodsInfo) { ?>
				<?php  echo $taskGoodsInfo['price'];?>
				<?php  } else { ?>
				<%if goods.ispresell>0 && (goods.preselltimeend == 0 || goods.preselltimeend > goods.thistime)%>
				<%goods.presellprice%>
				<%else%>
				<%if goods.maxprice == goods.minprice%><%goods.minprice%><%else%><%goods.minprice%>~<%goods.maxprice%><%/if%>
				<%/if%>
					<?php  } ?>
				</span>
			</span>

			<?php  } ?>
		</div>
	    <div class="info info-total">
			<%if seckillinfo==false || ( seckillinfo && seckillinfo.status==1) %>
	    		<%if goods.showtotal != 0%><%if goods.unite_total != 0%>总<%/if%>库存 <span class='total'><%goods.total%></span> 件<%/if%>
			<%/if%>
	    </div>
	    <div class="info info-titles"><%if specs.length>0%>请选择规格<%/if%></div>
	</div>
	<div class="option-picker-options">
	<%each specs as spec%>
	    <div class="option-picker-cell option spec">
		<div class="title"><%spec.title%></div>
		<div class="select">
		 <%each spec.items as item%>
		      <a href="javascript:;" class="btn btn-default btn-sm nav spec-item spec-item<%item.id%>" data-id="<%item.id%>" data-thumb="<%item.thumb%>"> <%item.title%> </a>
			<%/each%>
		</div>
	    </div>
	<%/each%> 
	<%=diyformhtml%>

	 <%if seckillinfo==false || ( seckillinfo && seckillinfo.status==1) %>
		<div class="fui-cell-group" style="margin-top:0">
			<div class="fui-cell">
			<div class="fui-cell-label">数量</div>
			<div class="fui-cell-info"></div>
			<div class="fui-cell-mask noremark">
				 <div class="fui-number">
					<div class="minus">-</div>
					<input class="num" type="tel" name="" value="<%if goods.minbuy>0%><%goods.minbuy%><%else%>1<%/if%>"/>
					<div class="plus ">+</div>
				</div>
			</div>
		</div>
			<%else%>
			   <input class="num" type="hidden" name="" value="1"/>
		<%/if%>
	</div>

                   
	</div>
	<div class="fui-navbar">
		<a href="javascript:;" class="nav-item btn cartbtn" style='display:none'>加入购物车</a>
	    <a href="javascript:;" class="nav-item btn buybtn"  style='display:none' >立刻购买</a>
	    <a href="javascript:;" class="nav-item btn confirmbtn"  style='display:none'>确定</a>
	</div>
    </div>
    </div>
</script>