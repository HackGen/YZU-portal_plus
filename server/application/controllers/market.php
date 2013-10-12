<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Market extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('marketmodel');
		$data['product_info'] = $this->marketmodel->get_product_data('all');

		$this->load->view('product', $data);
	}

	public function insert_product_data()
	{
		$product_title = $this->input->post('input_title');
		$product_price = $this->input->post('input_price');
		$product_type = $this->input->post('input_type');
		$product_course = '';
		if ($product_type == '二手書籍')
			$product_course = $this->input->post('input_course');

		$product_description = $this->input->post('input_description');
		$product_owner = $_SESSION['user'] ;
		$product_image = $_SESSION['product_file_images'];

		$this->load->model('marketmodel') ;
		$this->marketmodel->insert_product_data($product_title , 
			$product_price , $product_description , 
			$product_owner, $product_image, 
			$product_type, $product_course);

		unset($_SESSION['product_file_images']);

		redirect('market') ;
	}


	public function product($type='')
	{
		$list = array('books', 'cloths', 'others', 'all');
		$this->load->model('marketmodel');

		if (isset($type) && in_array($type, $list))
		{
			$data['product_info'] = $this->marketmodel->get_product_data($type);
			$this->load->view('product', $data);
		}
		else
		{
			$data['product_info'] = $this->marketmodel->get_product_data('all');
			$this->load->view('product', $data);
		}
	}

	public function filter($type='' , $filter='')
	{
		$this->load->model('marketmodel') ;
		if ($type == 'name')
			$data['product_info'] = $this->marketmodel->get_product_data_by_name($filter) ;
		else if ($type == 'books')
			$data['product_info'] = $this->marketmodel->get_product_data_by_book($filter) ;
		else
			$data['product_info'] = $this->marketmodel->get_product_data('all') ;

		$this->load->view('product' , $data) ;

	}

	public function mine($type='')
	{
		$list = array('books', 'cloths', 'others', 'all');
		$this->load->model('marketmodel');

		if (isset($type) && in_array($type, $list))
		{
			$data['product_info'] = $this->marketmodel->get_product_data_by_user($type);
			$this->load->view('mine', $data);
		}
		else
		{
			$data['product_info'] = $this->marketmodel->get_product_data_by_user('all');
			$this->load->view('mine', $data);
		}
	}

	public function post()
	{
		unset($_SESSION['product_file_images']) ;
		$this->load->view('post') ;
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function info($id='')
	{
		$this->load->model('marketmodel') ;
		$data['item'] = $this->marketmodel->get_product_info($id) ;

		$url = preg_split('/[;]/', $data['item']->product_image);
		$data['url'] = $url[0];
		$data['urls'] = $url;
		$this->load->view('info' , $data) ;
	}

}

/* End of file market.php */
/* Location: ./application/controllers/market.php */