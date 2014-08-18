<?php
class files extends CI_Model{
	public function files(){
		$config['upload_path'] = './uploads/'.$this->session->userdata("comp_id");
		$config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|rtf|txt';
		
		$this->load->library("upload", $config);
		if(!$this->upload->do_upload("file")){
			$to_view['error'] = "Не сте избрали файл или избраният файл не е от позволените типове! <br> Позволените типове са: <br> <strong>doc|docx|xls|xlsx|pdf|rtf|txt</strong>";
			$this->load->view('admin/file_error', $to_view);
		}
	}
}
?>