<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('game');
		$this->load->model('company');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function gen_page($page, $data = array()){
	    $path=$page;
	    $this->load->view($path,$data);
	}
 
	public function index($page = "login")
	{
		switch($page){	
			case "changemoney":
				$data['cpno']=$this->input->post('company');
				$data['delta']=$this->input->post('delta');

				$this->company->changemoney($data);
		
				redirect('home/index/super');
			break;
						
			case "addgolodcard":
				$data['cpno']=$this->input->post('company');

				$this->company->addgoldcard($data);
		
				redirect('home/index/super');
			break;
			
			case "resetmoney":
				$data['cpno']=$this->input->post('company');

				$this->company->resetmoney($data);
		
				redirect('home/index/super');
			break;

			case "resettrade":
				$this->game->resettrade();
				redirect('home/index/super');
			break;
			
			case "tradecontrol":
				$submit=$this->input->post('submit');

				if($submit=='开始交易')
				    $this->game->begintrade();
                if($submit=='结束交易')
				    $this->game->endtrade();
					
				redirect('home/index/super');
			break;
			
			case "login":
				//获取login页面信息
				$type=$this->input->post('type');          
				$company=$this->input->post('company');
				$password=$this->input->post('password');
				//设置session信息
				$this->session->set_userdata('cpno',$company);
				switch($company){
					case 'A1':
					case 'A2':
					case 'A3': $this->session->set_userdata('cptype',1); break;
					case 'B1':
					case 'B2':
					case 'B3': $this->session->set_userdata('cptype',2); break;
					case 'C1':
					case 'C2':
					case 'C3': $this->session->set_userdata('cptype',3); break;
					default:
				}
				
				//根据登陆要求重定向至 交易 或者 决策界面
				$data['cpno'] = $company;
				$data['password'] = $password;
				if($this->company->check_login($data)) $this->session->set_userdata('logged',true);
				else $this->session->set_userdata('logged',false);
				$logged=$this->session->userdata['logged'];

				$this->session->set_userdata('goldsubmit',0);
				if($logged==true){
					if($type=="交易") redirect('home/index/trade');
					else if($type == "决策"){
						$this->company->set_turn($data,0);
						redirect('home/index/prepare');
					}
				}
			break;
			
			case "showrank":
				$result=$this->game->gettrade();
				$data['tradesignal']=$result['tradesignal'];
				$data['endtrade']=$result['endtrade'];
				$data['rank']=$this->company->get_supermes();
			break;
			
			case "super":
				$result=$this->game->gettrade();
				$data['tradesignal']=$result['tradesignal'];
				$data['endtrade']=$result['endtrade'];
				$data['rank']=$this->company->get_supermes();
				$data['record']=$this->game->getrecord();
			break;
			
			case "applogin":		
				//获取applogin页面信息      
				$company=$this->input->post('company');
				$password=$this->input->post('password');
				//设置session信息
				$this->session->set_userdata('appcpno',$company);
				
				//根据登陆要求重定向
				$data['cpno'] = $company;
				$data['password'] = $password;
				if($this->company->check_login($data)) $this->session->set_userdata('logged',true);
				else $this->session->set_userdata('logged',false);
				$logged=$this->session->userdata['logged'];

				if($logged==true){
					redirect('home/index/appcheck');
				}
			break;
			
			case "appcheck":
				$data['cpno']=$this->session->userdata['appcpno'];
				$data = array_merge($data, $this->company->get_mes($data));
			break;
			
			case "trade":
				//从session中获取商家组号
				$this->session->set_userdata('tradesubmit',0);
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				
				//获取商家页面显示信息	
				$data = array_merge($data, $this->company->get_mes($data));
			break;
			
			case "traderesult":
				//从session中获取商家组号
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
								
				//获取交易数据
				$trademes['customer']=$this->input->post('customer');	
				$trademes['volume']=$this->input->post('volume');
				$trademes['totalprice']=$this->input->post('totalprice');

				//获取系统交易状态
				$result=$this->game->gettrade();
				$data['tradesignal']=$result['tradesignal'];
				$data['endtrade']=$result['endtrade'];				
				
				if($this->session->userdata['tradesubmit']==0){	
					//执行交易
					$data['traderesult']=$this->company->settrade($trademes, $data);
					$this->session->set_userdata('tradesubmit',1);
				}
				else $data['traderesult']=0;

				$data = array_merge($data, $this->company->get_mes($data));
				//获取各商家现金以方便js判断表单正确性
				$data = array_merge($data, $trademes);
					//此时$data 包含： inventory, cpno, cptype, money1
			break;
			
			case "strategy":					
				$this->session->set_userdata('goldsubmit',0);
				
				//从session获取当前组号以及轮数信息
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				$data['pracc']=$this->session->userdata['pracc'];
				
				//获取公司页面显示信息
				$data = array_merge($data, $this->company->get_mes($data));
				$data = array_merge($data, $this->game->get_mes($data));
				//此时$data 包含： productname, turnno, cpno, cptype, 
				//                 total, money1, money2, loan 
				//                 inventorycost, anum, bnum, cnum, cost	
			break;

			case "disinvestresult":
			    //撤资金额
				$strategymes['disinvest1']=$this->input->post('disinvest1');
				$strategymes['disinvest2']=$this->input->post('disinvest2');
				$strategymes['disinvest3']=$this->input->post('disinvest3');
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
			
				$this->company->disinvest($strategymes, $data);

				redirect('home/index/strategy');
			break;
			
			case "loanresult":
				//新申请的贷款数,贷款按钮
				$newloan = $this->input->post('newloan');
				$returnloan = $this->input->post('returnloan');
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				
				//执行贷款操作
				$this->company->setloan($newloan, $returnloan, $data);
			
				$data['newloan']=$newloan;
				$data['returnloan']=$returnloan;
				redirect('home/index/strategy');
			break;
			
			case "investresult":
				$strategymes['invest1']=$this->input->post('invest1');
				$strategymes['invest2']=$this->input->post('invest2');
				$strategymes['invest3']=$this->input->post('invest3');
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
					
				$this->company->invest($strategymes, $data);
		
				redirect('home/index/strategy');
			break;
			
			case "prodresult":
				$strategymes['production']=$this->input->post('production');
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				$data['pracc']=$this->session->userdata['pracc'];
				$this->session->set_userdata('pracc', $data['pracc']+$strategymes['production']);
				$this->company->prod($strategymes, $data);
		
				redirect('home/index/strategy');
			break;
			
			case "gold":
				//从session获取当前组号以及轮数信息
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				$oldgoldtime=$this->session->userdata['goldtime'];
				$result=$this->game->gettrade();
				$data['tradesignal']=$result['tradesignal'];
				$data['endtrade']=$result['endtrade'];
				
				if($data['tradesignal']){
					if($oldgoldtime>0) $data['newtime']=$oldgoldtime-5;
					else $data['newtime']=0;
					$this->session->set_userdata('goldtime', $data['newtime']);
	            }
				else $data['newtime']=1; //传入非0newtime避免页面生成错误
				//获取gold页面需要显示的信息(A,B,C当前储量)
				$data = array_merge($data, $this->company->get_mes($data));
			break;
			
			case "showtime":
				//从session获取当前轮数信息(取A1的信息)
				$data['cpno']="A1";
				$data['turnno']=$this->company->get_turn($data);
				$result=$this->game->gettrade();
				$data['tradesignal']=$result['tradesignal'];
				$data['endtrade']=$result['endtrade'];
				
				if($data['tradesignal']==1 && $data['endtrade']==0){
					$oldgoldtime=$this->session->userdata['goldtime'];
					if($oldgoldtime>0) $data['newtime']=$oldgoldtime-5;
					else $data['newtime']=0;
					$this->session->set_userdata('goldtime', $data['newtime']);
	            }
				else {
					$this->session->set_userdata('goldtime', 425);
					$data['newtime']=10;
				}
			break;
			
			case "prepare":
				//从session获取获取组号信息并使轮数+1
				$this->session->set_userdata('pracc',0);
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data['turnno']=$this->company->get_turn($data);
				
				if($this->session->userdata['goldsubmit']==0){
					//获取gold页面post的黄金数量
					$goldproduction = $this->input->post('gold');
					++$data['turnno'];
					$this->company->set_turn($data,$data['turnno']);
					$this->session->set_userdata('goldtime',425);
					
					if($data['turnno']>1){
						//执行黄金销售
						$data['turnno']--;	
						$this->game->sellgold($goldproduction,$data);			
						$this->company->sub_inventorycost($data);
						$this->company->inc_debtinvest($data);
						$data['turnno']++;
					}
					$this->session->set_userdata('goldsubmit',1);
				}
				//若轮数超过上限则结束游戏
				if($data['turnno']>6) redirect('home/index/gameover');
			break;
			
			case "gameover":
				//从session获取获取组号信息以及最终资产情况
				$data['cpno']=$this->session->userdata['cpno'];
				$data['cptype']=$this->session->userdata['cptype'];
				$data = array_merge($data, $this->company->get_mes($data));
			break;
			
			default: $data=array();
		}
		
		$this->gen_page($page, $data);
	}
}

/* End of file hcome.php */
/* Location: ./application/controllers/home.php */