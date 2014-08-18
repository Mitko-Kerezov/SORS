<div id="comp_selector_dialog" title="Избор на състезание">
	<select id="comp_selector" class="fg-button ui-widget ui-corner-all ui-state-hover">
		<?php 
			$query = $this->db->select("*")->from("competitions");
			$q = $query->get();
			foreach($q->result() as $r){
				echo '<option value="'.$r->id.'">'.$r->name.'</option>';
			}
		?>
	</select>
	<button id="comp_select_button">Избери</button>
</div>