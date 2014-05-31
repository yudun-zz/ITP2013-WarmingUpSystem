<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>上帝模式</title>

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
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<center>
<body>
<div id="container">
<br>
<table border="1">
<tr>
<td>组别</td>
<td>总资产</td>
<td>现金</td>
<td>固定资产</td>
<td>贷款</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>房地产</td>
<td>钢铁</td>
<td>环保</td>
<td>当前进度</td>
<td>是否有“黄金战神卡”</td>

</tr>

<?php foreach ($rank as $item): ?>
     <tr>
     <td><b><?php echo $item['cpno'] ?></b></td>
     <td><b><font color="blue"><?php echo $item['total'] ?></font>万元</b></td>
	 <td><b><font color="red"><?php echo $item['money1'] ?></font>万元</b></td>
	 <td><b><?php echo $item['money2'] ?>万元</b></td>
	 <td><b><?php echo $item['loan'] ?>万元</b></td>
	 <td><b><?php echo $item['anum'] ?>吨</b></td>
	 <td><b><?php echo $item['bnum'] ?>吨</b></td>
	 <td><b><?php echo $item['cnum'] ?>吨</b></td>
	 <td><b><?php echo $item['invest1'] ?>万元</b></td>
	 <td><b><?php echo $item['invest2'] ?>万元</b></td>
	 <td><b><?php echo $item['invest3'] ?>万元</b></td>
	 <td><b><?php echo "第".$item['turn'] ?>轮</b></td>
	 <td><b><?php if($item['goldcard']) echo "<font color=\"red\">yes</font>"; else echo "" ?></b></td>
	</tr>
<?php endforeach ?>
</table><br><br>


		<?php echo form_open('home/index/changemoney'); ?>
		公司：<select name="company">
		<option value="A1" selected="selected">A1</option>
		<option value="A2">A2</option>
		<option value="A3">A3</option>
		<option value="B1">B1</option>
		<option value="B2">B2</option>
		<option value="B3">B3</option>
		<option value="C1">C1</option>
		<option value="C2">C2</option>
		<option value="C3">C3</option></select>&nbsp &nbsp &nbsp &nbsp
		现金增量：<input type="text" name="delta" />&nbsp &nbsp &nbsp &nbsp 
		<input type="submit" class="btn btn-large btn-danger" value="确认" />	
        </form>	
		
		<?php echo form_open('home/index/addgolodcard'); ?>
		为<select name="company">
		<option value="A1" selected="selected">A1</option>
		<option value="A2">A2</option>
		<option value="A3">A3</option>
		<option value="B1">B1</option>
		<option value="B2">B2</option>
		<option value="B3">B3</option>
		<option value="C1">C1</option>
		<option value="C2">C2</option>
		<option value="C3">C3</option></select>添加/删除“黄金战神卡” &nbsp &nbsp &nbsp &nbsp
		<input type="submit" class="btn btn-large btn-danger" value="确认" />	
		</form>	
		 
		<br>
		<?php echo form_open('home/index/tradecontrol'); ?>
		当前交易状态：<font color="red"><?php if(!$tradesignal && !$endtrade) echo "交易未开始";
                            else if($tradesignal && !$endtrade) echo "交易进行中";
							else if($tradesignal && $endtrade) echo "交易结束"?></font><br>
		<input type="submit" name="submit" class="btn btn-large btn-danger" value="开始交易" />	&nbsp &nbsp &nbsp &nbsp 
		<input type="submit" name="submit" class="btn btn-large btn-danger" value="结束交易" />	
        </form>	
		<?php echo form_open('home/index/resettrade'); ?>	
		<input type="submit" class="btn btn-large btn-danger" value="确认重新设置交易状态(决策进行中设置)" />	
        </form>	
		
		<br><br>
		<table border="1">
<tr>
<td>贷款总利息</td>
<td>总生产量</td>
<td>总库存成本</td>
<td>总交易额</td>
<td>总交易量</td>
<td>投资总利润</td>
<td>黄金总利润</td>
<td>交易总利润</td>
</tr>

<?php $item=$record ?>
     <tr>
     <td><b><?php echo $item['mo_loan'] ?></b></td>
	 <td><b><?php echo $item['mo_prod'] ?></b></td>
	 <td><b><?php echo $item['mo_save'] ?></b></td>
	 <td><b><?php echo $item['mo_trade'] ?></b></td>
	 <td><b><?php echo $item['mo_tradevolume'] ?></b></td>
	 <td><b><?php echo $item['in_invest'] ?></b></td>
	 <td><b><?php echo $item['in_gold'] ?></b></td>
	 <td><b><?php echo $item['in_trade'] ?></b></td>
	</tr>
</table>
		
		<br><br><br>
		<?php echo form_open('home/index/resetmoney'); ?>
		选择重组公司：<select name="company">
		<option value="A1" selected="selected">A1</option>
		<option value="A2">A2</option>
		<option value="A3">A3</option>
		<option value="B1">B1</option>
		<option value="B2">B2</option>
		<option value="B3">B3</option>
		<option value="C1">C1</option>
		<option value="C2">C2</option>
		<option value="C3">C3</option></select>&nbsp &nbsp &nbsp &nbsp
		<input type="submit" class="btn btn-large btn-danger" value="确认重组" />	
        </form>		
</div>

</body>
</html>