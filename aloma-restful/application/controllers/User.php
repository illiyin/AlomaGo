<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class User extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_adm');
		$this->defaultMessage = array(
				'is_ok' => false,
				'error_message' => 'Unknown method'
			);
		$this->defaultCode = REST_Controller::HTTP_BAD_REQUEST;
	}

	public function index_post($action = '')
	{
		$this->responseMessage = $this->defaultMessage;
		$this->responseCode = $this->defaultCode;

		if ($action) 
		{
			switch($action)
			{
				case 'login':
					$result = $this->doLogin();
					$this->response($result['responseMessage'], $result['responseCode']);
				break;
				
				default:
					$this->response($this->responseMessage, $this->responseCode);
				break;
			}
		} else {
			$this->response($this->responseMessage, $this->responseCode);
		}
	}

	private function doLogin()
	{
		$params = $this->post();

		$condition['username'] = $params['username'];
		$condition['password'] = md5($params['password']);

		$query = $this->model_adm->select($condition, 'administrator');

		$num = $query->num_rows();

		return array(
				'responseMessage' => array(
					'is_ok' => $num > 0 ? true : false,
					$num > 0 ? 'data' : 'error_message' =>
					$num > 0 ? $query->row() : 'Username atau Password salah'
				),
				'responseCode' => REST_Controller::HTTP_OK
			);
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */