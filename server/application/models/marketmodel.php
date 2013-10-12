<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class marketModel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function insert_product_data($product_title , $product_price , $product_description , $product_owner, $product_image, $product_type, $product_course)
	{
		date_default_timezone_set('Asia/Taipei');
		$data = array(
			'product_title' => urldecode($product_title),
			'product_price' => urldecode('$' . $product_price),
			'product_description' => urldecode($product_description),
			'product_owner' => urldecode($product_owner),
			'product_type' => urlencode($product_type),
			'product_image' => urldecode($product_image),
			'product_course' => urlencode($product_course),
			'product_post_time' => date("Y-m-d H:i:s", time())
		);

		$this->db->insert('yzu_market' , $data);
	}

	function get_product_info($id)
	{
		$this->db->where(array('product_id' => $id)) ;
		$result = $this->db->get('yzu_market') ;

		return $result->row() ;
	}

	function get_product_data($type)
	{
		$_type = '';
		switch ($type)
		{
			case 'books':
				$_type = '二手書籍';
				break;
			case 'cloths':
				$_type = '二手服飾';
				break;
			case 'others':
				$_type = '其他';
				break;
			case 'all':
				$_type = 'all';
		}

		if ($_type != 'all')
			$this->db->where(array('product_type' => urlencode($_type)));
		
		$this->db->order_by('product_id' , 'desc');
		$sql_result = $this->db->get('yzu_market');
		return $sql_result->result();
	}

	function get_product_data_by_user($type)
	{
		$_type = '';
		switch ($type)
		{
			case 'books':
				$_type = '二手書籍';
				break;
			case 'cloths':
				$_type = '二手服飾';
				break;
			case 'others':
				$_type = '其他';
				break;
			case 'all':
				$_type = 'all';
		}

		if ($_type != 'all')
			$this->db->where(array('product_type' => urlencode($_type), 'product_owner' => urlencode($_SESSION['user'])));
		
		$this->db->order_by('product_id' , 'desc');
		$sql_result = $this->db->get('yzu_market');

		return $sql_result->result();
	}
	
}