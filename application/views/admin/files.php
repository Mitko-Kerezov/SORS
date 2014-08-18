<div id="files">
	<?php
	if($this->input->post("file_sub")){
			$this->load->model("admin/files");
	}
	$comp_id = $this->session->userdata("comp_id");
	$path = "uploads/";
	$dir = $path.$comp_id;
	if(is_dir($dir)){
		foreach(scandir($dir) as $file){
			if($file != "." && $file !=".."){
				echo '<a href="'.$dir.'/'.$file.'" class="fg-button ui-state-default ui-corner-left" style="text-decoration: none;">'.$file.'</a>'.
					 '<a href="admincont/delete/'.$file.'" class="fg-button ui-state-default ui-corner-right" style="text-decoration: none;">Изтриване</a><br><br>';
			}
		}
	}
	else{
		mkdir($dir);
	}
	?>
	<form method="post" enctype="multipart/form-data">
	<div>
		<input type="file" name="file" id="file" class="fg-button ui-state-hover ui-corner-all">
	</div>
	<br>
	<input type="submit" name="file_sub" id="file_sub" value="Качване">
	</form>
</div>