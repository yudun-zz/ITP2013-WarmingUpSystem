<meta http-equiv="Content-Type" content="textml; charset=utf8" />

<?php
class Game extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }
  
  public function begintrade()
  {
	$this->db->update('system',array('tradesignal'=>1));
  }
  
  public function endtrade()
  {
	$this->db->update('system',array('tradesignal'=>1,'endtrade'=>1));
  }
  
  public function resettrade()
  {
	$this->db->update('system',array('tradesignal'=>0,'endtrade'=>0));
  }
  
   public function gettrade()
  {
	$result=$this->db->select('tradesignal,endtrade')->from('system')->get()->row_array();
	return $result;
  }
  
  public function get_mes($data)
  {
	$result=$this->db->get_where('game',array('turnno'=>$data['turnno']))->row_array(); 
	return $result;
  }

  public function getrecord(){
	$record = $this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	return $record;
  }
  
  public function sellgold($goldproduction = 0,$data)
  {
	$price=$this->db->select('goldprice, Acost, Bcost, Ccost')->from('game')->where('turnno',$data['turnno'])->get()->row_array();
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	
	if($mes['goldcard'] && $mes['turn']>3) $quan=8;
	else $quan=10;
	
	$this->db->update('company',array('money1'=>$mes['money1']+$goldproduction*$price['goldprice']),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('anum'=>$mes['anum']-$goldproduction*$quan),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('bnum'=>$mes['bnum']-$goldproduction*$quan),array('cpno'=>$data['cpno']));
	$this->db->update('company',array('cnum'=>$mes['cnum']-$goldproduction*$quan),array('cpno'=>$data['cpno']));

	//更新统计record
	$recorddata=$this->db->select('mo_loan,mo_prod,mo_save,mo_trade,mo_tradevolume,in_invest,in_gold,in_trade')->from('record')->get()->row_array();
	$this->db->update('record',array('in_gold'=>$recorddata['in_gold']+$goldproduction*$price['goldprice']));
	
	
	$mes=$this->db->get_where('company',array('cpno'=>$data['cpno']))->row_array(); 
	$this->db->update('company',array('total'=>$mes['money1']+$mes['money2']-$mes['loan']+$mes['invest1']+$mes['invest2']+$mes['invest3']+$mes['anum']*$price['Acost']+$mes['bnum']*$price['Bcost']+$mes['cnum']*$price['Ccost']),array('cpno'=>$data['cpno'])); 
  }

}
