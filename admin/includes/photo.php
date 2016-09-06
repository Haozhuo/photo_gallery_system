<?php

class Photo extends Db_object{
	protected static $db_table = "photos";
	protected static $db_table_fields = array('photo_title','photo_description','photo_filename','photo_file_type','photo_size','photo_alternate_text');
	public $id;
	public $photo_title;
	public $photo_description;
	public $photo_filename;
	public $photo_file_type;
	public $photo_size;
	public $photo_alternate_text;

	public $tmp_path;
	public $upload_directory = "images";

	public $custom_errors_array = array();

	public $upload_errors_array = array(
		UPLOAD_ERR_OK=>"There is no error, the file uploaded with success" ,
		UPLOAD_ERR_INI_SIZE=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
		UPLOAD_ERR_FORM_SIZE=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the 					   HTML form",
		UPLOAD_ERR_PARTIAL=>"The uploaded file was only partially uploaded",
		UPLOAD_ERR_NO_FILE=>"No file was uploaded",
		UPLOAD_ERR_NO_TMP_DIR=>"Missing a temporary folder",
		UPLOAD_ERR_CANT_WRITE=>"Failed to write file to disk",
		UPLOAD_ERR_EXTENSION=>"A PHP extension stopped the file upload"
	);

	//set properties in photo
	//$file will be $_FILES['upload_file_name']
	public function set_file($file){
		if(empty($file) || !$file || !is_array($file)){
			$this->custom_errors_array[] = "This is no uploaded files there";
			return false;
		} else{

			$this->photo_filename = $file['name'];
			$this->tmp_path = $file['tmp_name'];
			$this->photo_type = $file['type'];
			$this->photo_size = $file['size'];

			return true;

		}
	}

	public function save(){
		//if file exist
		if($this->id){
			$this->update();
			return true;
		} else{
			//if there is error
			if(!empty($custom_errors_array))
				return false;
			//if any variable is empty
			if(empty($this->photo_filename) || empty($this->tmp_path)){
				$this->custom_errors_array[] = "The file is not available";
				return false;
			}
			//the whole path to the destination
			$target_path = INCLUDES_PATH . "/" . $this->upload_directory . "/" . $this->photo_filename;

			if(file_exists($target_path)){
				$this->custom_errors_array[] = "The file alreay existed.";
				return false;
			}
			//upload the file
			if(move_uploaded_file($this->tmp_path, "./images/".$this->photo_filename)){
				if($this->create()){
					unset($this->tmp_path);
					return true;
				}
			} else{
				$this->custom_errors_array[] = "The file folder does not have permission";
				return false;
			}

			
		}
	}

	public function delete_photo(){
		if($this->delete()){
			return unlink("./images/".$this->photo_filename) ? true:false;
		}else{
			return false;
		}

	}

};



?>