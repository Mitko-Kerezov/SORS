<?php
class marks extends CI_Model{
	public function marks(){
		if($this->session->userdata("ex_class")){
			$ex_class = $this->session->userdata("ex_class");
		}
		if(!isset($ex_class)){
			$this->load->view("ex/marks-1");
		}
		else{
			$this->load->view("ex/marks-2", array("ex_class" => $this->session->userdata("ex_class")));
		}
		
	}
}
?>