<div id="rooms">
	<?php
		if($this->input->post("rooms_sub")){
			$this->load->model("admin/rooms");
		}
		if($this->input->post("new_room_sub")){
			$this->load->model("admin/rooms");
		}
		if($this->input->post("new_room")){
			$this->load->view("admin/new_room");
		}
		else{
	?>
	<form method="post">
		<input type="submit" name="rooms_sub" id="rooms_sub" value="Промяна"/>
		<input type="submit" name="new_room" id="new_room" value="Нова стая"/>
		<br/><br/>
		<table border="1px" width="80%" style="margin: 0 auto;" class="ui-state-default">
			<tr><th>Стая</th><th>Клас 1</th><th>Клас 2</th><th>Заети (клас 1)</th><th>Заети (клас 2)</th></tr>
			<?php 
				$id = $this->session->userdata("comp_id");
				$this->db->select("*")->from("rooms")->where("comp_id", $id);
				$query = $this->db->get();
				foreach($query->result() as $room){ 
				?>
					<tr>
						<td><input type="text" class="fg-button ui-state-hover ui-corner-all" value="<?php echo $room->room; ?>" name="room[<?php echo $room->id; ?>]"/></td>
						<td><?php 
								if($room->class1_taken == 0){ echo '<input type="text" class="fg-button ui-state-hover ui-corner-all" value="'; }
								echo $room->class1; 
								if($room->class1_taken == 0){ echo '" name="class1['.$room->id.']"/>'; } 
						?></td>
						<td><?php 
								if($room->class2_taken == 0){ echo '<input type="text" class="fg-button ui-state-hover ui-corner-all" value="'; }
								echo $room->class2; 
								if($room->class2_taken == 0){ echo '" name="class2['.$room->id.']"/>'; } 
						?></td>
						<td><?php echo $room->class1_taken; ?></td>
						<td><?php echo $room->class2_taken; ?></td>
					</tr>
				<?php } ?>
		</table>
	</form>
	<?php } ?>
</div>