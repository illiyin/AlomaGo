<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EndpointInterface extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->endpointUri = RESTFUL_URI;
	}

	public function getJsonFromURL($url)
	{
		$curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $this->endpointUri.$url);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $jsonData = json_decode(curl_exec($curlSession));
  	curl_close($curlSession);

  	return $jsonData;
	}

	public function postJsonToURL($url , $data, $imageUpload = null)
	{
		//preping multipart header
		define('MULTIPART_BOUNDARY', '------'.microtime(true));
		$header = 'Content-Type: multipart/form-data; boundary='.MULTIPART_BOUNDARY;
	    $content = '';

	  //prepping post field
	  if($data) {
			foreach ($data as $key => $value) {
				$content .= "--".MULTIPART_BOUNDARY."\r\n"
							."Content-Disposition: form-data; name='".$key."'"
							."\r\n\r\n"
							.$value."\r\n";
			}
	  }

	  if($imageUpload) {
	  	foreach($imageUpload as $index => $data_upload) {
				$dataResult = $data_upload['data'];
		  	$file_contents = file_get_contents($dataResult['full_path']);
	      // prepping image field
	      $content .= "--".MULTIPART_BOUNDARY
	        ."\r\n"
	        ."Content-Disposition: form-data; name='gambar".$index."'; filename='".$dataResult['orig_name']."'"
	        ."\r\n"
	        ."Content-type: ".$dataResult['file_type']
	        ."\r\n\r\n"
	        .$file_contents."\r\n";
			}
	  }

		// signal end of request
		$content .= "--".MULTIPART_BOUNDARY."--\r\n";

		$context = stream_context_create(array(
				'http' => array(
						'method' => 'POST',
						'header' => $header,
						'content' => $content
					)
			));

		$result = file_get_contents($this->endpointUri.$url, false, $context);
		$this->deleteTemporary();
		return json_decode($result);
	}

	public function getTransferPulsa($id = '')
	{
		$this->uri = '/transferpulsa';

		if($id) $this->uri .= '/'.$id;

		return $this->getJsonFromURL($this->uri);
	}

	public function getInbox()
	{
		$this->uri = '/inbox';

		return $this->getJsonFromURL($this->uri);
	}

	public function getAppInfo($key = '')
	{
		$this->uri = '/appinfo/';

		if($key) $this->uri .= $key;
		
		return $this->getJsonFromURL($this->uri);
	}

	public function postAppInfo($key, $option, $data)
	{
		$this->uri = "/appinfo/".$key."/".$option;

		return $this->postJsonToURL($this->uri, $data);
	}

	public function deleteTrfPulsa($id) {
		$this->uri = '/transferpulsa/'.$id.'/delete';

		return $this->postJsonToURL($this->uri, null);
	}

	public function updateTrfPulsa($data) {
		$this->uri = '/transferpulsa/'.$data['id'].'/update';
		
		return $this->postJsonToURL($this->uri, $data);
	}

	public function login($data) {
		$this->uri = '/user/login';

		return $this->postJsonToURL($this->uri, $data);
	}

	public function postKabarBurung($id = null, $option, $data = null, $imageUpload = null) {
		$this->uri = '/kabarburung/';

		if($option == 'add') $this->uri .= 'add';
		else $this->uri .= $id.'/'.$option;

		return $this->postJsonToURL($this->uri, $data, @$imageUpload);
	}

	public function getKabarBurung($id = '') {
		$this->uri = '/kabarburung/';

		if($id) $this->uri .= $id;

		return $this->getJsonFromURL($this->uri);
	}

	private function deleteTemporary() {
		exec('rm -rf '.FCPATH.'tmp/*');
	}
}

/* End of file EndpointInterface.php */
/* Location: ./application/models/EndpointInterface.php */
