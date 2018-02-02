<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->siteTitle = "Admin Aloma Go";
		$this->admindata = $this->session->userdata('admindata');
	}

	private function isTemplate($content, $data = null)
	{
		$data['site_title'] = $this->siteTitle;
		$this->load->view('templates/header',$data);
		$this->load->view($content,$data);
		$this->load->view('templates/footer',$data);
	}

	private function isLoggedIn()
	{
		return $this->session->userdata('isLoggedIn') ? true : false;
	}

	public function index()
	{
		if(!$this->isLoggedIn()) redirect(admin_url().'login');
		$data['subTitle'] = "Dashboard";
		$data['transferPulsa'] = $this->EndpointInterface->getTransferPulsa();

		$this->isTemplate('dashboard' , $data);
	}

	public function kabarburung()
	{
		if(!$this->isLoggedIn()) redirect(admin_url().'login');
		$params = $this->input->get();
		$data['subTitle'] = "Dashboard";
		$data['kabarBurung'] = $this->EndpointInterface->getKabarBurung();
		$template = 'kabar_burung/list';

		if(isset($params['method'])) {
			switch($params['method']) {
				case 'new':
					$template = 'kabar_burung/tambah';
				break;

				case 'edit':
					if(!$params['id']) redirect();
					$data['kabarBurung'] = $this->EndpointInterface->getKabarBurung($params['id']);
					$template = 'kabar_burung/edit';
				break;

				case 'detail':
					if(!$params['id']) redirect();
					$data['kabarBurung'] = $this->EndpointInterface->getKabarBurung($params['id']);
					$template = 'kabar_burung/detail';
				break;
			}
		}

		$this->isTemplate($template, $data);
	}

	public function history()
	{
		if(!$this->isLoggedIn()) redirect(admin_url().'login');
		$params = $this->input->get();
		$data['subTitle'] = "History";

		if(!isset($params['mode']) && !isset($params['id'])) {
			$data['transferPulsa'] = $this->EndpointInterface->getTransferPulsa();
			self::isTemplate('report/history' , $data);
		} elseif($params['mode'] == 'edit' && isset($params['id'])) {
			$data['transferPulsa'] = $this->EndpointInterface->getTransferPulsa($params['id']);
			self::isTemplate('report/history_edit' , $data);
		} else{
			show_404();
			exit;
		}
	}

	public function inbox()
	{
		if(!$this->isLoggedIn()) redirect(admin_url().'login');
		$data['subTitle'] = "Inbox";
		$data['inbox'] = $this->EndpointInterface->getInbox();
		
		self::isTemplate('report/inbox' , $data);
	}

	public function disclaimer()
	{
		$data['subTitle'] = "Disclaimer";
		$data['disclaimer'] = $this->EndpointInterface->getAppInfo('disclaimer');
		self::isTemplate('app_info/disclaimer', $data);
	}

	public function privacy()
	{
		$data['subTitle'] = "Privacy &amp; Policy";
		$data['privacy'] = $this->EndpointInterface->getAppInfo('privacy');
		self::isTemplate('app_info/privacy', $data);
	}

	public function about()
	{
		$data['subTitle'] = "About";
		$data['about'] = $this->EndpointInterface->getAppInfo('about');
		self::isTemplate('app_info/about', $data);
	}

	public function url()
	{
		$data['subTitle'] = "About";
		$data['dataUrl'] = $this->EndpointInterface->getAppInfo();

		self::isTemplate('app_info/url', $data);
	}

	public function do_action()
	{
		$getdata = $this->input->get();
		$postdata = $this->input->post();
			
		if(!isset($getdata['method'])) redirect();

		switch($getdata['method'])
		{
			case 'editHistory':
				if(!$this->isLoggedIn()) redirect(admin_url().'login');
				if(!$postdata) redirect();

				$data = array(
						'id' => $postdata['id'],
						'nomor_pengirim' => $postdata['nomor_pengirim'],
						'nomor_tujuan' => $postdata['nomor_tujuan'],
						'denominasi' => $postdata['denominasi'],
						'total_pulsa_transfer' => $postdata['total_pulsa_transfer'],
						'verifikasi' => $postdata['verifikasi'],
						'sent' => $postdata['sent']
					);

				$result = $this->EndpointInterface->updateTrfPulsa($data);

				$message = $result->is_ok ? $result->message : $result->error_message;
				
				$this->session->set_flashdata('sessionMessage', $message);

				redirect(admin_url().'history');
			break;

			case 'deleteHistory':
				if(!$this->isLoggedIn()) redirect(admin_url().'login');
				$rs = $this->EndpointInterface->deleteTrfPulsa($postdata['id']);
				echo json_encode(array('is_ok' => 'Yap', 'test' => $rs));
			break;

			case 'login':
				if(!$postdata) redirect();

				$postdata = $this->input->post();
				print_r($postdata);

				$data = array(
						'username' => $postdata['username'],
						'password' => $postdata['password']
					);

				$rs = $this->EndpointInterface->login($data);

				if($rs->is_ok) {
					$sessionSet = array(
						'isLoggedIn' => true,
						'admindata' => $rs->data
					);
					$this->session->set_userdata($sessionSet);
				}

				redirect();
			break;

			case 'about':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'title' => $params['title'],
						'content' => $params['content']
					);

				$this->EndpointInterface->postAppInfo('about', 'update', $data);
				redirect(admin_url().'about');
			break;

			case 'privacy':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'title' => $params['title'],
						'content' => $params['content']
					);

				$this->EndpointInterface->postAppInfo('privacy', 'update', $data);
				redirect(admin_url().'privacy');
			break;

			case 'disclaimer':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'title' => $params['title'],
						'content' => $params['content']
					);

				$this->EndpointInterface->postAppInfo('disclaimer', 'update', $data);
				redirect(admin_url().'disclaimer');
			break;

			case 'downloadUrl':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'url-1' => $params['link1'],
						'url-2' => $params['link2'],
						'url-3' => $params['link3']
					);
				$this->EndpointInterface->postAppInfo('url', 'update', $data);
				redirect(admin_url().'url');
			break;

			case 'new_kabarburung':
				$params = $this->input->post();
				if(!$params && !$_FILES) redirect();
				
				$tempUpload = $this->do_miltiupload_files($_FILES['imageUpload']);
				$data = array(
						'title' => $params['title'],
						'author' => $params['author']
					);

				$rs = $this->EndpointInterface->postKabarBurung(null, 'add', $data , $tempUpload);
				
				redirect(admin_url().'kabarburung');
			break;

			case 'deleteKabarBurung':
				$params = $this->input->post();
				if(!$params) redirect();

				$result = $this->EndpointInterface->postKabarBurung($params['id'], 'delete');

				echo json_encode($result);
			break;

			case 'updateBerita':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'title' => $params['title'],
						'author' => $params['author']
					);

				$result = $this->EndpointInterface->postKabarBurung($params['id'], 'update_berita', $data);

				echo json_encode($result);
			break;

			case 'updateGambar':
				$params = $this->input->post();
				if(!$params) redirect();
				$data = array(
						'imageId' => $params['imageId'],
						'file' => $params['file']
					);

				$rs = $this->EndpointInterface->postKabarBurung($params['id'], 'update_gambar' , $data);
				echo json_encode($rs);
			break;

			case 'addGambar':
				$params = $this->input->post();
				if(!$params) redirect();

				echo json_encode($params);
			break;

			case 'deleteGambar':
				$params = $this->input->post();
				if(!$params) redirect();

				$data = array(
						'id_gambar' => $params['idGambar']
					);

				$result = $this->EndpointInterface->postKabarBurung($params['id'], 'delete_gambar', $data);

				echo json_encode($result);
			break;

			default:
				redirect();
			break;
		}
	}

	public function logout()
	{
		session_destroy();
		redirect(admin_url().'login');
	}

	public function login()
	{
		$this->load->view('action/login');
	}

	private function do_miltiupload_files($files)
	{
    $config = array(
        'upload_path'   => FCPATH.'tmp/',
        'allowed_types' => 'jpg|gif|png',
        'overwrite'     => 1,                 
    );

    $this->load->library('upload', $config);

    $dataReturn = null;

    foreach ($files['name'] as $key => $image) {
      $_FILES['multi_images[]']['name']= $files['name'][$key];
      $_FILES['multi_images[]']['type']= $files['type'][$key];
      $_FILES['multi_images[]']['tmp_name']= $files['tmp_name'][$key];
      $_FILES['multi_images[]']['error']= $files['error'][$key];
      $_FILES['multi_images[]']['size']= $files['size'][$key];
      $fileName = md5($image.rand(1,9999));
      $config['file_name'] = $fileName;

      $this->upload->initialize($config);

      if ($this->upload->do_upload('multi_images[]')) {
          $status = 1;
					$data = $this->upload->data();
      } else {
      	$status = 0;
				$data = $this->upload->display_errors();
      }

      $dataReturn[] = array(
      		'status' => $status,
      		'data' => $data
      	);
    }

    return $dataReturn;
	}
}