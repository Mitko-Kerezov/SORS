<?php

class st_reg extends CI_Model {
    public function st_reg() {
        
		
		//rules
        //rules are in form_validation.php
        //messages
        
        //--messages
        //charset function is in the controller
        //--
        //--rules
		if($this->input->post("submit")){
			$fname = $this->input->post("fname");
        $mname = $this->input->post("mname");
        $lname = $this->input->post("lname");
        $tel = $this->input->post("tel");
        $email = $this->input->post("email");
        $class = $this->input->post("class");
        $city = $this->input->post("city");
        $school = $this->input->post("school");
        $teacher = $this->input->post("teacher");
        $project = $this->input->post("project");
        $category = $this->input->post("category");
        $coop = $this->input->post("coop");
			if ($coop == "yes") {
                $coop = 1;
            } else {
                $coop = 0;
            }
		$room = 0;
		
		$comp = $this->input->post("st_reg_comp");
			$this->db->select("id, deadline, type")->from("competitions")->where("name", $comp);
			$q = $this->db->get();
			$r = $q->row();
		$comp_id = $r->id;
		$comp_dead = $r->deadline;
		$comp_type = $r->type;
			if($comp_type==1)
			{
				$teacher = "няма";
				$project = "няма";
				$category = "няма";
				$coop = 2;
				
			}
			if ( ($comp_type==0 && $this->form_validation->run('signup') == TRUE) || ($comp_type==1 && $this->form_validation->run('signup_regular') == TRUE) ) {
			   if ($comp_dead > time()) {
				
				$to_view['room'] = 'стая';
				
				
				$this->register($comp_id, $fname, $mname, $lname, $tel, $email, $class, $city, $school, $teacher, $project, $category, $coop);
				$this->db->select('id')->from('competitors')->where('email', $email)->where("comp_id", $comp_id);
				$query = $this->db->get();
				$row = $query->row();
				$to_view['id'] = $row->id;
				$to_view['name'] = $comp;
				$this->session->sess_destroy();
				$this->load->view("success", $to_view);
			   }
			   else{
				$to_view['dead'] = "Крайният срок е минал!";
				$this->load->view("again", $to_view);
				 }
			  }
			  else{
				$school = htmlspecialchars($school);
				$this->session->set_userdata("re_fname", $fname);
				$this->session->set_userdata("re_mname", $mname);
				$this->session->set_userdata("re_lname", $lname);
				$this->session->set_userdata("re_tel", $tel);
				$this->session->set_userdata("re_email", $email);
				$this->session->set_userdata("re_class", $class);
				$this->session->set_userdata("re_city", $city);
				$this->session->set_userdata("re_school", $school);
				$this->session->set_userdata("re_teacher", $teacher);
				$this->session->set_userdata("re_project", $project);
				$this->session->set_userdata("re_category", $category);
				$this->session->set_userdata("re_coop", $coop);
			  
				$this->load->view("again");   
			  }
		}
		else{
			//$this->load->view("st_reg");
			}
	}
    private function register($comp_id, $fname, $mname, $lname, $tel, $email, $class, $city, $school, $teacher, $project, $category, $coop, $room=0, $place = 0) {
        $in_array = array(
			'comp_id' => $comp_id,
            'fname' => $fname,
            'mname' => $mname,
            'lname' => $lname,
            'phone' => $tel,
            'email' => $email,
            'class' => $class,
            'city' => $city,
            'school' => $school,
            'teacher' => $teacher,
            'project' => $project,
            'category' => $category,
            'coop' => $coop,
			'room' => $room,
			'place' => $place
        );
        $this->db->insert("competitors", $in_array);
    }
	private function deadline($deadline){
		if($deadline>time()){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	
}

?>