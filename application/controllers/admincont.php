<?php

//enable if necessary
//-- error_reporting(0);
class admincont extends CI_Controller {

    public function index() {
		$user_id = $this->session->userdata("user_id");
        $user_type = $this->session->userdata("user_type");
		$this->load->view("header");
        $this->load->view("admin/admin_menu", array("user_type" => $user_type));

        //tabs
		
        $logged = $this->session->userdata('logged');
		$comp_id = $this->session->userdata('comp_id');
        if ($logged == "true") {
			$this->load->view('admin/print');
			$this->load->view('admin/paid');
			$this->load->view('admin/edit');
			$this->load->view('admin/table_competitors');
			if($user_type == 'admin'){
				$this->load->view('admin/files');
				$this->load->view('admin/rooms');
				$this->load->view('admin/new_comp');
			}
        }
		else{
			redirect("../");
        }
        //--tabs
        $this->load->view("footer");
    }
	
	public function r_print($id){
		if ($id == 0)
            exit;
		$id = (int)$id;	
		$this->db->select("*")->from("competitors")->where("id", $id);
	        $query = $this->db->get();
		foreach ($query->result() as $row) {
			
			if ($row->paid == 0){
			$this->db->select("*")->from("competitions")->where("id", $row->comp_id);
			$quer = $this->db->get();
			$comp = $quer->row();
			$to_view['fee'] = $comp->fee;
			$to_view['fee_in_words'] = $this->num2bgtext($comp->fee);
			$to_view['competition'] = $comp->name;
			$to_view['fname'] = $row->fname;
			$to_view['mname'] = $row->mname;
			$to_view['lname'] = $row->lname;
			$to_view['date'] = date("d.m.y");
			
			$to_view['class'] = $row->class;
			$to_view['room'] = $row->room;
			
			$this->db->select("*")->from("competitions")->where("id", $row->comp_id);
	        	$query_comp = $this->db->get()->row();
			$to_view['date_comp'] = date("d.m.Y", $query_comp->date);
						
			
				$this->get_room($row->class, $row->comp_id, $to_view['room'], $row->room, $id, $to_view['place']);
			
			$to_view['room'] = $row->room;
			}
			else{
			exit;
			
			}
		}
		$this->load->view('admin/receipt.htm', $to_view);
	}
	
	public function r_print_only($id){
		if ($id == 0)
            exit;
		$id = (int)$id;	
		$this->db->select("*")->from("competitors")->where("id", $id);
	        $query = $this->db->get();
		foreach ($query->result() as $row) {
			$this->db->select("*")->from("competitions")->where("id", $row->comp_id);
			$quer = $this->db->get();
			$comp = $quer->row();
			$to_view['fee'] = $comp->fee;
			$to_view['fee_in_words'] = $this->num2bgtext($comp->fee);
			$to_view['competition'] = $comp->name;
			$to_view['fname'] = $row->fname;
			$to_view['mname'] = $row->mname;
			$to_view['lname'] = $row->lname;
			$to_view['room'] = $row->room;
			$to_view['place'] = $row->place;
			$to_view['date'] = date("d.m.y");
			$to_view['class'] = $row->class;
			$to_view['room'] = $row->room;
			
			$this->db->select("*")->from("competitions")->where("id", $row->comp_id);
	        	$query_comp = $this->db->get()->row();
			$to_view['date_comp'] = date("d.m.Y", $query_comp->date);
			
			
			
		}
		$this->load->view('admin/receipt.htm', $to_view);
	}
	
	public function delete($file){
		$dir = "uploads/".$this->session->userdata("comp_id")."/";
		unlink($dir.$file);
		redirect("../admincont");
	}
	
