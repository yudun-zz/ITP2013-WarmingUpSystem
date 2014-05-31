<meta http-equiv="Content-Type" content="textml; charset=utf8" />

<?php
class Company extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function check_login($data){
    if(!$data['cpno']) return false;
	$password = $this->db->select('password')->from('company')->where('cpno',$data['cpno'])->get()->row()->password;
	if($data['password']==$password) return true;
	else return false;
  }
  
  public function get_turn($data){
	$turn = $this->db->select('turn')->from('company')->where('cpno',$data['cpno'])->get()->row()->turn;
	return $turn;
  }
  
  public function set_turn($data,$value = 0){
	$this->db->query('UPDATE company SET turn ='.$value.' WHERE cpno='.'\''.$data['cpno'].'\'');
  }
 
/* 
  public function get_allmoney()
  {
	$data['A1']=$this->db->select('money1')->from('company')->where('cpno','A1')->get()->row()->money1;
	$data['A2']=$this->db->select('money1')->from('company')->where('cpno','A2')->get()->row()->money1;
	$data['A3']=$this->db->select('money1')->from('company')->where('cpno','A3')->get()->row()->money1;
	$data['B1']=$this->db->select('money1')->from('company')->where('cpno','B1')->get()->row()->money1;
	$data['B2']=$this->db->select('money1')->from('company')->where('cpno','B2')->get()->row()->money1;
	$data['B3']=$this->db->select('money1')->from('company')->where('cpno','B3')->get()->row()->money1;
	$data['C1']=$this->db->select('money1')->from('company')->where('cpno','C1')->get()->row()->money1;
	$data['C2']=$this->db->select('money1')->from('company')->where('cpno','C2')->get()->row()->money1;
	$data['C3']=$this->db->select('money1')->from('company')->where('cpno','C3')->get()->row()->money1;
	
	return $data;
  }*/
  
  public function get_supermes()
  {
    $result=array();
	$this->db->select('*');
	$this->db->from('company');
	$this->db->order_by('total','desc');
	$result=$this->db->get()->result_array();
	return $result;
  }

    public function changemoney($data)
  {
	//改变该公司的现金
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array();
	$this->db->update('company',array('money1'=>$result['money1']+$data['delta']),array('cpno'=>$data['cpno']));
	
	//更新总资产信息
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$mes['money1']+50-$mes['loan']+$mes['invest1']+$mes['invest2']+$mes['invest3']+$mes['anum']*$price['Acost']+$mes['bnum']*$price['Bcost']+$mes['cnum']*$price['Ccost']),array('cpno'=>$data['cpno']));
  }
  
  public function addgoldcard($data){
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array();
	$this->db->update('company',array('goldcard'=>!$result['goldcard']),array('cpno'=>$data['cpno']));
  }
  
  public function resetmoney($data){
    $this->db->update('company',array('money1'=>30,'money2'=>50,'loan'=>0,'total'=>80,'invest1'=>0,'invest2'=>0,'invest3'=>0,'anum'=>0,'bnum'=>0,'cnum'=>0),array('cpno'=>$data['cpno']));
  }
  
  public function get_mes($data)
  {
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	return $result;
  }

  public function settrade($trademes, $data)
  {
	if($trademes['customer'] == NULL || $trademes['customer']==$data['cpno']) return 4;	
	if(!($data['tradesignal']==1 && $data['endtrade']==0)) return 3;
	
    $cost=$this->db->select('Acost,Bcost,Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array(); 

	//获取双方买卖前数据
	$customer=$this->db->get_where('company',array('cpno'=>$trademes['customer']))->row_array(); 
	$merchant=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	
	//确定当前买卖货物
	switch($data['cptype']){
		case 1: $num='anum'; $cc=$cost['Acost']; break; 
		case 2: $num='bnum'; $cc=$cost['Bcost']; break;
		case 3: $num='cnum'; $cc=$cost['Ccost']; break;
		default: $num='anum'; $cc=0; break;
	}

	if($trademes['volume']>$merchant[$num]) return 1;
	if($trademes['totalprice']>$customer['money1']) return 2;

	//执行买卖过程
	$this->db->query('UPDATE company SET '.$num.'='.$num.'-'.'\''.$trademes['volume'].'\' WHERE cpno='.'\''.$merchant['cpno'].'\'');
	$this->db->query('UPDATE company SET '.$num.'='.$num.'+'.'\''.$trademes['volume'].'\' WHERE cpno='.'\''.$customer['cpno'].'\'');
	$this->db->query('UPDATE company SET money1=money1+'.'\''.$trademes['totalprice'].'\' WHERE cpno='.'\''.$merchant['cpno'].'\'');
	$this->db->query('UPDATE company SET money1=money1-'.'\''.$trademes['totalprice'].'\' WHERE cpno='.'\''.$customer['cpno'].'\'');
	
	//更新统计record
	$recorddata=$this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	$this->db->update('record',array('mo_trade'=>$recorddata['mo_trade']+$trademes['totalprice']));
	$this->db->update('record',array('mo_tradevolume'=>$recorddata['mo_tradevolume']+$trademes['volume']));
	$this->db->update('record',array('in_trade'=>$recorddata['in_trade']+($trademes['totalprice']-$cc*$trademes['volume']) )); 
	
	//更新买卖后双方总资产
	$result=$this->db->get_where('company',array('cpno'=>$merchant['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$result['money1']+50-$result['loan']+$result['invest1']+$result['invest2']+$result['invest3']+$result['anum']*$cost['Acost']+$result['bnum']*$cost['Bcost']+$result['cnum']*$cost['Ccost']),array('cpno'=>$result['cpno']));
	$result=$this->db->get_where('company',array('cpno'=>$customer['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$result['money1']+50-$result['loan']+$result['invest1']+$result['invest2']+$result['invest3']+$result['anum']*$cost['Acost']+$result['bnum']*$cost['Bcost']+$result['cnum']*$cost['Ccost']),array('cpno'=>$result['cpno']));

	return 0;
  }
  
  public function setloan($newloan = 0, $returnloan = 0, $data)
  {
	
	//获取当前资源单价
  	$price=$this->db->select('Acost, Bcost, Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array();

	//执行贷款操作
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('money1'=>$result['money1']+$newloan-$returnloan),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('loan'=>$result['loan']+$newloan-$returnloan),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('money2'=>$result['money2']-$newloan+$returnloan),array('cpno'=>$data['cpno']));
	
	//更新总资产信息
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$mes['money1']+50-$mes['loan']+$mes['invest1']+$mes['invest2']+$mes['invest3']+$mes['anum']*$price['Acost']+$mes['bnum']*$price['Bcost']+$mes['cnum']*$price['Ccost']),array('cpno'=>$data['cpno']));

  }


  public function prod($strategymes, $data)
  {
    $cost=$this->db->select('Acost,Bcost,Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array(); 
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 

	switch($data['cptype']){
		case 1: 
		$this->db->update('company',array('anum'=>$result['anum']+$strategymes['production']),array('cpno'=>$data['cpno']));
		$this->db->update('company',array('money1'=>$result['money1']-$cost['Acost']*$strategymes['production']),array('cpno'=>$data['cpno']));	
		break;
		case 2: 
		$this->db->update('company',array('bnum'=>$result['bnum']+$strategymes['production']),array('cpno'=>$data['cpno']));
		$this->db->update('company',array('money1'=>$result['money1']-$cost['Bcost']*$strategymes['production']),array('cpno'=>$data['cpno']));	
		break;
		case 3: 
		$this->db->update('company',array('cnum'=>$result['cnum']+$strategymes['production']),array('cpno'=>$data['cpno']));
		$this->db->update('company',array('money1'=>$result['money1']-$cost['Ccost']*$strategymes['production']),array('cpno'=>$data['cpno']));
		break;
		default: break;
	}
	
	//更新统计record
	$recorddata=$this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	$this->db->update('record',array('mo_prod'=>$recorddata['mo_prod']+$strategymes['production']));
	
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$result['money1']+50-$result['loan']+$result['invest1']+$result['invest2']+$result['invest3']+$result['anum']*$cost['Acost']+$result['bnum']*$cost['Bcost']+$result['cnum']*$cost['Ccost']),array('cpno'=>$data['cpno']));
  }

  public function invest($strategymes, $data)
  {
    $cost=$this->db->select('Acost,Bcost,Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array(); 
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 

	$this->db->update('company',array('invest1'=>$result['invest1']+$strategymes['invest1']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest2'=>$result['invest2']+$strategymes['invest2']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest3'=>$result['invest3']+$strategymes['invest3']),array('cpno'=>$data['cpno']));

	$this->db->update('company',array('money1'=>$result['money1']-$strategymes['invest1']-$strategymes['invest2']-$strategymes['invest3']),array('cpno'=>$data['cpno']));	
		
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$result['money1']+50-$result['loan']+$result['invest1']+$result['invest2']+$result['invest3']+$result['anum']*$cost['Acost']+$result['bnum']*$cost['Bcost']+$result['cnum']*$cost['Ccost']),array('cpno'=>$data['cpno']));	
  }
  
  public function disinvest($strategymes, $data)
  {
    $cost=$this->db->select('Acost,Bcost,Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array(); 
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 

	$this->db->update('company',array('invest1'=>$result['invest1']-$strategymes['disinvest1']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest2'=>$result['invest2']-$strategymes['disinvest2']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest3'=>$result['invest3']-$strategymes['disinvest3']),array('cpno'=>$data['cpno']));
	
	$this->db->update('company',array('money1'=>$result['money1']+$strategymes['disinvest1']+$strategymes['disinvest2']+$strategymes['disinvest3']),array('cpno'=>$data['cpno']));	
	
	$result=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$result['money1']+50-$result['loan']+$result['invest1']+$result['invest2']+$result['invest3']+$result['anum']*$cost['Acost']+$result['bnum']*$cost['Bcost']+$result['cnum']*$cost['Ccost']),array('cpno'=>$data['cpno']));	
  }
  
  public function inc_debtinvest($data)
  {
	$profit=$this->db->select('investp1,investp2,investp3')->from('game')->where('turnno',$data['turnno'])->get()->row_array();
	$price=$this->db->select('goldprice, Acost, Bcost, Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array();
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 

	$this->db->update('company',array('loan'=>$mes['loan']*1.06),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest1'=>$mes['invest1']*$profit['investp1']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest2'=>$mes['invest2']*$profit['investp2']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('invest3'=>$mes['invest3']*$profit['investp3']),array('cpno'=>$data['cpno']));

	//更新统计record
	$recorddata=$this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	$this->db->update('record',array('in_invest'=>$recorddata['in_invest'] + $mes['invest1']*($profit['investp1']-1) + $mes['invest2']*($profit['investp2']-1) + $mes['invest3']*($profit['investp3']-1) ));
	$this->db->update('record',array('mo_loan'=>$recorddata['mo_loan']+$mes['loan']*0.06));
	
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$mes['money1']+50-$mes['loan']+$mes['invest1']+$mes['invest2']+$mes['invest3']+$mes['anum']*$price['Acost']+$mes['bnum']*$price['Bcost']+$mes['cnum']*$price['Ccost']),array('cpno'=>$data['cpno']));
  }
  
  public function sub_inventorycost($data)
  {
	$cost=$this->db->select('inventorycost')->from('game')->where('turnno',$data['turnno'])->get()->row_array();
	$price=$this->db->select('Acost, Bcost, Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array();
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	
	$this->db->update('company',array('money1'=>$mes['money1']-($mes['anum']+$mes['bnum']+$mes['cnum'])*$cost['inventorycost']),array('cpno'=>$data['cpno']));	
	
	//更新统计record
	$recorddata=$this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	$this->db->update('record',array('mo_save'=>$recorddata['mo_save']+($mes['anum']+$mes['bnum']+$mes['cnum'])*$cost['inventorycost']));
	
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$mes['money1']+50-$mes['loan']+$mes['invest1']+$mes['invest2']+$mes['invest3']+$mes['anum']*$price['Acost']+$mes['bnum']*$price['Bcost']+$mes['cnum']*$price['Ccost']),array('cpno'=>$data['cpno']));
  }
  
}
