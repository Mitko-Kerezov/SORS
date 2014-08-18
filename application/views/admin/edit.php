<div id="edit">
	<?php
		$user_type = $this->session->userdata("user_type");
		$id = $this->session->userdata("comp_id");
		$q = $this->db->select("*")->from("competitions")->where("id", $id);
		$r = $q->get()->row();
		
		$rooms = $this->db->select("room")->from("rooms")->where("comp_id", $id);
		$rooms = $rooms->get();
		
		if($this->input->post("comp_edit")){
			if($this->form_validation->run('new_comp') == TRUE){
				$this->load->model("admin/edit_comp");
			}
			else{
				$this->load->view("admin/again_edit");
			}
		}
		
	?>
	<form method="post">
        <span style="width: 50%; display: inline-block; float: left;">
            <table>
                <tr>
					
                    <td colspan="2"><strong>Информация:</strong></td>
                </tr>
                <tr>
                    <td><strong>Име на състезанието:</strong></td><td class="css_left"><input type="text" name="name" value="<?php echo $r->name; ?>" <?php if($user_type=='dom' || $user_type=='ex') {?>readonly="" class="text ui-widget-header ui-corner-all" <?php } elseif($user_type=='admin') {?>class="text ui-widget-content ui-corner-all " required <?php } ?>/></td>
                </tr>
                <tr>
                    <td><strong>Място на провеждане:</strong></td><td class="css_left"><input type="text" name="place" value="<?php echo $r->place; ?>" <?php if($user_type=='dom' || $user_type=='ex') {?>readonly="" class="text ui-widget-header ui-corner-all" <?php } elseif($user_type=='admin') {?>class="text ui-widget-content ui-corner-all " required <?php } ?>/></td>
                </tr>
                <tr>
                    <td><strong>Дата на провеждане:</strong></td><td class="css_left"><input type="text" name="date" value="<?php echo date("d.m.Y", $r->date); ?>" <?php if($user_type=='dom' || $user_type=='ex') {?>id="dom_date"<?php } elseif($user_type=='admin') {?>id="date"<?php } ?> readonly="readonly" class="ui-widget-header ui-corner-all ui-state-disabled" required/></td>
                </tr>
                <tr>
                    <td><strong>Краен срок за регистрация:</strong></td><td class="css_left"><input type="text" name="deadline" value="<?php echo date("d.m.Y", $r->deadline); ?>" readonly="readonly" <?php if($user_type=='dom' || $user_type=='ex') {?>id="dom_deadline"<?php } elseif($user_type=='admin') {?>id="deadline"<?php } ?> class="ui-widget-header ui-corner-all ui-state-disabled" required/></td>
                </tr> 
				<tr>
                    <td><strong>Такса:</strong></td><td class="css_left"><input type="text" name="fee" value="<?php echo $r->fee; ?>" id="fee" <?php if($user_type=='dom' || $user_type=='ex') {?>readonly="" class="text ui-widget-header ui-corner-all" <?php } elseif($user_type=='admin') {?>class="text ui-widget-content ui-corner-all " required <?php } ?>/></td>
                </tr>
				<?php if($user_type == 'admin'){ ?>
                <tr>
                    <td colspan="2"><input type="submit" name="comp_edit" id="comp_edit_btn" value="Промяна"/></td>
                </tr>
				<?php } ?>
            </table>
        </span>
        <span style="width: 50%; display: inline;">
            <strong>Допълнителна информация:</strong><br/>
			<textarea cols="40" rows="10" name="info" <?php if($user_type=='admin') {?> class="ui-widget-content ui-corner-all" <?php } else {?> readonly="" class="ui-widget-header ui-corner-all" <?php } ?> ><?php echo $r->info; ?>
			</textarea>
			<br/>
			<font class="css_right">Възможно е използване на HTML тагове в доп.<br/> информация.</font>
        </span>
    </form>
</div>