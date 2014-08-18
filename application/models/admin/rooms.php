<?php
class rooms extends CI_Model{
	public function rooms(){
		if($this->input->post("rooms_sub")){
			$rooms = $this->input->post("room");
			$class1 = $this->input->post("class1");
			$class2 = $this->input->post("class2");
			foreach($rooms as $room_id => $room){
				$edit = FALSE;
				$cbd = FALSE;
				if($room == 0){
					$cbd = TRUE;
				}
				else{
					$edit = TRUE;
					$data['room'] = $room;
				}
				if(isset($class1[$room_id])){ //nqma hora class1
					$edit = TRUE;
					$data['class1'] = $class1[$room_id];
				}
				else{
					$cbd = FALSE;
				}
				if(isset($class2[$room_id])){ //nqma hora class2
					$edit = TRUE;
					$data['class2'] = $class2[$room_id];
				}
				else{
					$cbd = FALSE;
				}
				if($edit == TRUE){
					$this->db->where("id", $room_id);
					if($cbd == TRUE){
						$this->db->delete("rooms");
					}
					else{
						$this->db->update("rooms", $data);
					}
				}
				unset($data);
			}
		}
		else{
			if($this->input->post("new_room_sub")){
				$room = $this->input->post("room");
				$class1 = $this->input->post("class1");
				$class2 = $this->input->post("class2");
				$comp_id = $this->session->userdata("comp_id");
				
				$data = array(
					'room' => $room,
					'class1' => $class1,
					'class2' => $class2,
					'comp_id' => $comp_id
				);
				$this->db->insert("rooms", $data);
			}
		}
	}
}
?>