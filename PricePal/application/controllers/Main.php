<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->helper('url');
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately
		
        $this->load->view('templates/Header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/Footer');
	}
	public function brands($page = 'Brands')
	{
		$this->load->helper('url');
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately
		
        $this->load->view('templates/Header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/Footer');
	}
	public function hotdeals($page = 'Hotdeals')
	{
		$this->load->helper('url');
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately
		
        $this->load->view('templates/Header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/Footer');
	}
	public function favourites($page = 'Favourites')
	{
		$this->load->helper('url');
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		//$this->load->view('Home');
		$data['title'] = ucfirst($page); // Capitalize the first letter


		// the "TRUE" argument tells it to return the content, rather than display it immediately
		
        $this->load->view('templates/Header');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/Footer');
	}
}
