<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>决策阶段</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin-left: auto;
		margin-right: auto;

	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin-left: auto;
		margin-right: auto;
		border: 4px solid #D0D0D0;
		width: 1000px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	div{
		
	}
	
	#header{
		margin-left: auto;
		margin-right: auto;
		width:  600px;
	}
	#footer{
		margin-left: auto;
		margin-right: auto;
		width:  1000px;
	}
	
	body{ 		background-image:url(/2013warmingup/image/background2.jpg);filter:
	  ‘progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
	  -moz-background-size:100% 100%;
	  background-size:100% 100%;
	}
	
	p{
	font-size:20px; font-family:"Microsoft YaHei", Times, serif;
	}
	.fontsize{
		font-size:20px;
		font-family:"Microsoft YaHei", Times, serif;
	}
	#menu li { 
		float:left; /* 往左浮动 */
	}
	</style>
	
	<script type="text/javascript">
			//验证贷款表单的正确性
			function validate_loan_required(newloan,returnloan)
			{
				if(returnloan.value){
				  if (returnloan.value <0)
				  {alert("请输入正确的还贷金额！");return false}
				
				  if(returnloan.value > <?php echo $money1 ?>)
				  {alert("现金不够还贷！");return false}
				   
				  if(returnloan.value > <?php echo $loan ?>)
				  {alert("还贷数额不正确！");return false}
				}
				if (newloan.value > <?php echo $money2 ?>)
				  {alert("贷款数额超过固定资产！");return false}
			  if (newloan.value <0)
			  {alert("请输入正确的贷款金额！");return false}
				return true		  
			}

			function validate_loan(thisform)
			{
			with (thisform)
			  {
			  if (validate_loan_required(newloan,returnloan)==false)
				{newloan.focus();return false}
			  }
			}
			
			//验证投资表单的正确性
			function invest_required(remain)
			{
			  if (remain.value<0 )
				{alert("现金不足！");return false}
				return true		  
			}

			function invest_form(thisform)
			{
			with (thisform)
			  {
			  if (invest_required(remain2)==false)
				{invest1.focus();return false}
			  }
			}
			
			//验证生产表单的正确性
			function prod_required(remain)
			{
			  var pr=document.getElementById("production").value; 
			  if (remain.value<0 )
				{alert("现金不足！");return false}
			  
			  if (pr > <?php echo 300-$pracc ?>) {
				alert("总生产量超过当前上限！");return false
			  }	
			   if (pr < 0) {
				alert("请输入正确的生产量！");return false
			  }		  
			  return true
			}

			function prod_form(thisform)
			{
			with (thisform)
			  {
			  if (prod_required(remain2)==false)
				{production.focus();return false}
			  }
			}
			
			//验证撤资表单的正确性
			function dis_required(d1,d2,d3)
			{
			  if(d1.value*1 <0 || d2.value*1 <0 || d3.value*1 <0)
			  {alert("请输入正确的撤资金额！");return false}
			  if(d1.value*1 > <?php echo $invest1 ?> || d2.value*1 > <?php echo $invest2 ?> || d3.value*1 > <?php echo $invest3 ?>)
			  {alert("撤资数额不正确！");return false}
				return true		  
			}

			function dis_form(thisform)
			{
			with (thisform)
			  {
			  if (dis_required(disinvest1,disinvest2,disinvest3)==false)
				{disinvest1.focus();return false}
			  }
			}
			
			//自动计算执行策略后的现金余额以及总生产成本
			function comp(){
				var pr=document.getElementById("production").value; 
				var i1=document.getElementById("i1").value;
				var i2=document.getElementById("i2").value;
				var i3=document.getElementById("i3").value;
				
				document.getElementById("remain1").value = <?php echo $money1 ?>-i1-i2-i3;
				document.getElementById("total").value=<?php switch($cptype){
														case 1: echo $Acost; break;
														case 2: echo $Bcost; break;
														case 3: echo $Ccost; break;
														default: echo "error!"; break;
														}?> * pr;
				document.getElementById("remain2").value = document.getElementById("remain1").value - document.getElementById("total").value;									
			}
		</script>		
