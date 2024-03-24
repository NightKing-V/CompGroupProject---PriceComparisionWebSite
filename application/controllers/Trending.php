<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Trending extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load the Trending model
        $this->load->model('Trending_model');
        // Ensure sessions and necessary helpers are loaded if not autoloaded
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function update_views()
    {
        // Ensure this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            exit ('No direct script access allowed');
        }
        // Manually get and decode the JSON from the request body
        $postData = json_decode(file_get_contents('php://input'), true);

        // Extract product ID and category from the decoded data
        $productID = isset ($postData['product_id']) ? $postData['product_id'] : null;
        $productcategory = isset ($postData['product_category']) ? $postData['product_category'] : null;

        // Validate the input
        if (empty ($productID) || empty ($productcategory)) {
            // Respond with an error if validation fails
            echo json_encode(['status' => 'error', 'message' => 'Missing product ID or category']);
            return;
        }

        // Call the model function to update/add the product view count
        $result = $this->Trending_model->add_count($productID, $productcategory);

        // Respond based on the outcome
        if ($result === 'inserted' || $result === 'updated') {
            echo json_encode(['status' => 'success', 'message' => 'View count updated']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update view count']);
        }
    }

    public function trending_items()
    {
        $this->load->model('Trending_model');
        $result = $this->Trending_model->get_trending_products(10);
        $jsonResult = json_encode($result);

        // Set the content type to JSON and output the JSON string
        $this->output
            ->set_content_type('application/json')
            ->set_output($jsonResult);
    }

    public function update_favourites()
    {
        // Ensure this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            $this->output->set_status_header(403); // Forbidden
            echo json_encode(['status' => 'error', 'message' => 'No direct script access allowed']);
            return;
        }

        // Manually get and decode the JSON from the request body
        $postData = json_decode(file_get_contents('php://input'), true);

        // Extract product ID, email, and category from the decoded data
        $productID = isset ($postData['product_id']) ? $postData['product_id'] : null;
        $email = $_SESSION['email'];
        $productCategory = isset ($postData['product_category']) ? $postData['product_category'] : null;

        // Validate the input
        if (empty ($productID) || empty ($productCategory)) {
            $this->output->set_content_type('application/json')
                ->set_status_header(400) // Bad Request
                ->set_output(json_encode(['status' => 'error', 'message' => 'Missing required information']));
            return;
        }

        // Load the Trending_model and attempt to add to favorites
        $this->load->model('Trending_model');
        $result = $this->Trending_model->add_favourites($productID, $email, $productCategory);

        // Prepare the response based on the outcome
        if ($result === 'favourite removed' || $result === 'favourite added') {
            $this->output->set_content_type('application/json')
                ->set_status_header(200) // OK
                ->set_output(json_encode(['status' => 'success', 'message' => 'Added to Favourites']));
        } else {
            $this->output->set_content_type('application/json')
                ->set_status_header(500) // Internal Server Error
                ->set_output(json_encode(['status' => 'error', 'message' => 'Failed to add to favourites']));
        }
    }

}