    public function logout() {
        $this->session->sess_destroy();
        redirect("../");
    }
	public function nPay() {
		if ($this->session->userdata('logged') == 'true') {
			echo '<br/>Моля въведете валидни име и/или номер!';
		}
		else {
            redirect("../");
        }
	}
    public function fPay($id) {
        if ($id == 0)
            exit;
		if ($this->session->userdata('logged') == 'true') {
            $id = (int) $id;
            $this->db->select("*")->from("competitors")->where("id", $id);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
			if ($row->paid != 0)
				echo $row->fname . ' ' . $row->mname . ' ' . $row->lname . ' с номер ' . $id . ' вече е платил/а!';
			else
				{
					$this->db->where("id", $id);
					$this->db->update('competitors', array('paid' => 1));
					echo '<br/>';
					echo $row->fname . ' ' . $row->mname . ' ' . $row->lname . ' с номер ' . $id . ' е отбелязан/а като платил/а!';
				}
            }
        } else {
            redirect("../");
        }
    }

    public function autocomplete() {
        if ($this->session->userdata('logged') == 'true'){
            $return_array = array();
            $query = $this->db->select("fname, mname, lname, id")->from("competitors")->where("comp_id", $this->session->userdata("comp_id"))->where("paid", 0)->like("fname", $this->input->get("term"));
            $row = $this->db->get();
            foreach ($row->result() as $r) {
                $row_array['value'] = $r->fname . " " . $r->mname . " " . $r->lname;
                $row_array['id'] = $r->id;
                array_push($return_array, $row_array);
            }
            echo json_encode($return_array);
        }
    }
	
	public function autocomplete_paid() {
        if ($this->session->userdata('logged') == 'true'){
            $return_array = array();
            $query = $this->db->select("fname, mname, lname, id")->from("competitors")->where("comp_id", $this->session->userdata("comp_id"))->where("paid", 1)->like("fname", $this->input->get("term"));
            $row = $this->db->get();
            foreach ($row->result() as $r) {
                $row_array['value'] = $r->fname . " " . $r->mname . " " . $r->lname;
                $row_array['id'] = $r->id;
                array_push($return_array, $row_array);
            }
            echo json_encode($return_array);
        }
    }
	

    public function num2bgtext($number,$stotinki=false) {
        global $_num0, $_num100;

        $number = (int)$number;

        $_div10 = ($number - $number % 10) / 10;
        $_mod10 = $number % 10;
        $_div100 = ($number - $number % 100) / 100;
        $_mod100 = $number % 100;
        $_div1000 = ($number - $number % 1000) / 1000;
        $_mod1000 = $number % 1000;
        $_div1000000 = ($number - $number % 1000000) / 1000000;
        $_mod1000000 = $number % 1000000;
        $_div1000000000 = ($number - $number % 1000000000) / 1000000000;
        $_mod1000000000 = $number % 1000000000;

        if ($number == 0) {
            return $_num0[$number];
        }
        /* До двайсет */
        if ($number > 0 && $number < 20) {
            if ($stotinki && $number == 1)
                return "една";
            if ($stotinki && $number == 2)
                return "две";
            if ($number == 2)
                return "два";
            return isset($_num0[$number]) ? $_num0[$number] : $_num0[$_mod10]."надесет";
        }
        /* До сто */
        if ($number > 19 && $number < 100) {
            $tmp = ($_div10 == 2) ? "двадесет" : $_num0[$_div10]."десет";
            $tmp = $_mod10 ? $tmp." и ".num2bgtext($_mod10,$stotinki) : $tmp;
            return $tmp;
        }
        /* До хиляда */
        if ($number > 99 && $number < 1000) {
            $tmp = isset($_num100[$_div100]) ? $_num100[$_div100] : $_num0[$_div100]."стотин";
            if (($_mod100 % 10 == 0 || $_mod100 < 20) && $_mod100 != 0) {
                $tmp .= " и";
            }
            if ($_mod100) {
                $tmp .= " ".num2bgtext($_mod100);
            }
            return $tmp;
        }
        /* До милион */
        if ($number > 999 && $number < 1000000) {
            /* Damn bulgarian @#$%@#$% два хиляди is wrong :) */
            $_num0[2] = "две";
            $tmp = ($_div1000 == 1) ? "хиляда" : num2bgtext($_div1000)." хиляди";
            $_num0[2] = "два";
            if (($_mod1000 % 10 == 0 || $_mod1000 < 20) && $_mod1000 != 0) {
                if (!(($_mod100 % 10 == 0 || $_mod100 < 20) && $_mod100 != 0)) {
                    $tmp .= " и";
                }
            }
            if (($_mod1000 % 10 == 0 || $_mod1000 < 20) && $_mod1000 != 0 && $_mod1000 < 100) {
                $tmp .= " и";
            }
            if ($_mod1000) {
                $tmp .= " ".num2bgtext($_mod1000);
            }
            return $tmp;
        }
        /* Над милион */
        if ($number > 999999 && $number < 1000000000) {
            $tmp = ($_div1000000 == 1) ? "един милион" : num2bgtext($_div1000000)." милиона";
            if (($_mod1000000 % 10 == 0 || $_mod1000000 < 20) && $_mod1000000 != 0) {
                if (!(($_mod1000 % 10 == 0 || $_mod1000 < 20) && $_mod1000 != 0)) {
                    if (!(($_mod100 % 10 == 0 || $_mod100 < 20) && $_mod100 != 0)) {
                        $tmp .= " и";
                    }
                }
            }
            $and = ", ";
            if (($_mod1000000 % 10 == 0 || $_mod1000000 < 20) && $_mod1000000 != 0 && $_mod1000000 < 1000) {
                if (($_mod1000 % 10 == 0 || $_mod1000 < 20) && $_mod1000 != 0 && $_mod1000 < 100) {
                    $tmp .= " и";
                }
            }
            if ($_mod1000000) {
                $tmp .= " ".num2bgtext($_mod1000000);
            }
            return $tmp;
        }
        /* Над милиард */
        if ($number > 99999999 && $number <= 2000000000) {
            $tmp = ($_div1000000000 == 1) ? "един милиард" : "";
            $tmp = ($_div1000000000 == 2) ? "два милиарда" : $tmp;
            if ($_mod1000000000) {
                $tmp .= " ".num2bgtext($_mod1000000000);
            }
            return $tmp;
        }
        /* Bye ... */
        return "";
    }

	public function get_room($class, $comp_id, &$to_view, &$room, $id, &$to_view_place){
		$q = $this->db->select("*")->from("rooms")->where("comp_id", $comp_id);
		
		$q = $q->get();
		foreach ($q->result() as $r)
		{
			if ($class == $r->class1){
				if($r->class1_taken <15){
					$room = $r->room;
					$place = $r->class1_taken * 2 + 1;  // only odd numbers starting from 1
					
					$sql_competitor = array(
						'room' => $r->room,
						'place' => $place
						);
					$this->db->where('id', $id);
					$this->db->update('competitors', $sql_competitor);
					
					
					$new_class = $r->class1_taken + 1;
					$sql = array(
						'class1_taken' => $new_class
						);
					$this->db->where('class1', $class);
					$this->db->where('comp_id', $comp_id);
					$this->db->where('room', $room);
					$this->db->update('rooms', $sql);
					
					$to_view = $r->room;
					$to_view_place = $place;
					
					break;
				}	
			}
			elseif ($class == $r->class2){
				if($r->class2_taken <15){
					$room = $r->room;
					$place = $r->class2_taken * 2 + 2;  // only even numbers starting from 2
					
					$sql_competitor = array(
						'room' => $r->room,
						'place' => $place
						);
					$this->db->where('id', $id);
					$this->db->update('competitors', $sql_competitor);
					
					$new_class = $r->class2_taken + 1;
					$sql = array(
						'class2_taken' => $new_class
						);
					$this->db->where('class2', $class);
					$this->db->where("comp_id", $comp_id);
					$this->db->where('room', $room);
					$this->db->update('rooms', $sql);
					
					
					$to_view = $r->room;
					$to_view_place = $place;
					

					break;
				}	
			}
			 
			
		}
	}
}

$_num0   = array(0 => "нула",1 => "един",2 => "две",3 => "три",4 => "четири",
                     5 => "пет",6 => "шест",7 => "седем",8 => "осем",9 => "девет",
                     10 => "десет", 11 => "единадесет", 12 => "дванадесет");
$_num100 = array(1 => "сто", 2 => "двеста", 3 => "триста");
?>