<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>公示信息</title>

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
		margin: 0 15px 0 15px;
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
		border: 1px solid #D0D0D0;
		width:  600px;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	#header{
		margin-left: auto;
		margin-right: auto;
		width:  600px;
	}
	#footer{
		margin-left: auto;
		margin-right: auto;
		width:  600px;
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
<div id="header">
		
	<div id="logo">
	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
	<img src="/2013warmingup/image/logo.png" /></div>
</div>
</b>

<body style="background-image:url(/2013warmingup/image/background2.jpg);filter:'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')’;
-moz-background-size:100% 100%;
	background-size:100% 100%;">
	
<div id="container" class="fontsize">
	<div id="body">		<center>
		
<table border="1">
<br>
<center>资产排名公示</center>
<tr>
<td>&nbsp &nbsp 组别&nbsp &nbsp </td>
<td>&nbsp &nbsp &nbsp &nbsp 总资产&nbsp &nbsp &nbsp &nbsp </td>
</tr>

<?php foreach ($rank as $item): ?>
     <tr>
     <td><center><b><?php echo $item['cpno'] ?></b></td>
     <td><center><b><font color="blue"><?php echo $item['total'] ?></font>&nbsp 万元</b></td>
	</tr>
<?php endforeach ?>
</table><br>
	</div>
</div>

</body>


</html>