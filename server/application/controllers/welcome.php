<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{	
		$user = $this->input->post('user') ;
		$_SESSION['user'] = $user ;
		echo $_SESSION['user'] ;
	}

	public function test()
	{
		echo $_SESSION['user'] ;
	}

	public function getAllClass()
	{
		$this->load->model('classmodel') ;
		$classInfo = $this->classmodel->getAllClass() ;

		echo json_encode($classInfo) ;
	}

	public function getClassInfo($classTime , $page)
	{
		$this->load->model('classmodel') ;
		$classInfo = $this->classmodel->getClassInfo($classTime , $page) ;

		echo json_encode($classInfo) ;
	}

	public function getClassComment($className , $teacher , $page)
	{
		$this->load->model('classmodel') ;
		$classComment = $this->classmodel->getClassComment($className , $teacher , $page) ;

		for($i = 0 ; $i < count($classComment) ; $i++)
			$classComment[$i]->commenter = substr($classComment[$i]->commenter , 0 , strlen($classComment[$i]->commenter) - 2) . '**' ;

		echo json_encode($classComment) ;
	}

	public function insertClassComment()
	{
		$className = $this->input->post('className') ;
		$teacher = $this->input->post('teacher') ;
		$comment = htmlspecialchars($this->input->post('comment')) ;
		$commenter = $_SESSION['user'] ;
		$this->load->model('classmodel') ;
		$this->classmodel->insertClassComment($className , $teacher , $comment , $commenter) ;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */