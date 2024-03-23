<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Main extends CI_Controller
{

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index($page = 'Home')
	{
		$this->load->helper(array('url', 'form'));
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$this->load->helper(array('url', 'form'));
		// session_start();
		require_once __DIR__ . '/../../vendor/autoload.php';

		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->model('UserModel');
		//$dbdata['youmaylike'] = $this->UserModel->youmaylike();
		$dbdata['newarrivals'] = $this->UserModel->newarrivals(2);
		//$dbdata['bestselling'] = $this->UserModel->bestselling();

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page, $dbdata);

		$this->load->view('templates/Footer');
	}
	public function brands($page = 'Brands')
	{
		$this->load->helper('url');
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page);
		$this->load->view('templates/Footer');
	}
	public function hotdeals($page = 'Hotdeals')
	{
		$this->load->helper('url');
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$this->load->model('UserModel');
		//$dbdata['youmaylike'] = $this->UserModel->youmaylike();
		$dbdata['newarrivals'] = $this->UserModel->newarrivals(10);
		//$dbdata['bestselling'] = $this->UserModel->bestselling();

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page, $dbdata);

		$this->load->view('templates/Footer');

	}
	public function favourites($page = 'Favourites')
	{
		$this->load->helper('url');
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page);
		$this->load->view('templates/Footer');
	}
	public function aboutus($page = 'AboutUs')
	{
		$this->load->helper('url');
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page);
		$this->load->view('templates/Footer');
	}
	public function search($page = 'Search')
	{
		$this->load->helper(array('url', 'form'));
		$searchtext = $this->input->post('searchtext');

		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->model('UserModel');
		$dbdata['document'] = $this->UserModel->getrecords($searchtext);

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page, $dbdata);

		$this->load->view('templates/Footer');
	}
	public function newarrivals($page = 'NewArrivals')
	{
		$this->load->helper(array('url', 'form'));
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->model('UserModel');
		//$dbdata['youmaylike'] = $this->UserModel->youmaylike();
		$dbdata['newarrivals'] = $this->UserModel->newarrivals(10);
		//$dbdata['bestselling'] = $this->UserModel->bestselling();

		$this->load->view('templates/Header', $data);
		$this->load->view('pages/' . $page, $dbdata);

		$this->load->view('templates/Footer');
	}

	public function googleauth()
	{
		$this->load->helper(array('url', 'form'));
		// session_start();
		require_once __DIR__ . '/../../vendor/autoload.php';

		// $clientID = '700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com';
		// $clientSecret = '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';
		// $redirectUri = 'http://localhost/index.php';

		// $client = new Google_Client();
		// $client->setClientId($clientID);
		// $client->setClientSecret($clientSecret);
		// $client->setRedirectUri($redirectUri);
		// $client->addScope("email");
		// $client->addScope("profile");

		// $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		// var_dump($token);
		//$client->setAccessToken($token['access_token']);
	  

		$google_client = new Google_Client();
		$google_client->setClientId('700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com'); //Define your ClientID
		$google_client->setClientSecret('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'); //Define your Client Secret Key
		$google_client->setRedirectUri('http://localhost/index.php/Main/googleauth'); //Define your Redirect Uri
		$google_client->addScope('email');
		$google_client->addScope('profile');



		// if (isset ($_GET["code"])) {
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
			var_dump($token);
		// 	if (!isset ($token["error"])) {
		// 		$google_client->setAccessToken($token['access_token']);

		// 		$this->session->set_userdata('access_token', $token['access_token']);

		// 		$google_service = new Google_Service_Oauth2($google_client);

		// 		$data = $google_service->userinfo->get();

		// 		$current_datetime = date('Y-m-d H:i:s');
		// 		var_dump($data);
		// 		echo "yay";

		// 		// if ($this->google_login_model->Is_already_register($data['id'])) {
		// 		// 	//update data
		// 		// 	$user_data = array(
		// 		// 		'first_name' => $data['given_name'],
		// 		// 		'last_name' => $data['family_name'],
		// 		// 		'email_address' => $data['email'],
		// 		// 		'profile_picture' => $data['picture'],
		// 		// 		'updated_at' => $current_datetime
		// 		// 	);

		// 		// 	//$this->google_login_model->Update_user_data($user_data, $data['id']);
				//} 
				//else {
		// 		// 	//insert data
		// 		// 	$user_data = array(
		// 		// 		'login_oauth_uid' => $data['id'],
		// 		// 		'first_name' => $data['given_name'],
		// 		// 		'last_name' => $data['family_name'],
		// 		// 		'email_address' => $data['email'],
		// 		// 		'profile_picture' => $data['picture'],
		// 		// 		'created_at' => $current_datetime
		// 		// 	);

		// 		// 	//$this->google_login_model->Insert_user_data($user_data);
		// 		// }
		// 		// $this->session->set_userdata('user_data', $user_data);
		// 	}
		//}
	}
	public function login()
	{
		require_once __DIR__ . '/../../vendor/autoload.php';

		$google_client = new Google_Client();
		$google_client->setClientId('700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com'); //Define your ClientID
		$google_client->setClientSecret('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'); //Define your Client Secret Key
		$google_client->setRedirectUri('http://localhost/index.php/Main/googleauth'); //Define your Redirect Uri
		$google_client->addScope('email');
		$google_client->addScope('profile');
		$this->load->helper(array('url', 'form'));
		// // redirect($google_client->createAuthUrl());



		// require_once __DIR__ . '/../../vendor/autoload.php';

		// $clientID = '700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com';
		// $clientSecret = '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';
		// $redirectUri = 'http://localhost/index.php';

		// $client = new Google_Client();
		// $client->setClientId($clientID);
		// $client->setClientSecret($clientSecret);
		// $client->setRedirectUri($redirectUri);
		// $client->addScope("email");
		// $client->addScope("profile");
		redirect($google_client->createAuthUrl());
	}
	public function logout()
	{
		$this->load->helper(array('url', 'form'));
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('user_data');
		redirect('');
	}

}