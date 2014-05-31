<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>交易平台</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	b {
	background-image: url(/2013warmingup/image/background.jpg);} 
	
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
		margin-left: auto;
		margin-right: auto;
		padding: 14px 15px 10px 15px;
	}
	
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin-left: auto;
		margin-right: auto;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin-left: auto;
		margin-right: auto;
	}
	
	#footer{
		margin-left: auto;
		margin-right: auto;
		width: 950px;
	}
	
	#container{
		margin-left: auto;
		margin-right: auto;
		border: 1px solid #D0D0D0;
		width:  720px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	#header{
		margin-left: auto;
		margin-right: auto;
		width: 950px;
	}
	
	.fontsize{
		font-size:20px;
		font-family:"Microsoft YaHei", Times, serif;
	}

	</style>
	
	<script type="text/javascript">		
			//检查表单正确性
			function validate_required(customer,volume,unit)
			{
			    if (volume.value == "" || volume.value<0)
				{alert("请输入正确的交易量");return false}
			  
			  //////////////////////////////!!!!
				if (unit.value == "" || unit.value<0)
				{alert("请输入正确的单价");return false}
				   
				var cs
				for(var i=0;i<customer.length;i++){     
					if(customer[i].checked){      
						cs=customer[i].value;
						break;
					 }     
				 }     
				if(i==customer.length || cs == "<?php echo $cpno ?>")
				{alert("请选择正确的买家");return false}
				
				if(confirm("请确认本次交易信息:\n\n        买家:"+cs+"  交易量:"+volume.value+"吨  单价:"+unit.value+"万元"))
					return true
				else return false
			}

			//自动填充交易总价
			function validate_form(thisform)
			{
			with (thisform)
			  {
			  if (validate_required(customer,volume,unitprice)==false)
				{volume.focus();return false}
			  }
			}
			
			function comp(){
					var volume = document.getElementById("volume").value;    
					var unitprice = document.getElementById("unitprice").value;
					var totalprice = volume * unitprice;
					document.getElementById("totalprice").value=totalprice;
			}
		</script>
	
</head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/2013warmingup/js/bootstrap.min.js"></script>

	<br/>
	<br/>
	<br/>
<div id="header">
		
	<div id="logo">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	<img src="/2013warmingup/image/logo.png" /></div>
</div>	
	
<body style="background-image:url(/2013warmingup/image/background2.jpg);filter:‘progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
-moz-background-size:100% 100%;
	background-size:100% 100%;">

<div id="container" class="fontsize">

<div class="bs-docs-example">          
  <SCRIPT>
	function isHidden(oDiv){
      var vDiv = document.getElementById(oDiv);
      vDiv.style.display = (vDiv.style.display == 'none')?'block':'none';
    }
  </SCRIPT>

  <br>
  <div class="alert alert-info">
	  <strong>请卖家保护好自己的资产信息，避免被走动中的采购员窥视</strong>
   </div>
   <center>
  <a class="btn btn-danger" onclick="isHidden('div1')" href="#">显示/隐藏卖家信息</a>
  <DIV id="div1">
        卖方：<?php echo $cpno ?><br />
		交易品：<?php switch($cptype){
			case 1: echo 'A'; break;
			case 2: echo 'B'; break;
			case 3: echo 'C'; break;
			default: break;
		} ?><br />
		卖方库存：<?php switch($cptype){
			case 1: echo 'A:<font color="red">'.$anum.'吨 </font>&nbsp&nbsp    B:'.$bnum.'吨 &nbsp&nbsp    C:'.$cnum.'吨'; break;
			case 2: echo 'A:'.$anum.'吨  &nbsp&nbsp   B:<font color="red">'.$bnum.'吨</font> &nbsp&nbsp    C：'.$cnum.'吨'; break;
			case 3: echo 'A：'.$anum.'吨  &nbsp&nbsp   B:'.$bnum.'吨  &nbsp&nbsp   C:<font color="red">'.$cnum.'吨</font>'; break;
			default: break;
		} ?><br />
		卖方现金：<font color=red><?php echo round($money1,2) ?></font>万元<br />
  </DIV> </center>
		<script>isHidden('div1');</script> <!------默认隐藏卖方信息---------->
		
	<hr width="100%" style="border: 1px solid grey;" />	
	
		<?php echo form_open('home/index/traderesult', array('onsubmit'=>'return validate_form(this)')); ?>
		&nbsp 买方：  <br>
		<center>
		<input type="radio" name="customer" id="A1" value="A1" /> 
		<label for="A1">A1 &nbsp </label>
		
		<input type="radio" name="customer" id="A2" value="A2" /> 
		<label for="A2">A2 &nbsp </label>
		
		<input type="radio" name="customer" id="A3" value="A3" /> 
		<label for="A3">A3 &nbsp </label>
		
		<input type="radio" name="customer" id="B1" value="B1" /> 
		<label for="B1">B1 &nbsp </label>
		
		<input type="radio" name="customer" id="B2" value="B2" /> 
		<label for="B2">B2 &nbsp </label>
		
		<input type="radio" name="customer" id="B3" value="B3" /> 
		<label for="B3">B3 &nbsp </label>

		<input type="radio" name="customer" id="C1" value="C1" /> 
		<label for="C1">C1 &nbsp </label>
		
		<input type="radio" name="customer" id="C2" value="C2" /> 
		<label for="C2">C2 &nbsp </label>
		
		<input type="radio" name="customer" id="C3" value="C3" /> 
		<label for="C3">C3 &nbsp </label>
		</center>

		<hr width="100%" style="border: 1px solid grey;" />
		<div class="input-group">
			&nbsp 交易量:  
			<input type="text" class="form-control" style="width:50px" name="volume" id="volume" onkeyup="comp();"/>吨
			<br/>
			<hr width="100%" style="border: 1px solid grey;" />
			&nbsp 单价:  
			<input type="text" class="form-control" style="width:100px" name="unitprice" onkeyup="comp();" id="unitprice" />万元
			&nbsp &nbsp &nbsp &nbsp 总价:   
			<input type="text" class="form-control" style="width:100px" name="totalprice" id="totalprice" onfocus="this.blur()" value='0'/>万元
			<br/>
			<br/>
			&nbsp &nbsp <input type="submit"  class="btn btn-large btn-danger" value="提交"/>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="footer"> <center>
		<img src="/2013warmingup/image/footer.png">
		<p style="text-align:right;">  &nbsp &nbsp 		浙江大学创新与创业管理强化班 © 2013
		</p>
</div>
</body>

<br>
<br>
<br>
<br>
<br>

</html>