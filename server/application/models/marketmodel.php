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
			'product_title' => $product_title,
			'product_price' => '$' . $product_price,
			'product_description' => $product_description,
			'product_owner' => $product_owner,
			'product_type' => $product_type,
			'product_image' => $product_image,
			'product_course' => $product_course,
			'product_post_time' => date("Y-m-d H:i:s", time())
		);

		$this->db->insert('yzu_market' , $data);
	}

	function update_product_data($product_id, $data)
	{
		$this->db->where(array('product_id' => $product_id));
		$this->db->update('yzu_market', $data);
	}

	function delete_product_data($product_id)
	{
		$this->db->delete('yzu_market', array('product_id' => $product_id));
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
				$_type = '其他類型';
				break;
			case 'all':
				$_type = 'all';
		}

		if ($_type != 'all')
			$this->db->where(array('product_type' => $_type));
		
		$this->db->order_by('product_id' , 'desc');
		$sql_result = $this->db->get('yzu_market');
		return $sql_result->result();
	}

	function get_product_data_by_name($name)
	{
		$this->db->like('product_title' , $name) ;
		$sql_result = $this->db->get('yzu_market') ;

		return $sql_result->result() ;
	}

	function get_product_data_by_book($name)
	{
		$this->db->where(array('product_course' => $name)) ;
		$sql_result = $this->db->get('yzu_market') ;

		return $sql_result->result() ;
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
				$_type = '其他類型';
				break;
			case 'all':
				$_type = 'all';
		}

		if ($_type != 'all')
			$this->db->where(array('product_type' => $_type, 'product_owner' =>  $_SESSION['user']));
		else
			$this->db->where('product_owner' , $_SESSION['user']) ;
		
		$this->db->order_by('product_id' , 'desc');
		$sql_result = $this->db->get('yzu_market');

		return $sql_result->result();
	}	
}