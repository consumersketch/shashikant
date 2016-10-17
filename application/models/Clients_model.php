<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients_model extends MY_Model  {

    
	public function getProductsByClientID($client_id){

		if ($client_id) {
			$this->db->select('products.*');
			$this->db->where('clients.client_id', $client_id);
			$this->db->join('products', 'products.client_id = clients.client_id', 'left');
			$this->db->group_by('products.product_id');
			$result = $this->db->get('clients')->result();
			return $result;
		}

	}

}

/* End of file Client.php */
/* Location: ./application/models/Client.php */