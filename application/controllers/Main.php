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
		require_once __DIR__ . '/../../vendor/autoload.php';

		$google_client = new Google_Client();
		$google_client->setClientId('700745614672-1kdqi1qe36gguegcm72ho48mr89fqoup.apps.googleusercontent.com');
		$google_client->setClientSecret('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');
		$google_client->setRedirectUri('http://localhost/index.php/Main/googleauth');
		$google_client->addScope('email');
		$google_client->addScope('profile');

		if (isset ($_GET["code"])) {
			// Attempt to get the access token using the authorization code
			$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

			if (!isset ($token["error"])) {
				// Access token obtained successfully
				$google_client->setAccessToken($token['access_token']);

				// Optionally, save the access token in the session
				$this->session->set_userdata('access_token', $token['access_token']);

				// Get user info from Google
				$google_service = new Google_Service_Oauth2($google_client);
				$data = $google_service->userinfo->get();

				// Here, you would typically check if the user exists in your database
				// If they do, log them in. If not, register them.
				// For demonstration, let's just var_dump the user data
				var_dump($data);
			} else {
				// Handle error in obtaining the token
				echo "Error Authenticating: " . $token["error"];
			}
		} else {
			// If the "code" parameter is not present, it's an invalid request
			echo "Invalid Request";
		}
	}

	public function login()
	{
		require_once __DIR__ . '/../../vendor/autoload.php';
		$this->load->model('Google_login_model');

		$clientID = '891878224579-1nbf692cgc0ff0r023n4c2ia367eihfl.apps.googleusercontent.com';
		$clientSecret = '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';
		$redirectUri = 'http://localhost/index.php/Main/login';
		$client = new Google_Client();
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectUri);
		$client->addScope("email");
		$client->addScope("profile");

		$this->load->helper(array('url', 'form'));
		if (isset ($_GET['code'])) {
			$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
			$client->setAccessToken($token['access_token']);

			// get profile info
			$google_oauth = new Google_Service_Oauth2($client);
			$google_account_info = $google_oauth->userinfo->get();
<<<<<<< Updated upstream
			$email =  $google_account_info->email;
			$id =  $google_account_info->id;
			$name =  $google_account_info->name;
			$firstName =  $google_account_info->givenName;
			$lastName =  $google_account_info->familyName;
			$profilePic =  $google_account_info->picture;

			$authData = [
				'id' => $id,
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'profile' => $profilePic,
				'name' => $name
			];

			$_SESSION['first_name'] = $firstName;
			// echo "<pre>";
			// print_r($google_account_info);
			$this->Google_login_model->Insert_user_data($authData);
=======
			$email = $google_account_info->email;
			$name = $google_account_info->name;
			$_SESSION['email'] = $email;
>>>>>>> Stashed changes
			header('Location: /');

		} else {
			//   echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
			header('Location:' . $client->createAuthUrl() . '');
		}
	}
	public function logout()
	{
		$this->load->helper('url');

		// Destroys the session and all its data
		$this->session->sess_destroy();

		// Redirect to the base URL or login page
		redirect(base_url());
	}
}