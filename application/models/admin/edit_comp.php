<?php
	class edit_comp extends CI_Model{
		public function edit_comp(){
			$id = $this->session->userdata("comp_id");
			$name = $this->input->post("name");
			$place = $this->input->post("place");
			$date = $this->input->post("date");
			$deadline = $this->input->post("deadline");
			$info = $this->input->post("info");
			$fee = $this->input->post("fee");
			
			if($this->form_validation->run("new_comp") == true && $this->input->post("comp_edit")){
				$date_arr = explode(".", $date);
				$date = strtotime($date_arr[1]."/".$date_arr[0]."/".$date_arr[2]) + 7200;
				$date_arr = explode(".", $deadline);
				$deadline = strtotime($date_arr[1]."/".$date_arr[0]."/".$date_arr[2]) + 7200;
				if($deadline <= $date){
					$to_view['name'] = $name;
					$this->update_comp($id, $name, $place, $date, $deadline, $info, $fee);
					$this->load->view("admin/success_edit", $to_view);
				}
				else{
					$to_view['error'] = "Крайният срок за регистрация е след датата на провеждане на състезанието!";
					$this->load->view("admin/again_edit", $to_view);
				}
			}
		}
		private function update_comp($id, $name, $place, $date, $deadline, $info, $fee){
			$this->db->where("id", $id);
			$arr = array(
				'name' => $name,
				'place' => $place,
				'date' => $date,
				'deadline' => $deadline,
				'info' => $info,
				'fee' => $fee
			);
			$this->db->update('competitions',$arr);
		}
	}
?>