</head>

                           <!------------------------------------------------------------------>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/2013warmingup/js/bootstrap.min.js"></script>

	<b>
		<br/>
		<br/>
	<div id="header">
		<br><br><br>
		<img src="/2013warmingup/image/logo.png" />
	</div>
	</b>

	<body style="background-color:white">	

	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
		  <ul class="nav" id="menu">
                      <li><a href="#"><font color="white">已登录：<?php echo $cpno ?></font></a></li>
					  <li><a href="#"><font color="white">产品：<?php switch($cptype){
																	case 1: echo "A"; break;
																	case 2: echo "B"; break;
																	case 3: echo "C"; break;
																	default: echo "error!"; break;
																}?></font></a></li>
					  <li><a href="#"><font color="white">游戏进度：第<?php echo $turnno ?>轮</font></a></li>
                    </ul>
        </div>
      </div>
    </div>
	
	
<div id="container" class="fontsize">

	<div id="body" >	
	    <div style="height:250px;width:300px;float:left;border:2px solid #D0D0D0;">
		<?php echo form_open('home/index/loanresult',array('onsubmit'=>'return validate_loan(this)')); ?>
			<center><p style="font-size:25px"> <b>当前贷款欠款：</b></p>
			<p><font color=red><?php echo $loan ?></font>万元 </p> 

			<div class="input-group">
			申请贷款：<input class="form-control" type="text" name="newloan" style="width:80px" />万元 <br/> 
			<br/>
			偿还贷款：<input class="form-control" type="text" name="returnloan" style="width:80px" />万元<br/>
			<br/>
			</div>
			  
			<input type="submit" class="btn btn-large btn-danger" value="贷款/还款点此确认" />
			
		</form>	
	    </div>
	
	
		<div style="height:250px;width:392px;float:left;border:2px solid #D0D0D0;">
		<center>	<p style="font-size:25px"> &nbsp <b>资产情况:</b> </p>
			<br>
			&nbsp 现金：<font color=red><?php echo $money1 ?></font>万元 <br> <br>
			&nbsp 固定资产：<font color=red><?php echo $money2 ?></font>万元  <br> <br>
			&nbsp 总资产：<font color=red><?php echo $total ?></font> 万元  
		</div>
		
		<div style="height:250px;width:300px;float:left;border:2px solid #D0D0D0;"><center> 	 
	    <p style="font-size:25px"> <b>当前投资情况：</b> </p> <br>
		&nbsp 房地产: <font color=red><?php echo $invest1 ?></font>万元 <br/>  <br>
		&nbsp 环保: <font color=red><?php echo $invest2 ?></font>万元 <br/>  <br>
		&nbsp 钢铁: <font color=red><?php echo $invest3 ?></font>万元 <br/>  <br> 
 	    </div>
		
		<hr width="100%" style="border: 1px solid #D0D0D0;"/>
		
	   <?php echo form_open('home/index/disinvestresult',array('onsubmit'=>'return dis_form(this)')); ?>
	   <div style="height:180px;width:496px;float:left;border:1px solid #D0D0D0;"> 
		<p style="font-size:25px"><b>撤资选择：</b> </p> 
		<div class="input-group">
		房地产:&nbsp
		<input type="text" class="form-control" id="di1" onkeyup="comp();" name="disinvest1" style="width:80px"/>万元   &nbsp &nbsp &nbsp
		环保: &nbsp &nbsp
		<input type="text" class="form-control" id="di2" onkeyup="comp();" name="disinvest2" style="width:80px"/>万元
		</br> <br>
		钢铁: &nbsp &nbsp &nbsp
		<input type="text" class="form-control" id="di3" onkeyup="comp();" name="disinvest3" style="width:80px"/>万元   
		&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<input type="submit" class="btn btn-large btn-danger" value="撤资点此确认" />
		<br />
		</div>
		</div>
		</form>
		
		<?php echo form_open('home/index/investresult',array('onsubmit'=>'return invest_form(this)')); ?>
		<div style="height:180px;width:496px;float:left;border:1px solid #D0D0D0;"> 
		<p style="font-size:25px"> <b>投资选择：</b> </p> 	
		<div class="input-group">
		房地产: &nbsp
		<input class="form-control" type="text" id="i1" onkeyup="comp();" name="invest1" style="width:80px" />万元   &nbsp &nbsp &nbsp  
		环保: &nbsp &nbsp
		<input class="form-control" type="text" id="i2" onkeyup="comp();" name="invest2" style="width:80px"/>万元
		<br> <br>
		钢铁: &nbsp &nbsp &nbsp
		<input type="text" class="form-control" id="i3" onkeyup="comp();" name="invest3" style="width:80px"/>万元
		&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
		<input type="submit" class="btn btn-large btn-danger" value="投资点此确认" />
		</div>
		<br /> 
		<br/>
	   </div>
	   <center>
	   	<div class="input-group">
		 <br/>如此投资后你们剩余的现金将会是
	   <input  style="width:80px" type="text" class="form-control" id="remain1" onfocus="this.blur();" value=<?php echo '"'.$money1.'"' ?>>万元<br/>
		</div></center>
	   </form>

	    <?php echo form_open('home/index/prodresult',array('onsubmit'=>'return prod_form(this)')); ?><center>
		<hr width="100%" style="border: 1px solid #D0D0D0;"/>
		<p style="font-size:25px"><b>资源状况：</b> </p>  
		A：<font color=red><?php echo $anum ?></font>吨&nbsp &nbsp &nbsp &nbsp
		B：<font color=red><?php echo $bnum ?></font>吨&nbsp &nbsp &nbsp &nbsp
		C：<font color=red><?php echo $cnum ?></font>吨 
		<hr width="100%" style="border: 1px dashed #D0D0D0;"/>
		
		当前生产<?php switch($cptype){
			case 1: echo "A"; break;
			case 2: echo "B"; break;
			case 3: echo "C"; break;
			default: echo "error!"; break;
		}?>的成本为：<font color=red><?php switch($cptype){
			case 1: echo $Acost; break;
			case 2: echo $Bcost; break;
			case 3: echo $Ccost; break;
			default: echo "error!"; break;
		}?></font>万元/吨 <br/> <br>
		<div class="input-group">
		请输入你们计划的生产量：<input  style="width:80px" type="text" class="form-control" id="production" name="production" onkeyup="comp();"/>吨
		(本回合还可以再生产<font color=red><?php echo 300-$pracc?></font>吨)<br/> <br/>
		生产成本为<font color=red><input style="width:80px" type="text" class="form-control" id="total" name="toital" onfocus="this.blur();" value="0"/></font>万元
		<br><br><input type="submit" class="btn btn-large btn-danger" value="开始生产" />
		<hr width="100%" style="border: 1px solid #D0D0D0;"/>
		执行完以上所有策略后，你们剩余的现金将会是
		<strong><input style="width:80px" class="form-control" type="text" id="remain2" name="remain2" onfocus="this.blur();" value=<?php echo '"'.$money1.'"' ?>/>万元</strong><br/>
		</div>
		<br />
		</form>
		
	<?php echo form_open('home/index/gold'); ?>
		<b>在进入交易阶段前，请确认完成了所有决策</b></br>
		<input type="submit" class="btn btn-large btn-danger" value="进入交易阶段" />
		<hr width="100%" style="border: 1px solid #D0D0D0;" />
	</form>		
	
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="footer"> 
		<img  style = "margin-left: auto;
		margin-right: auto;
		width:1000px;" src="/2013warmingup/image/footer.png">
		<p style="text-align:right;"> Honor-produced by ITP &nbsp &nbsp 		浙江大学创新与创业管理强化班  © 2013
		</p>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>

