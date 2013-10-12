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
		if (isset($_SESSION['product_file_images']) && $_SESSION['product_file_images'] != '')
			$product_image = $_SESSION['product_file_images'];
		else
			$product_image = base_url(). 'upload/default_maker.png';

		$this->load->model('marketmodel') ;
		$this->marketmodel->insert_product_data($product_title , 
			$product_price , $product_description , 
			$product_owner, $product_image, 
			$product_type, $product_course);

		unset($_SESSION['product_file_images']);

		redirect('market') ;
	}

	public function update_product_data($product_id)
	{
		$this->load->model('marketmodel');
		$new_data = $this->marketmodel->get_product_info($product_id);
		$new_data->product_status = 0;
		$this->marketmodel->update_product_data($product_id, $new_data);
	}

	public function delete_product_data($product_id)
	{
		$this->load->model('marketmodel');
		$this->marketmodel->delete_product_data($product_id);
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
			$data['product_info'] = $this->marketmodel->get_product_data_by_name(urldecode($filter));
		else if ($type == 'books')
			$data['product_info'] = $this->marketmodel->get_product_data_by_book(urldecode($filter));
		else
			$data['product_info'] = $this->marketmodel->get_product_data('all');

		$this->load->view('product' , $data);

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

	public function get_class_name()
	{
		$this->load->model('classmodel');
		$query = $this->input->get('query') ;
		$sql_result = $this->classmodel->get_class_name(urldecode($query));
		$result = array();
		foreach ($sql_result as $entry)
			array_push($result, $entry->className);

		$data = array('suggestions' => $result) ;
		
		echo json_encode($data);
	}
}

/* End of file market.php */
/* Location: ./application/controllers/market.php */