<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class classModel extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getClassInfo($classTime , $page)
	{
		$this->db->like('classTime' , $classTime) ;
		$this->db->order_by('id' , 'asc') ;
		$query = $this->db->get('class_info' , 15 , ($page - 1) * 10) ;

		return $query->result() ;
	}

	function getClassComment($className , $teacher , $page)
	{
		$this->db->where(array('className' => urldecode($className) , 'teacher' => urldecode($teacher))) ;
		$this->db->order_by('id' , 'desc') ;
		$query = $this->db->get('class_comment' , 15 , ($page - 1) * 10) ;

		return $query->result() ;
	}

	function insertClassComment($className , $teacher , $comment , $commenter)
	{
		$data = array(
			'className' => urldecode($className) ,
			'teacher' => urldecode($teacher) ,
			'comment' => urldecode($comment) ,
			'commenter' => urldecode($commenter) 
		) ;
		$this->db->insert('class_comment' , $data) ;
	}


	function get_class_name($query)
	{
		$this->db->select('className');
		$this->db->like('className' , $query);
		$sql_result = $this->db->get('class_info');

		return $sql_result->result();
	}

	function check_class_name($class_name)
	{
		$this->db->where(array('className' => $class_name));
		$sql_result = $this->db->get('class_info');

		return $sql_result->row();
	}
}