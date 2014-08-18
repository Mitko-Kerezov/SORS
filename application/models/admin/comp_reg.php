<?php
class comp_reg extends CI_Model{
    public function comp_reg(){
        $name = $this->input->post("name");
        $place = $this->input->post("place");
        $date = $this->input->post("date");
        $deadline = $this->input->post("deadline");
        $info = $this->input->post("info");
        $type = $this->session->userdata("type");
		$rooms = $this->input->post("rooms");
		$rooms_arr = explode(",", $rooms);
		$class_range = $this->input->post('class_range');
		
		if ($class_range == "low")
			$class_range = 0;
		else if ($class_range == "high")
			$class_range = 1;
		
		if($this->input->post("fee"))
			$fee = $this->input->post("fee");
		else
			$fee = 0;
		
		if(!$date || !$deadline){
			$to_view['error'] = "Моля попълнете полетата за дата и краен срок за регистрация!";
            $this->load->view("admin/again", $to_view);
		}
		else{
			if($this->form_validation->run("new_comp") == true && $this->input->post("comp_sub")){
				$date_arr = explode(".", $date);
				$date = strtotime($date_arr[1]."/".$date_arr[0]."/".$date_arr[2]) + 7200;
				$date_arr = explode(".", $deadline);
				$deadline = strtotime($date_arr[1]."/".$date_arr[0]."/".$date_arr[2]) + 7200;
				
					
					
				
				if(count($rooms_arr) < 4){
					$to_view['error'] = "Броя на кабинетите трябва да е поне 4!";
					$this->load->view("admin/again", $to_view);
				}
				else{
					if($deadline <= $date){
						$to_view['name'] = $name;
						$to_view['type'] = $type;
						$this->new_comp($name, $place, $date, $deadline, $info, $type, $fee, $class_range);
						if ($class_range == 0)
							$this->insert_rooms_in_db2($rooms_arr, $name);
						else if ($class_range == 1)
							$this->insert_rooms_in_db($rooms_arr, $name);
						$this->load->view("admin/success", $to_view);
					}
					else{
						$to_view['error'] = "Крайният срок за регистрация е след датата на провеждане на състезанието!";
						$this->load->view("admin/again", $to_view);
					}
				}
			}
		}
    }
    private function new_comp($name, $place, $date, $deadline, $info, $type, $fee, $class_range){
        $in_arr = array(
            'name' => $name,
            'place' => $place,
            'date' => $date,
            'deadline' => $deadline,
            'info' => $info,
			'type' => $type,
			'administrator' => $this->session->userdata("user_id"),
			'fee' => $fee,
			'class_range' => $class_range
        );
        $this->db->insert('competitions', $in_arr);
    }
	
	public function insert_rooms_in_db($arr, $name){
		$max_elements = count($arr);
		$offset = round($max_elements/4);
		$klas_5_7 = array_slice($arr, 0, $offset);
		$klas_6_8 = array_slice($arr, $offset, $offset);
		
		if ($max_elements == 6)  //if the rooms' number is 6 then array 4 ($klas_10_12) remains empty,
		{						 //so I manually put 2 rooms in the first 2 arrays and one room in array 3($klas_9_11) and 4($klas_10_12)
			$klas_9_11[0] = $arr[$max_elements-2];
			$klas_10_12[0] = $arr[$max_elements-1];
		}
		else 
		{
			$klas_9_11 = array_slice($arr, $offset+$offset, $offset);
			$klas_10_12 = array_slice($arr, $offset+$offset+$offset, $max_elements);
		}
		//Here we have the array split into 4 sections - one for each pair of classes, taking the olympiad together
		
		$this->db->select("id")->from("competitions")->where("name", $name);
		$q = $this->db->get();
		$r = $q->row();
		
		foreach ($klas_5_7 as $room)
		{
			$arr_in_5_7 = array(
			'comp_id' => $r->id,
			'class1' => 5,
			'class2' => 7,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_5_7);
		}
		
		foreach ($klas_6_8 as $room)
		{
			$arr_in_6_8 = array(
			'comp_id' => $r->id,
			'class1' => 6,
			'class2' => 8,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_6_8);
		}
		foreach ($klas_9_11 as $room)
		{
			$arr_in_9_11 = array(
			'comp_id' => $r->id,
			'class1' => 9,
			'class2' => 11,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_9_11);
		}
		foreach ($klas_10_12 as $room)
		{
			$arr_in_10_12 = array(
			'comp_id' => $r->id,
			'class1' => 10,
			'class2' => 12,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
		$this->db->insert('rooms', $arr_in_10_12);
		}
		
	}
	
	public function insert_rooms_in_db2($arr, $name)
	{
		$max_elements = count($arr);
		$offset = round($max_elements/3);
		$klas_4_7 = array_slice($arr, 0, $offset);
		$klas_2_5 = array_slice($arr, $offset, $offset);
		$klas_3_6 = array_slice($arr, $offset + $offset, $max_elements);
		
		//Here we have the array split into 3 sections - one for each pair of classes, taking the olympiad together
		
		$this->db->select("id")->from("competitions")->where("name", $name);
		$q = $this->db->get();
		$r = $q->row();
		
		foreach ($klas_4_7 as $room)
		{
			$arr_in_4_7 = array(
			'comp_id' => $r->id,
			'class1' => 4,
			'class2' => 7,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_4_7);
		}
		foreach ($klas_2_5 as $room)
		{
			$arr_in_2_5 = array(
			'comp_id' => $r->id,
			'class1' => 2,
			'class2' => 5,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_2_5);
		}
		foreach ($klas_3_6 as $room)
		{
			$arr_in_3_6 = array(
			'comp_id' => $r->id,
			'class1' => 3,
			'class2' => 6,
			'class1_taken' => 0,
			'class2_taken' => 0,
			'room' => $room
			);
			$this->db->insert('rooms', $arr_in_3_6);
		}
	}
}
?>
