<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>登录系统</title>

	<style type="text/css">



	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	b {
	background-image: url(/2013warmingup/image/background2.jpg);} 
	
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
	
	#containers{
		margin-left: auto;
		margin-right: auto;
		font-size: 15px;
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
	
	#menu li { 
		float:left; /* 往左浮动 */
	}
	</style>
	
	
</head>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="/2013warmingup/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="/2013warmingup/js/bootstrap.min.js"></script>
<b>
	<br>
	<br>
	<br>
<div id="header">
		
	<div id="logo">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	<img src="/2013warmingup/image/logo.png" /></div>
</div>
</b>
<body style="background-image:url(/2013warmingup/image/background.jpg);filter:‘progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
-moz-background-size:100% 100%;
	background-size:100% 100%;">
	
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
		  <ul class="nav" id="menu">
                      <li><a href="#"><font color="white">您尚未登录</font></a></li>
                    </ul>
        </div>
      </div>
    </div>
	
<div id="containers" class="fontsize">
	<!--<div class="hero-unit">-->
	<h1>Welcome to ITP 2013 warming up!</h1>
	<!--</div>-->
	<div id="body">		
		<center>
		<br/>
		<?php echo form_open('home/index/login'); ?>
		<p><input type="radio" name="type" id="strategy" value="决策" /> 
		<label for="strategy">&nbsp &nbsp 登录到决策页面 </label></p><br/>
		
		<p><input type="radio" name="type" id="trade" value="交易" /> 
		<label for="trade">&nbsp &nbsp 登录到交易页面</label></p><br/>
		&nbsp &nbsp 登录公司：
		<select name="company">
		<option value="A1" selected="selected">A1</option>
		<option value="A2">A2</option>
		<option value="A3">A3</option>
		<option value="B1">B1</option>
		<option value="B2">B2</option>
		<option value="B3">B3</option>
		<option value="C1">C1</option>
		<option value="C2">C2</option>
		<option value="C3">C3</option>
		</select></br><br/>
		&nbsp &nbsp
		请输入密码：<input type="password" name="password" /></br><br/>
		<input type="submit" class="btn btn-large btn-danger" value="登录" />		
		</form>
		</center>
		
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>	
</div>

<div id="footer"> 
		<img src="/2013warmingup/image/footer.png">
		<p style="text-align:right;"> Honor-produced by ITP &nbsp &nbsp 		浙江大学创新与创业管理强化班 © 2013
		</p>
</div>
</body>




</html>