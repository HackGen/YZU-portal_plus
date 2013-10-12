<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function do_upload()
	{
		date_default_timezone_set('Asia/Taipei') ;
		 
		 $config['upload_path'] = './upload/' ;
		 $config['allowed_types'] = 'gif|jpg|png|jpeg' ;
		 
		 foreach($_FILES as $key => $value)
         {
         	$config['file_name'] = date('YmdHis', time()) ;
		 	$this->load->library('upload', $config) ;
			$type = preg_split('/[.]/', $value['name']);
			$type = '.' . $type[count($type) - 1];

			if (!$this->upload->do_upload($key))
			{
			    $error = array('error' => $this->upload->display_errors());
			    print_r($error);
			}
			else
			{
				$filename = $config['file_name'];
				$config['image_library'] = 'gd2';
				$config['source_image']	= '/var/www/yzu/upload/'.$filename.$type;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 70;
				$config['height'] = 70;

				$this->load->library('image_lib', $config);
				if (!$this->image_lib->resize())
				{
				    echo $this->image_lib->display_errors();
				}

				$config['width'] = 320;
				$config['height'] = 240;
				$config['thumb_marker'] = '_maker';

				$this->image_lib->initialize($config); 
				if (!$this->image_lib->resize())
				{
					//echo 'OK';
				    echo $this->image_lib->display_errors();
				}

			    $json = array('deleteType' => 'DELETE' , 
			    			   'deleteUrl' => base_url(). 'index.php/upload/deleteImage/'.$filename.$type , 
			    			   'name' => $filename , 
			     			   'size' => '' , 
			     			   'thumbnailUrl' => base_url().'upload/'.$filename.'_thumb'.$type , 
			     			   'type' => '' , 
			     			   'url' => base_url().'upload/'.$filename.$type) ;

			    $null_byte = array('0' => $json) ;
				$result = json_encode(array('files' =>  $null_byte)) ;
				echo $result ;
			 }

			 if (!isset($_SESSION['product_file_images']))
			 {
			 	$_SESSION['product_file_images'] = base_url(). 'upload/'. $config['file_name'].'_maker'.$type;
			 	//echo "file_name: " . $_SESSION['product_file_images'];
			 }
			 else
			 {
			 	$_SESSION['product_file_images'] .= ';' .base_url(). 'upload/'. $config['file_name'].'_maker'.$type;;
			 	//echo "file_names: " . $_SESSION['product_file_images'];
			 }
		 }
	}

	public function des()
	{
		unset($_SESSION['product_file_images']) ;
	}

	public function deleteImage($file)
	{
		$upload_path_url = dirname($_SERVER["SCRIPT_FILENAME"])."/upload/";
		$success = unlink($upload_path_url . $file);
		$data = preg_split('/[.]/', $file);
		$type = '.' . $data[count($data) - 1];
		$thumb_path = str_replace($type, '_thumb'.$type, $upload_path_url.$file);
		echo $thumb_path;
		unlink($thumb_path);
		$maker_path = str_replace('_thumb', '_maker', $thumb_path);
		unlink($maker_path);

		$info->sucess = $success;
		$info->path = $upload_path_url.$file;
		$info->file = is_file($upload_path_url .$file);
		
		if (IS_AJAX)
		{
			echo json_encode(array($info));
		} else
		{
			$file_data['result'] = $file;
			$this->load->view('upload', $file_data); 
		}
	}

}
?>