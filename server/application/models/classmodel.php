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

	function getAllClass()
	{
		$query = $this->db->get('class_info') ;
		return $query->result() ;
	}
	
}