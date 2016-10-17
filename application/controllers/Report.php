<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		// load libarary of pagination
		$this->load->library('pagination');

	}

	// Index Function 
	public function index()
	{

		// load model and make alias name of clients_model model
		$this->load->model('clients_model', 'clients');

		// get client Data
		$data['clients'] = $this->clients->get_all();

		//Load model and make aias of products_model model
		$this->load->model('products_model', 'products');

		//get Product data
		$data['products'] = $this->products->get_all();
		$this->load->model('report_model', 'report');

		// Pageination config
		$config['base_url'] = site_url('report/getData');

        $config['total_rows'] = $this->report->count_data();
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);

        $data['page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

        //call the model function to get the invoice data
        $data['report'] = $this->report->getData($config["per_page"], $data['page']);           

        // pass pagination link in data after genearate
        $data['pagination'] = $this->pagination->create_links();


		
		$this->load->view('default/index',$data);
	}

	public function getData(){

		$product_id = $this->input->get('product_id');
		$client_id = $this->input->get('client_id');
		$date = $this->input->get('date');
		
		$this->load->model('report_model', 'report');

		$data['page'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		// Pageination config

		$config['base_url'] = site_url('report/getData');

        $config['total_rows'] = $this->report->count_data($product_id,$client_id,$date);
        $config['per_page'] = "20";
        
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['page_query_string'] = true;
        $this->pagination->initialize($config);
        $report = $this->report->getData($config["per_page"], $data['page'],$product_id,$client_id,$date);

        // pass report in data
		$data['report'] = $report;


        $data['pagination'] = $this->pagination->create_links();

        // set content type as json and pass to view.

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		

	}


	
}
