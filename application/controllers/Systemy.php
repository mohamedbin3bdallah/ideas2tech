<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systemy extends CI_Controller {

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
		if($this->loginuser->uutid == '1')
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/system',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/system',$data);
		$this->load->view('footers/system');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'system';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/system',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/system');
		$this->load->view('messages');
		}
	}

	public function edit()
	{
		if($this->loginuser->uutid == '1')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('website', 'lang:website' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('currency', 'lang:currency' , 'trim|required|max_length[9]');
			$this->form_validation->set_rules('payemail', 'lang:payemail' , 'trim|required|valid_email|max_length[255]');
			$this->form_validation->set_rules('calendar', 'lang:calendar' , 'trim|required|max_length[25]');
			//$this->form_validation->set_rules('langs[]', 'lang:langs' , 'trim|required');
			$this->form_validation->set_rules('langs', 'lang:langs' , 'trim|required');
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) $this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
			if($this->form_validation->run() == FALSE)
			{
				//$data['admessage'] = 'validation error';
				//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
				$data['system'] = $this->mysystem;
				$this->load->view('headers/system',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/system',$data);
				$this->load->view('footers/system');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('website'=>set_value('website'), 'currency'=>set_value('currency'), 'payemail'=>set_value('payemail'), 'calendar'=>set_value('calendar'), 'langs'=>set_value('langs'), /*'langs'=>implode(',',set_value('langs')), */'uid'=>$this->session->userdata('uid'), 'time'=>time());
				if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
				{
					//$newname = mt_rand();
					$file = $this->uploadimg('file', 'imgs/', mt_rand());
					if($file)
					{
						if(set_value('oldlogo') != '') unlink(set_value('oldlogo'));
						$update_array['logo'] = $file;
					}
				}
				if($this->Admin_mo->update('system', $update_array, array('id'=>'1')))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('systemy', 'refresh');
			}
			//redirect('systemy', 'refresh');
		}
		else
		{
		$data['title'] = 'system';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/system',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/system');
		$this->load->view('messages');
		}
	}
	
	public function imageSize()
	{
		if ($_FILES['file']['size'] > 1024000)
		{
			//$this->form_validation->set_message('imageSize', 'يجب ان يكون حجم الصورة 1 ميجا او اقل');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function imageType()
	{
		if (!in_array(strtoupper(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PNG','JIF','BMP','TIF')))
		{
			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PIG,JIF,BMP,TIF');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function uploadimg($inputfilename,$image_director,$newname)
	{
		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);
		if(!is_dir($image_director)) $create_image_director = mkdir($image_director);
		$name = $newname.'.'.$file_extn;
		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name)) return $image_director.$name;
		else return 0;
	}
}