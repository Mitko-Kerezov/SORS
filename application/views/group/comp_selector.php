<div id="comp_selector_group" title="Избор на състезание">
	<select id="comp_selector" class="fg-button ui-widget ui-corner-all ui-state-hover">
		<?php 
			$query = $this->db->select("*")->from("competitions")->where("deadline >", time());
			$q = $query->get();
			foreach($q->result() as $r){
				echo '<option value="'.$r->id.'">'.$r->name.'</option>';
			}
		?>
	</select>
	<button id="comp_select_group">Избери</button>
</div>