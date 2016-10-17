<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	
	

	public function index()
	{

		$clients_id= $this->input->get('clients_id');
		$this->load->model('clients_model','clients');
		$data['products'] = '';
		if ($clients_id) {
			$products = $this->clients->getProductsByClientID($clients_id);
			//echo $this->db->last_query();
			$data['products'] = $products;
		}
		

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */