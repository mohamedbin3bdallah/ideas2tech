<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
		parent::__construct();
		$this->mysystem = $this->Admin_mo->getrow('system',array('id'=>'1'));
	    if(!$this->session->userdata('uid'))
	    { 
			redirect('home');
	    }
		else
		{
			$this->loginuser = $this->Admin_mo->getrowjoinLeftLimit('users.*,usertypes.utprivileges as privileges','users',array('usertypes'=>'users.uutid=usertypes.utid'),array('users.uid'=>$this->session->userdata('uid')),'');
			$this->sections = array();
			$sections = $this->Admin_mo->getwhere('sections',array('scactive'=>'1'));
			if(!empty($sections))
			{
				foreach($sections as $section) { $this->sections[$section->scid] = $section->sccode; }
			}
		}
	}

	public function index()
	{
		if(strpos($this->loginuser->privileges, ',odsee,') !== false && in_array('OD',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); $data['employees'] = array(); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$plans = $this->Admin_mo->get('plans'); $data['plans'] = array(); $pltitle = 'pltitle'.$this->mysystem->langs; foreach($plans as $plan) { $data['plans'][$plan->plid] = $plan->$pltitle; }
		$data['orders'] = $this->Admin_mo->get('orders');
		//$data['orders'] = $this->Admin_mo->getjoinLeft('orders.*,categories.cgtitle'.$this->mysystem->langs.' as category','plans',array('categories'=>'plans.plcgid = categories.cgid'),array());
		$this->load->view('calenderdate');
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/orders',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',odadd,') !== false && in_array('OD',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
		$this->load->view('headers/order-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/order-add',$data);
		$this->load->view('footers/order-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',odadd,') !== false && in_array('OD',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]|is_unique[categories.cgtitleen]');
		$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]|is_unique[categories.cgtitlear]');
		$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
		$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
		$this->form_validation->set_rules('type', 'lang:type' , 'trim|required');
		$this->form_validation->set_rules('price', 'lang:price' , 'trim|required|numeric');
		$this->form_validation->set_rules('category', 'lang:category' , 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['system'] = $this->mysystem;
			$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
			$this->load->view('headers/plan-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/plan-add',$data);
			$this->load->view('footers/plan-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('pluid'=>$this->session->userdata('uid'), 'pltitleen'=>set_value('titleen'), 'pldescen'=>set_value('descen'), 'pltitlear'=>set_value('titlear'), 'pldescar'=>set_value('descar'), 'pltype'=>set_value('type'), 'plprice'=>set_value('price'), 'plcgid'=>set_value('category'), 'plactive'=>set_value('active'), 'pltime'=>time());
			$plid = $this->Admin_mo->set('plans', $set_arr);
			if(empty($plid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('plans/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('plans', 'refresh');
			}
		}
		//redirect('plans/add', 'refresh');
		}
		else
		{
		$data['title'] = 'plans';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/plans',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/plans');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',odedit,') !== false && in_array('OD',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$plans = $this->Admin_mo->get('plans'); $data['plans'] = array(); $pltitle = 'pltitle'.$this->mysystem->langs; foreach($plans as $plan) { $data['plans'][$plan->plid] = $plan->$pltitle; }
		$orders = $this->Admin_mo->getjoinLeft('orders.*,users.uname as user','orders',array('users'=>'orders.odeid = users.uid'),array('orders.odid'=>$id));
		$data['order'] = $orders[0];
		if(!empty($data['order']))
		{
			$data['categories'] = $this->Admin_mo->getwhere('categories',array('cgactive'=>'1'));
			$this->load->view('headers/order-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/order-edit',$data);
			$this->load->view('footers/order-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'orders';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/orders',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/orders');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
	}
	
	public function editorder($id)
	{
		if(strpos($this->loginuser->privileges, ',odedit,') !== false && in_array('OD',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('status', 'lang:status' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$plans = $this->Admin_mo->get('plans'); $data['plans'] = array(); $pltitle = 'pltitle'.$this->mysystem->langs; foreach($plans as $plan) { $data['plans'][$plan->plid] = $plan->$pltitle; }
				$orders = $this->Admin_mo->getjoinLeft('orders.*,users.uname as user','orders',array('users'=>'orders.odeid = users.uid'),array('orders.odid'=>$id));
				$data['order'] = $orders[0];
				$this->load->view('headers/order-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/order-edit',$data);
				$this->load->view('footers/order-edit');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('oduid'=>$this->session->userdata('uid'), 'odtype'=>set_value('status'), 'odtime'=>time());
				if($this->Admin_mo->update('orders', $update_array, array('odid'=>$id)))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('orders', 'refresh');			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('orders', 'refresh');
		}
		//redirect('orders', 'refresh');
		}
		else
		{
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',oddelete,') !== false && in_array('OD',$this->sections))
		{
		$order = $this->Admin_mo->getrow('orders', array('odid'=>$id));
		if(!empty($order))
		{
			$this->Admin_mo->del('orders', array('odid'=>$id));
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('orders', 'refresh');
		}
		else
		{
			$data['title'] = 'orders';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/orders',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/orders');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'orders';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/orders',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/orders');
		$this->load->view('messages');
		}
	}
}