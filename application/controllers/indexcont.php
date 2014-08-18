<?php

//enable if necessary
//-- error_reporting(0);
class indexcont extends CI_Controller {
	
	public function get_info($id) {
		$id = (int)$id;
		if($id == 0){
			echo '<meta http-equiv="refresh" content="0"';
		}
        $query = $this->db->select("*")->from("competitions")->where("id", $id);
        $q = $query->get();
        $r = $q->row();
        if ($r->deadline < time())
            $d = ' style="color: red;"'; else
            $d = "";
        if ($r->date < time())
            $d1 = ' style="color: darkred;"'; else
            $d1 = "";
		
		//TODO: make VIEW out of this
		//$this->session->set_userdata("comp_name", $r->name);
        echo '<table style="margin: 0 auto; width: 80%">
				<tr><td style="width: 70%">
				<table>
				<tr>
					<td><strong>Име на състезанието:</strong></td>
					<td>' . $r->name . '</td>
				</tr>
				<tr>
					<td><strong>Дата на провеждане:</strong></td>
					<td' . $d1 . '>' . date("d.m.Y", $r->date) . '</td>
				</tr>
				<tr>
					<td><strong>Срок за регистрация:</strong></td>
					<td' . $d . '>' . date("d.m.Y", $r->deadline) . '</td>
				</tr>
				<tr>
					<td><strong>Място на провеждане:</strong></td>
					<td>' . $r->place . '</td>
					
				</tr>
				</table>
				</td>
				<td>
		';
		echo '<strong>Файлове:</strong><br/><div class="more_files">';
		$dir = "uploads/".$id;
		if(is_dir($dir)){
			foreach(scandir($dir) as $file){
				if($file != "." && $file !=".."){
					echo '<a href="'.$dir.'/'.$file.'" class="fg-button ui-state-default ui-corner-all" style="text-decoration: none;" >'.$file.'</a></br>';
				}
			}
			echo '</div>';
		}
		else{
			echo "<strong>Няма прикачени файлове!</strong>";
		}
		echo '</td></tr></table>';
		if($r->info){
			echo '<strong>Допълнителна информация:</strong><br/>
					<div class="more_info ui-corner-all ui-widget-content">' . $r->info . '</div>';
		}
    }
	
    public function index() {
		$this->load->view("header");
        $this->load->view("menu");
//tabs
		$this->load->view("comp_selector");
		
		$this->load->view("home");

        //messages
		
        $this->form_validation->set_message('greater_than', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('less_than', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('integer', 'Класът трябва да е между 5 и 12!');
        $this->form_validation->set_message('required', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> е задължително!');
        $this->form_validation->set_message('category_check', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Моля изберете правилна категория!');
        $this->form_validation->set_message('max_length', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> има прекалено много символи!');
        $this->form_validation->set_message('numeric', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да съдържа само цифри!');
        $this->form_validation->set_message('valid_email', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да е валиден e-mail!');
        $this->form_validation->set_message('unique_email', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Този <em><strong>%s</strong></em> вече е използван!');
        $this->form_validation->set_message('is_cyrillic', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Полето <em><strong>%s</strong></em> трябва да е на кирилица!');
        $this->form_validation->set_message('coop_check', '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .5em; margin-top: .3em;"></span>Моля изберете дали вашият проект е индивидуален или в съавторство!');
		
        //--messages
		$this->load->model("info");
		$this->load->model("st_reg");
        $this->load->model("admin_reg");
		
//--tabs
        $this->load->view("footer");
    }
	
	public function reload_reg($id){
		$to_view["compet_id"] = $id;
		$this->load->view("st_reg", $to_view);
	}
	
	public function reload_reg_info($id){
		$this->db->select("name")->from("competitions")->where("id", $id);
		$query = $this->db->get();
		$rw = $query->row();
		$to_view["competit_id"] = $id;
		$to_view["competit_name"] = $rw->name;
		$this->load->view("info", $to_view);
	}
    
	function is_cyrillic($str) {
        $arr = array(
            'а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о',
            'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О',
            'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ь', 'Ю', 'Я',
            'ѝ', ' ', '.', '-', "'", '"');
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

    function coop_check($str) {
        if ($str == "yes" OR $str == "no") {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function unique_email($str) {
	    $comp_id = $this->session->userdata("competition_id");
        $this->db->select("id")->from("competitors")->where("email", $str)->where("comp_id", $comp_id);
        $q = $this->db->get();
		if ($q->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function split_utf8($str) {
        // place each character of the string into and array 
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
	
    

}
