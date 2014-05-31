<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php 
		if( $tradesignal ){
			if($newtime != 0)
				echo '交易阶段进行中'; 
			else echo '黄金合成阶段';
		}
		else if( $endtrade ) echo '黄金合成阶段';
		else echo '交易即将开始'?></title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font-family:Microsoft YaHei, Times, serif;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-family:Microsoft YaHei, Times, serif;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		font-family:Microsoft YaHei, Times, serif;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family:Microsoft YaHei, Times, serif;
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
		font-family:Microsoft YaHei, Times, serif;
		margin-left: auto;
		margin-right: auto;

	}
	
	p.footer{
		font-family:Microsoft YaHei, Times, serif;
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
		width: 800px;
		height: 650px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
		font-size:25px;
		font-family:Microsoft YaHei, Times, serif;
	}
	
	div{
		
	}
	
	#header{
		margin-left: auto;
		margin-right: auto;
		font-family:Microsoft YaHei, Times, serif;
		width:  600px;
	}
	#footer{
		margin-left: auto;
		margin-right: auto;
		font-family:Microsoft YaHei, Times, serif;
		width:  1000px;
	}
	
	body{ 		background-image:url(/2013warmingup/image/background2.jpg);filter:
	  ‘progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
	  -moz-background-size:100% 100%;
	  background-size:100% 100%;
	}
	p{
	font-size:30px; font-family:Microsoft YaHei, Times, serif;
	}
	
	.fontsize{
		font-size:24px;
		font-family:Microsoft YaHei, Times, serif;
	}
	#menu li { 
		float:left; /* 往左浮动 */
	}
	</style>
	<?php if( $endtrade ) $newtime=0;?> 
	<?php if($endtrade != TRUE || $newtime != 0) echo '<meta http-equiv="refresh" content="5">'; ?> 
	
	<script type="text/javascript"> 
		function comp(){
			var quan
			if(<?php echo $goldcard?> == 1 && <?php echo $turnno ?> >3) quan=8
			else quan=10
			var num = quan*document.getElementById("gold").value; 
			document.getElementById("a").value=num; 
			document.getElementById("b").value=num; 
			document.getElementById("c").value=num; 
		}		
		var c=<?php echo $newtime ?> 
		var t  
		function timedCount()  
		{  
			document.getElementById('time').value=c  
			c=c-1  
			t=setTimeout("timedCount()",1000)  
		}  
		
		//验证黄金合成表单的正确性
			function validate_required(a,b,c)
			{
			  if(a.value<0 )
			  {alert("呵呵。。"); return false}
			
			  if(a.value*1 > <?php echo $anum ?> )
			  {alert("资源A不足！"); return false}
			  
			  if(b.value*1 > <?php echo $bnum ?> )
			  {alert("资源B不足！"); return false}
		
			  if(c.value*1 > <?php echo $cnum ?> )
			  {alert("资源C不足！"); return false}
		
				return true		  
			}

			function validate_form(thisform)
			{
			with (thisform)
			  {
			  if (validate_required(a,b,c)==false)
				{gold.focus();return false}
			  }
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
	<br>
	<br>
<div id="header">
	
	<div id="logo">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	<img src="/2013warmingup/image/logo.png" /></div>
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

<div id="container" class=“fontsize”>
	<div id="body">		
		<?php 
		if( $tradesignal && $endtrade==0 ){
			if($newtime != 0)
				echo '现在是交易阶段，倒计时<input type="text" id="time" size="2" onfocus="this.blur();"> 秒(本页面每5秒自动刷新一次)'; 
			else echo '倒计时结束，即将进入黄金合成阶段';
		}
		else if( $endtrade ) {
			echo '本轮交易结束，现在进入黄金合成阶段。请在下方输入你们的黄金计划产量';
			}
		else echo '交易即将开始'?>
		<script type="text/javascript">	timedCount();</script>
		<hr width="100%" style="border: 1px solid gray;" />
			
		<b>资产情况：</b> <br/>
		现金：<font color=red><?php echo round($money1,2) ?></font>万元 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
		固定资产：<font color=red><?php echo round($money2,2) ?></font>万元 <br>
		总资产：<font color=red><?php echo round($total,2) ?></font> 万元 &nbsp &nbsp &nbsp &nbsp
		贷款欠款：<font color=red><?php echo round($loan,2) ?></font>万元
		<hr width="100%" style="border: 1px solid gray;" />
		
		<b>资源状况：</b> <br/>
		A：<font color=red><?php echo $anum ?></font>吨 &nbsp &nbsp
		B：<font color=red><?php echo $bnum ?></font>吨 &nbsp &nbsp
		C：<font color=red><?php echo $cnum ?></font>吨 <br/>
		<hr width="100%" style="border: 1px solid gray;" />
		
		<?php if($endtrade == TRUE && $newtime == 0){
			echo form_open('home/index/prepare',array('onsubmit'=>'return validate_form(this)')); 
			echo '<b>黄金合成</b> <br><br>
			合成黄金<input style="width:70px" type="text" id="gold" name="gold" onkeyup="comp();" />百克 需要消耗：
			<input style="width:70px" type="text" id="a" name="a" onfocus="this.blur();" value="0"/>吨A +
			<input style="width:70px" type="text" id="b" name="b" onfocus="this.blur();" value="0"/>吨B +  
			<input style="width:70px" type="text" id="c" name="c" onfocus="this.blur();" value="0"/>吨C &nbsp &nbsp &nbsp &nbsp
			<center>
			<input type="submit"  class="btn btn-large btn-danger"  value="确定" />	
		</form>';} ?>
		
	</div>

	
</div>
<div id="footer"> 
		<img  style = "margin-left: auto;
		margin-right: auto;
		width:1000px;" src="/2013warmingup/image/footer.png">
		<p style="text-align:right;font-size:18;"> Honor-produced by ITP &nbsp &nbsp 		浙江大学创新与创业管理强化班  © 2013
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
</body>
</html>

