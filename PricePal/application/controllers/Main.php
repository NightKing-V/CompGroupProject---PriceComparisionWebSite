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

	public function login()
	{
		require_once __DIR__ . '/../../vendor/autoload.php';
		// $google_client = new Google_Client();
		$clientID = '88562608070-qkp2gel2uinc23u1nj21j149c7nean8f.apps.googleusercontent.com';
		$clientSecret = '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';
		$redirectUri = 'http://localhost/index.php/Main/login';
		$client = new Google_Client();
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectUri);
		$client->addScope("email");
		$client->addScope("profile");

		$this->load->library('session');
		$this->load->helper(array('url', 'form'));
		// if (isset ($_GET['code'])) {
		// 	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		// 	$client->setAccessToken($token['access_token']);

		// 	// get profile info
		// 	$google_oauth = new Google_Service_Oauth2($client);
		// 	$google_account_info = $google_oauth->userinfo->get();
		// 	$email = $google_account_info->email;
		// 	$name = $google_account_info->name;


		if (isset ($_GET["code"])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			// var_dump($token);
			// if (!isset ($token["error"])) {
			$client->setAccessToken($token['access_token']);
			$this->session->set_userdata('access_token', $token['access_token']);
			$google_oauth = new Google_Service_Oauth2($client);
			$google_account_info = $google_oauth->userinfo->get();
			$email = $google_account_info->email;
			$name = $google_account_info->name;
			$this->load->model('google_login_model');
			$userinfo = [
				'First_name' => $google_account_info['givenName'],
				'Last_name' => $google_account_info['familyName'],
				'Picture' => $google_account_info['picture'],
				'Gmail' => $google_account_info['email'],
				'Tocken' => $google_account_info['id'],
			];
			$this->google_login_model->Insert_user_data($user_info);
			print_r($google_account_info);
			header('Location: /');
			// }
		} else {
			//   echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
			header('Location:' . $client->createAuthUrl() . '');
		}
	}
	public function logout()
	{
		$this->load->helper(array('url', 'form'));
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('user_data');
		session_destroy();
		redirect('');
	}

}