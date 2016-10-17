<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clients_model','clients');

	}

	

	public function index()
	{

		$product_id= $this->input->get('product_id');
		$this->load->model('products_model','products');
		$data['clients'] = '';
		if ($product_id) {
			$clients = $this->products->getClientByProductID($product_id);
			//echo $this->db->last_query();
			$data['clients'] = $clients;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

/* End of file Clients.php */
/* Location: ./application/controllers/Clients.php */