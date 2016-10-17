<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends MY_Model  {

	
	

	public function getClientByProductID($product_id){

		if ($product_id) {
			$this->db->select('products.client_id,client_name');
			$this->db->where('products.product_id', $product_id);
			$this->db->join('clients', 'clients.client_id = products.client_id', 'left');
			$this->db->group_by('products.product_id');
			$result = $this->db->get('products')->result();
			return $result;
		}

	}
	
	

}

/* End of file Product.php */
/* Location: ./application/models/Product.php */