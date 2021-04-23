<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',abedit,') !== false && in_array('AB',$this->sections))
		{
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['about'] = $this->Admin_mo->getrow('about',array('abid'=>'1'));
		if(!empty($data['about']))
		{
			$this->load->view('headers/about-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/about-edit',$data);
			$this->load->view('footers/about-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'about';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/about',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/about');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('messages');
		}
	}

	public function edit()
	{
		if(strpos($this->loginuser->privileges, ',abedit,') !== false && in_array('AB',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
				$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
			$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
			//$this->form_validation->set_rules('page', 'صفحة الواجهة' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['about'] = $this->Admin_mo->getrow('about',array('abid'=>'1'));
				$this->load->view('headers/about-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/about-edit',$data);
				$this->load->view('footers/about-edit');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('abuid'=>$this->session->userdata('uid'), 'abdescen'=>set_value('descen'), 'abdescar'=>set_value('descar'), 'abtime'=>time());
				if($this->Admin_mo->update('about', $update_array, array('abid'=>'1')))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('aboutus', 'refresh');
			}
		}
		else
		{
		$data['title'] = 'about';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/about',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/about');
		$this->load->view('messages');
		}
	}
}