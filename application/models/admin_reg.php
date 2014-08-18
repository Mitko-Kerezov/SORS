<?php

class admin_reg extends CI_Model {

    public function admin_reg(){
		if($this->input->post("admin_submit")){
           $uname = $this->input->post("uname");
           $pass = md5($this->input->post("pass"));
		   $comp = $this->input->post("competition");
        //rules
        //rules are in form_validation.php
        //--rules
			$comp_id = $this->such_comp($comp);
		
			if ($this->form_validation->run('admin') == TRUE && $this->such_admin($uname, $pass) == TRUE && isset($comp_id)) {
				$this->session->set_userdata("logged", "true");
				$this->session->set_userdata("comp_id", $comp_id);
				$this->db->select("*")->from("administrators")->where("username", $uname)->where('password', $pass);
				$query = $this->db->get();
				$admin = $query->row();
				$this->session->set_userdata("user_id", $admin->id);
				$this->session->set_userdata("user_type", $admin->type);
				if($admin->type == 'ex'){
					redirect('../excont/');
				}
				else if ($admin->type == 'admin' || $admin->type == 'dom'){
					redirect('../admincont/');
				}
			}
			else{
				if($this->input->post("admin_submit") && $this->such_admin($uname, $pass) == FALSE){
					$this->load->view("admin_errors");
				}
				$this->load->view("admin");
			}
		}
		else{
			$this->load->view("admin");
		}
    }
    private function such_admin($name, $pass){
        $query = $this->db->select("id")->from("administrators")->where("username", $name)->where("password", $pass);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
	private function such_comp($comp){
		$this->db->select("id")->from("competitions")->where("name", $comp);
		$q = $this->db->get();
		$r = $q->row();
		return $r->id;
	}
}

?>
