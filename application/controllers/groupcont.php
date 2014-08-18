<?php
class groupcont extends CI_Controller{
	public function index(){
		$city = $this->session->userdata("city");
		$school = $this->session->userdata("school");
		$next = $this->session->userdata("next");
		
		$comp_id = $this->session->userdata("comp_id");
		$comp_name = $this->session->userdata("comp_name");
		$comp_type = $this->session->userdata("comp_type");
		
		$this->load->view("header");
		$this->load->view("group/menu");
		if(empty($comp_id)){
			$this->load->view("group/comp_selector");
		}
		else{
			if(empty($city) OR empty($school)){
				$this->load->view("group/mass_data", array("cmp" => $comp_name, "errors" => $this->session->userdata("validation_errors")));
			}
			else{
				if($next == "true"){
					$this->load->view("group/single", array("c" => $city, "s" => $school, "cmp" => $comp_name, "type" => $comp_type, "errors" => $this->session->userdata("validation_errors")));
				}
				else{
					$n = (int)$this->session->userdata("n");
					for($i=0; $i<$n; $i++){
						$arr[] = $this->session->userdata("c".$i);
						$this->session->unset_userdata("c".$i);
					}
					$this->session->set_userdata("data_array", $arr);
					$this->load->view("group/dialog", array("n" => $arr, "c" => $city, "s" => $school, "cmp" => $comp_name, "type" => $comp_type));
				}
			}
		}
	}
	public function mass_data(){
		$this->set_messages();
		if($this->form_validation->run('single_mass') == TRUE){
			$this->session->set_userdata("city", $this->input->post("group_city"));
			$this->session->set_userdata("school", $this->input->post("group_school"));
			$this->session->set_userdata("next", "true");
			$this->session->set_userdata("n", "0");
			$this->session->set_userdata("validation_errors", "");
		}
		else{
			$this->session->set_userdata("validation_errors", validation_errors());
		}
		redirect("../groupcont");
	}
	
	public function single_data(){
		$this->set_messages();
		$this->session->set_userdata("next", "false");
		$n = (int)$this->session->userdata("n");
		$comp_type = $this->session->userdata("comp_type");
		$single = $this->input->post("single");
		if(($comp_type==0 && $this->form_validation->run('single') == TRUE) || ($comp_type==1 && $this->form_validation->run('single_regular') == TRUE)){
			$this->session->set_userdata(array("c".$n => $single));
			$n+=1;
			$this->session->set_userdata("n", $n);
			$this->session->set_userdata("validation_errors", "");
		}
		else{
			$this->session->set_userdata("validation_errors", validation_errors());
		}
		if($this->input->post("next")){
			$this->session->set_userdata("next", "true");
		}
		redirect("../groupcont");
	}
	
	public function clear_data(){
		$this->session->sess_destroy();
		redirect("../groupcont");
	}
	
	public function process_data(){
		$data = $this->session->userdata("data_array");
		if(empty($data)) redirect("../");
		else{
			foreach($data as $key => $value){
				foreach($value as $field => $var){
					if($field == "coop"){
						if($this->session->userdata("comp_type") == 1){
							$var = 2;
						}
					}
					$to_db[$field] = $var;
				}
				$to_db["city"] = $this->session->userdata("city");
				$to_db["school"] = $this->session->userdata("school");
				$to_db["comp_id"] = $this->session->userdata("comp_id");
				if($this->session->userdata("comp_type") == 1){
					$to_db["teacher"] = "няма";
					$to_db["project"] = "няма";
					$to_db["category"] = "няма";
				}
				$this->db->insert("competitors", $to_db);
			}
		}
		$this->clear_data();
	}
	
	public function comp_select($id){
		$id = (int)$id;
		$query = $this->db->select("*")->from("competitions")->where("id", $id);
		$q = $query->get();
		$q = $q->row();
		if($q->deadline > time()){
			$this->session->set_userdata("comp_id", $id);
			$this->session->set_userdata("comp_name", $q->name);
			$this->session->set_userdata("comp_type", $q->type);
		}
		redirect("../groupcont");
	}
	
//base form validation functions
	
	function is_cyrillic($str) {
        $arr = array(
            'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о',
            'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О',
            'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ь', 'Ю', 'Я',
            '?', ' ', '.', '-', "'", '"');
        $to_check = $this->split_utf8($str);
        $result = true;
        foreach ($to_check as $letter) {
            if (!in_array($letter, $arr)) {
                $result = false;
            }
        }
        unset($arr);
        return $result;
    }

    function category_check($str) {
        if ($str == "Уеб сайт" OR $str == "Интернет приложения" OR $str == "Мултимедийни приложения" OR $str == "Приложни програми" OR $str == "Мултимедия" OR $str == "няма") {
            return TRUE;
        } else {
            echo $str;
            return FALSE;
        }
    }

    function unique_email($str) {
	    $comp_id = $this->session->userdata("comp_id");
        $this->db->select("id")->from("competitors")->where("email", $str)->where("comp_id", $comp_id);
        $q = $this->db->get();
		if ($q->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function split_utf8($str) {
        $split = 1;
        $array = array();
        for ($i = 0; $i < strlen($str);) {
            $value = ord($str[$i]);
            if ($value > 127) {
                if ($value >= 192 && $value <= 223)
                    $split = 2;
                elseif ($value >= 224 && $value <= 239)
                    $split = 3;
                elseif ($value >= 240 && $value <= 247)
                    $split = 4;
            }else {
                $split = 1;
            }
            $key = NULL;
            for ($j = 0; $j < $split; $j++, $i++) {
                $key .= $str[$i];
            }
            array_push($array, $key);
        }
        return $array;
    }
	
	function set_messages(){
		
        $this->form_validation->set_message('greater_than', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('less_than', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('integer', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('required', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> е задължително!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('category_check', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Моля изберете правилна категория!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('max_length', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> има прекалено много символи!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('numeric', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да съдържа само цифри!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('valid_email', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да е валиден e-mail!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('unique_email', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Този <em><strong>%s</strong></em> вече е използван!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
        $this->form_validation->set_message('is_cyrillic', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да е на кирилица!<span class="ui-icon ui-icon-alert" style="float: right; margin-right: .5em; margin-top: .3em;"></span>');
		
	}
}
?>