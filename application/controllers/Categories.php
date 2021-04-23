<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

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
		if(strpos($this->loginuser->privileges, ',cgsee,') !== false && in_array('CG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$employees = $this->Admin_mo->get('users'); foreach($employees as $employee) { $data['employees'][$employee->uid] = $employee->username; }
		$data['categories'] = $this->Admin_mo->get('categories');
		$this->load->view('calenderdate');
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/categories',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}

	public function add()
	{
		if(strpos($this->loginuser->privileges, ',cgadd,') !== false && in_array('CG',$this->sections))
		{
		$data['admessage'] = '';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/category-add',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/category-add',$data);
		$this->load->view('footers/category-add');
		$this->load->view('messages');
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}
	
	public function create()
	{
		if(strpos($this->loginuser->privileges, ',cgadd,') !== false && in_array('CG',$this->sections))
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
		$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]|is_unique[categories.cgtitlear]');
		$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]|is_unique[categories.cgtitleen]');
		$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
		$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
		$this->form_validation->set_rules('img', 'lang:image' , 'callback_imageSize|callback_imageType');
		if($this->form_validation->run() == FALSE)
		{
			$data['system'] = $this->mysystem;
			$this->load->view('headers/category-add',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/category-add',$data);
			$this->load->view('footers/category-add');
			$this->load->view('messages');
		}
		else
		{
			$set_arr = array('cguid'=>$this->session->userdata('uid'), 'cgtitleen'=>set_value('titleen'), 'cgdescen'=>set_value('descen'), 'cgtitlear'=>set_value('titlear'), 'cgdescar'=>set_value('descar'), 'cgactive'=>set_value('active'), 'cgtime'=>time());
			if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $set_arr['cgimg'] = $this->uploadimg('img',$this->config->item('categories_folder'),$this->config->item('categories_thumb_folder'),mt_rand()); };
			$cgid = $this->Admin_mo->set('categories', $set_arr);
			if(empty($cgid))
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
				redirect('categories/add', 'refresh');
			}
			else
			{
				$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
				redirect('categories', 'refresh');
			}
		}
		//redirect('categories/add', 'refresh');
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}
	
	public function edit($id)
	{
		if(strpos($this->loginuser->privileges, ',cgedit,') !== false && in_array('CG',$this->sections))
		{
		$id = abs((int)($id));
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$data['category'] = $this->Admin_mo->getrow('categories',array('cgid'=>$id));
		if(!empty($data['category']))
		{
			$this->load->view('headers/category-edit',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/category-edit',$data);
			$this->load->view('footers/category-edit');
			$this->load->view('messages');
		}
		else
		{
			$data['title'] = 'categories';
			$data['admessage'] = 'youhavenoprivls';
			$this->load->view('headers/categories',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/categories');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}
	
	public function editcategory($id)
	{
		if(strpos($this->loginuser->privileges, ',cgedit,') !== false && in_array('CG',$this->sections))
		{
		$id = abs((int)($id));
		if($id != '')
		{
		    $this->lang->load($this->mysystem->langs, $this->mysystem->langs);
				$this->config->set_item('language', $this->mysystem->langs);
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>', '</div>');
			$this->form_validation->set_rules('titlear', 'lang:titlear' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('titleen', 'lang:titleen' , 'trim|required|max_length[255]');
			$this->form_validation->set_rules('descar', 'lang:descar' , 'trim|required');
			$this->form_validation->set_rules('descen', 'lang:descen' , 'trim|required');
			if($this->form_validation->run() == FALSE)
			{
				$data['system'] = $this->mysystem;
				$data['category'] = $this->Admin_mo->getrow('categories',array('cgid'=>$id));
				$this->load->view('headers/category-edit',$data);
				$this->load->view('sidemenu',$data);
				$this->load->view('topmenu',$data);
				$this->load->view('admin/category-edit',$data);
				$this->load->view('footers/category-edit');
				$this->load->view('notifys');
				$this->load->view('messages');
			}
			else
			{
				if($this->Admin_mo->exist('categories','where cgid <> '.$id.' and cgtitleen like "'.set_value('title').'"',''))
				{
					$_SESSION['time'] = time(); $_SESSION['message'] = 'nameexist';
					redirect('categories/edit/'.$id, 'refresh');
				}
				else
				{
					$update_array = array('cguid'=>$this->session->userdata('uid'), 'cgtitleen'=>set_value('titleen'), 'cgdescen'=>set_value('descen'), 'cgtitlear'=>set_value('titlear'), 'cgdescar'=>set_value('descar'), 'cgactive'=>set_value('active'), 'cgtime'=>time());
					if(isset($_FILES['img']['error']) && $_FILES['img']['error'] == 0) { $update_array['cgimg'] = $this->uploadimg('img',$this->config->item('categories_folder'),$this->config->item('categories_thumb_folder'),mt_rand()); if($update_array['cgimg'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('categories_folder').set_value('oldimg'))) unlink($this->config->item('categories_folder').set_value('oldimg')); if($update_array['cgimg'] != '' && set_value('oldimg') != '' && file_exists($this->config->item('categories_thumb_folder').set_value('oldimg'))) unlink($this->config->item('categories_thumb_folder').set_value('oldimg')); }
					if($this->Admin_mo->update('categories', $update_array, array('cgid'=>$id)))
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
					}
					else
					{
						$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
					}
					redirect('categories', 'refresh');
				}
			}
		}
		else
		{
			$data['admessage'] = 'Not Saved';
			$_SESSION['time'] = time(); $_SESSION['message'] = 'somthingwrong';
			redirect('categories', 'refresh');
		}
		//redirect('categories', 'refresh');
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}

	public function del($id)
	{
		$id = abs((int)($id));
		if(strpos($this->loginuser->privileges, ',cgdelete,') !== false && in_array('CG',$this->sections))
		{
		$category = $this->Admin_mo->getrow('categories', array('cgid'=>$id));
		if(!empty($category))
		{
			$this->Admin_mo->del('categories', array('cgid'=>$id));
			if($category->cgimg != '' && file_exists($this->config->item('categories_folder').$category->cgimg)) unlink($this->config->item('categories_folder').$category->cgimg);
			if(file_exists($this->config->item('categories_thumb_folder').$category->cgimg)) unlink($this->config->item('categories_thumb_folder').$category->cgimg);
			$_SESSION['time'] = time(); $_SESSION['message'] = 'success';
			redirect('categories', 'refresh');
		}
		else
		{
			$data['title'] = 'categories';
			$data['admessage'] = 'youhavenoprivls';
			$data['system'] = $this->mysystem;
			$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
			$this->config->set_item('language', $this->mysystem->langs);
			$this->load->view('headers/categories',$data);
			$this->load->view('sidemenu',$data);
			$this->load->view('topmenu',$data);
			$this->load->view('admin/messages',$data);
			$this->load->view('footers/categories');
			$this->load->view('messages');
		}
		}
		else
		{
		$data['title'] = 'categories';
		$data['admessage'] = 'youhavenoprivls';
		$data['system'] = $this->mysystem;
		$this->lang->load($this->mysystem->langs, $this->mysystem->langs);
		$this->config->set_item('language', $this->mysystem->langs);
		$this->load->view('headers/categories',$data);
		$this->load->view('sidemenu',$data);
		$this->load->view('topmenu',$data);
		$this->load->view('admin/messages',$data);
		$this->load->view('footers/categories');
		$this->load->view('messages');
		}
	}
	
	public function imageSize()
	{
		if ($_FILES['img']['size'] > 1024000)
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
		if (!in_array(strtoupper(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)),array('JPG','JPEG','PNG','JIF','BMP','TIF')))
		{
			//$this->form_validation->set_message('imageType', 'يجب ان يكون نوع الملف المرفوع واحد من هذه الانواع : JPG,JPEG,PNG,JIF,BMP,TIF');
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
		$name = $newname.".".$file_extn;
		if(move_uploaded_file($_FILES[$inputfilename]["tmp_name"], $image_director.$name))
		{
			if($image_director_thumb != '')
			{
				$this->load->library('Resize');
				$this->resize->construct($image_director.$name);
				$this->resize->resizeImage(275, 275, 'exact');
				$this->resize->saveImage($image_director_thumb.$name, 100);
			}
			return $name;
		}
		else return '';
	}
}