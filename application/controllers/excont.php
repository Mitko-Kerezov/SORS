<?php
class excont extends CI_Controller{
	public function index(){
		$user_id = $this->session->userdata("user_id");
		$comp_id = $this->session->userdata("comp_id");
		
		if($this->session->userdata("logged") != "true") redirect("../");
		else{
			$this->load->view("header");
			$this->load->view("ex/menu");
			
			$this->load->view("admin/edit");
			$this->load->model("marks");
		}
		$this->load->view("footer");
	}
	public function class_selector(){
		if($this->input->post("ex_class_post")){
			$this->session->set_userdata("ex_class", $this->input->post("ex_class"));
		}
		redirect("../excont");
	}
	
	public function autocomplete($class){
		$return_array = array();
        $query = $this->db->select("fname, mname, lname, id")->from("competitors")->where("comp_id", $this->session->userdata("comp_id"))->where("class", $class)->like("fname", $this->input->get("term"));
        $row = $this->db->get();
        foreach ($row->result() as $r) {
            $row_array['value'] = $r->fname . " " . $r->mname . " " . $r->lname;
            $row_array['id'] = $r->id;
            array_push($return_array, $row_array);
        }
        echo json_encode($return_array);
	}
	
	public function marks($id, $marks){
		if($this->session->userdata("logged") == "true"){
			$this->db->select("fname, mname, lname")->from("competitors")->where("id", $id);
			$query = $this->db->get();
			$user = $query->row();
			$this->db->where("id", $id)->update("competitors", array("marks" => $marks));
			
			$names = $user->fname." ".$user->mname." ".$user->lname;
			echo "На ".$names." бяха присъдени ".$marks." точки!";
		}
	}
}
?>