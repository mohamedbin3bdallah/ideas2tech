<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slides extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',sdsee,') !== false && in_array('SD',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['slides'] = $this->Admin_mo->get('slides');
		$this->load->view('calenderdate');
		//$data['users'] = $this->Admin_mo->rate('*','users',' where id <> 1');
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/slides',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',sdadd,') !== false && in_array('SD',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		//$data['users'] = $this->Admin_mo->get('users');
		$this->load->view('headers/slide-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/slide-add',$data);
		$this->load->view('footers/slide-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',sdadd,') !== false && in_array('SD',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|max_length[150]');
		$this->form_validation->set_rules('descen', 'lang:descen' , 'trim');
		$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|max_length[150]');
		$this->form_validation->set_rules('descar', 'lang:descar' , 'trim');
		$this->form_validation->set_rules('link', 'lang:link' , 'trim');
		/*$this->form_validation->set_rules('link1', 'lang:link1' , 'trim');
		$this->form_validation->set_rules('title1', 'lang:title1' , 'trim|max_length[99]');
		$this->form_validation->set_rules('link2', 'lang:link2' , 'trim');
		$this->form_validation->set_rules('title2', 'lang:title2' , 'trim|max_length[99]');*/
		$this->form_validation->set_rules('file', 'lang:image' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			//$data['admessage'] = 'validation error';
			//$_SESSION['time'] = time(); $_SESSION['message'] = 'inputnotcorrect';
			$data['system'] = $this->mysystem;
			$this->load->view('headers/slide-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/slide-add',$data);
			$this->load->view('footers/slide-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('sduid'=>$this->session->userdata('uid'), 'sdtitleen'=>set_value('titleen'), 'sddescen'=>set_value('descen'), 'sdtitlear'=>set_value('titlear'), 'sddescar'=>set_value('descar'), 'sdlinkurl'=>set_value('link')/*, 'sdlinkurl1'=>set_value('link1'), 'sdlinkalt1'=>set_value('title1'), 'sdlinkurl2'=>set_value('link2'), 'sdlinkalt2'=>set_value('title2')*/, 'sdactive'=>set_value('active'), 'sdtime'=>time());
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
			{
				//$newname = mt_rand();
				$file = $this->uploadimg('file',$this->config->item('slides_folder'),$this->config->item('slides_thumb_folder'), mt_rand());
				if($file)
				{
					$set_arr['sdimg'] = $file;
					$sdid = $this->Admin_mo->set('slides', $set_arr);
					if(empty($sdid))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
						redirect('slides/add', 'refresh');
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
						redirect('slides', 'refresh');
					}
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					redirect('slides/add', 'refresh');
				}
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('slides/add', 'refresh');
			}		
		}
		//redirect('slides/add', 'refresh');
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',sdedit,') !== false && in_array('SD',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['slide'] = $this->Admin_mo->getrow('slides',array('sdid'=>$id));
		if(!empty($data['slide']))
		{
			$this->load->view('headers/slide-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/slide-edit',$data);
			$this->load->view('footers/slide-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'slides';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/slides',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/slides');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
	}
	
	public function editslide($id)
	{
		if(strpos($this->loginuser->privileges, ',sdedit,') !== false && in_array('SD',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|max_length[150]');
			$this->form_validation->set_rules('descar', 'lang:descar' , 'trim');
			$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|max_length[150]');
			$this->form_validation->set_rules('descen', 'lang:descen' , 'trim');
			$this->form_validation->set_rules('link', 'lang:link' , 'trim');
			//$this->form_validation->set_rules('link1', 'lang:link1' , 'trim');
			//$this->form_validation->set_rules('title1', 'lang:title1' , 'trim|max_length[99]');
			//$this->form_validation->set_rules('link2', 'lang:link2' , 'trim');
			//$this->form_validation->set_rules('title2', 'lang:title2' , 'trim|max_length[99]');
			if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) $this->form_validation->set_rules('file', 'الصورة' , 'callback_imageSize|callback_imageType');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['slide'] = $this->Admin_mo->getrow('slides',array('sdid'=>$id));
				$this->load->view('headers/slide-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/slide-edit',$data);
				$this->load->view('footers/slide-edit');
				$this->load->view('messages');
			}
			else
			{
				$update_array = array('sduid'=>$this->session->userdata('uid'), 'sdtitleen'=>set_value('titleen'), 'sddescen'=>set_value('descen'), 'sdtitlear'=>set_value('titlear'), 'sddescar'=>set_value('descar'), 'sdlinkurl'=>set_value('link')/*, 'sdlinkurl1'=>set_value('link1'), 'sdlinkalt1'=>set_value('title1'), 'sdlinkurl2'=>set_value('link2'), 'sdlinkalt2'=>set_value('title2')*/, 'sdactive'=>set_value('active'), 'sdtime'=>time());
				if(isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0)
				{
					//$newname = mt_rand();
					$file = $this->uploadimg('file',$this->config->item('slides_folder'),$this->config->item('slides_thumb_folder'), mt_rand());
					if($file)
					{
						if(set_value('oldimg') != '' && file_exists($this->config->item('slides_folder').set_value('oldimg'))) unlink($this->config->item('slides_folder').set_value('oldimg'));
						if(set_value('oldimg') != '' && file_exists($this->config->item('slides_thumb_folder').set_value('oldimg'))) unlink($this->config->item('slides_thumb_folder').set_value('oldimg'));
						$update_array['sdimg'] = $file;
					}
				}
				if($this->Admin_mo->update('slides', $update_array, array('sdid'=>$id)))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				}
				else
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				}
				redirect('slides', 'refresh');
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('slides', 'refresh');
		}
		//redirect('slides', 'refresh');
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',sddelete,') !== false && in_array('SD',$this->sections))
		{
		$slide = $this->Admin_mo->getrow('slides', array('sdid'=>$id));
		if(!empty($slide))
		{
			$this->Admin_mo->del('slides', array('sdid'=>$id));
			if($slide->sdimg != '' && file_exists($this->config->item('slides_folder').$slide->sdimg)) unlink($this->config->item('slides_folder').$slide->sdimg);
			if(file_exists($this->config->item('slides_thumb_folder').$slide->sdimg)) unlink($this->config->item('slides_thumb_folder').$slide->sdimg);
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('slides', 'refresh');
		}
		else
		{
			$data['title'] = 'slides';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/slides',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/slides');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'slides';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/slides',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/slides');
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

	public function uploadimg($inputfilename,$image_director,$image_director_thumb,$newname)
	{
		$file_extn = pathinfo($_FILES[$inputfilename]['name'], PATHINFO_EXTENSION);
		if(!is_dir($image_director)) $create_image_director = mkdir($image_director);
		$name = $newname.'.'.$file_extn;
		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name))
		{
			if($image_director_thumb != '')
			{
				$this->load->library('Resize');
				$this->resize->construct($image_director.$name);
				$this->resize->resizeImage(210, 210, 'exact');
				$this->resize->saveImage($image_director_thumb.$name, 100);
			}
			return $name;
		}
		else return 0;
	}
}