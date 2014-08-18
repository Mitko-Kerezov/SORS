<?php

class info extends CI_Model {
    public function info() {
		if ($this->input->post("info_check")){
			$email_check = $this->input->post("email_check");
			$competit_id = $this->input->post("comp_id");
			$competit_name = $this->input->post("comp_name");
			
			$this->db->select('id')->select('room')->from('competitors')->where('email', $email_check)->where("comp_id", $competit_id);
			$query = $this->db->get();
			$row = $query->row();
			if(isset($row->id)){
				$to_view['id'] = $row->id;
				$to_view['name'] = $competit_name;
				$to_view['room'] = $row->room;
				
				$this->load->view("success_info", $to_view);
			}
			else{ 
				//start
				$this->db->select('id')->from('competitions')->where("id", $competit_id);
				$quer = $this->db->get();
				$r = $quer->row();
				$to_view['id'] = $r->id;
				//--end
				$to_view['email'] = $email_check;
				$to_view['name'] = $competit_name;
				
				$this->load->view("again_info", $to_view);
			}	
		}
	}
}
?>