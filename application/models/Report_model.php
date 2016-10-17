<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends MY_Model  {

	

	public function getData($limit, $start,$product_id = '',$client_id = '' ,$date = ''){
		if ($product_id) {
			// Filter product id 
			$this->db->where('products.product_id', $product_id);
		}
		if ($client_id) {

			// Filter client_id id 

			$this->db->where('clients.client_id', $client_id);
			// join when client filter is used
			$this->db->join('clients', 'clients.client_id = invoices.client_id', 'left');

		}
		if ($date) {
			
			switch ($date) {
				case '1':
					// get last month to today date
					$this->db->where('  invoices.invoice_date >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) and invoices.invoice_date <= CURDATE()');
					break;

				case '2':
				// Add Current month to filter
				$this->db->where('MONTH(invoices.invoice_date) = MONTH(CURDATE()) AND YEAR(invoices.invoice_date) = YEAR(CURDATE())');
					break;
				case '3':
				// Add Current Year to filter
				$this->db->where('YEAR(invoices.invoice_date) = YEAR(CURDATE())');
				
					break;
				case '4':
				// Add Current Last to filter
					$this->db->where('YEAR(invoices.invoice_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
					break;	

				default:
					
					break;
			}
		
		}	
		$this->db->select('products.product_description,invoices.*,invoicelineitems.*,(invoicelineitems.price * invoicelineitems.qty) AS total', FALSE);
		$this->db->join('invoicelineitems', 'invoicelineitems.invoice_num = invoices.invoice_num', 'left');	
		
		$this->db->join('products', 'products.product_id = invoicelineitems.product_id', 'left');	

		$this->db->group_by('invoices.invoice_num');

		$this->db->limit($limit, $start);
		$this->db->order_by('invoices.invoice_date', 'asc');
		$result = $this->db->get('invoices')->result();
		
		return $result;
	}

	public function count_data($product_id = '',$client_id = '' ,$date = ''){

		if ($product_id) {
			// Filter product id 
			$this->db->where('invoicelineitems.product_id', $product_id);

			$this->db->join('invoicelineitems', 'invoicelineitems.invoice_num = invoices.invoice_num', 'left');	

		}
		if ($client_id) {
			// Client  filter to get client data
			$this->db->where('clients.client_id', $client_id);

			$this->db->join('clients', 'clients.client_id = invoices.client_id', 'left');

		}
		if ($date) {
			// date  filter to get filter  data
			switch ($date) {
				case '1':
					
					$this->db->where('  invoices.invoice_date >= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) and invoices.invoice_date <= CURDATE()');
					break;

				case '2':
				$this->db->where('MONTH(invoices.invoice_date) = MONTH(CURDATE()) AND YEAR(invoices.invoice_date) = YEAR(CURDATE())');
					break;
				case '3':
				$this->db->where('YEAR(invoices.invoice_date) = YEAR(CURDATE())');
				
					break;
				case '4':
					$this->db->where('YEAR(invoices.invoice_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))');
					break;	

				default:
					
					break;
			}
		
		}	
		// here we count result of invoices
		$this->db->select('count(*) as total');
		$result = $this->db->get('invoices')->row();
		return $result->total;

	}
}