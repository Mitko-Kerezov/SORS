<div id="new_comp">
    <?php
	if( $this->input->post("comp_choice_submit") == TRUE ){
		echo '<script type="text/javascript">';
		echo '$("#menu").tabs({ selected: 7});';
		echo '</script>';
	}
		if ( $this->input->post("comp_choice_submit") == TRUE || $this->input->post("comp_sub") == TRUE ) {
			if ($this->input->post("comp_sub") && $this->form_validation->run('new_comp') == TRUE) {
                $this->load->model("admin/comp_reg");
            }
			else
				if ($this->input->post("comp_sub") && $this->form_validation->run('new_comp') == FALSE) {
					$this->load->view("admin/again");
				}
		$type = $this->input->post("type");
		$this->session->set_userdata("type", $type);
    ?>
    <form method="post">
        <span style="width: 50%; display: inline-block; float: left;">
            <table>
                <tr>
                    <td colspan="2"><strong>Информация:</strong></td>
                </tr>
                <tr>
                    <td><strong>Име на състезанието:</strong></td><td class="css_left"><input type="text" name="name" class="text ui-widget-content ui-corner-all" value="<?php echo $this->input->post("name");?>" required/></td>
                </tr>
                <tr>
                    <td><strong>Място на провеждане:</strong></td><td class="css_left"><input type="text" name="place" class="text ui-widget-content ui-corner-all" value="<?php echo $this->input->post("place");?>" required/></td>
                </tr>
                <tr>
                    <td><strong>Дата на провеждане:</strong></td><td class="css_left"><input type="text" name="date" id="date1" readonly="readonly" class="ui-widget-header ui-corner-all ui-state-disabled" required/></td>
                </tr>
                <tr>
                    <td><strong>Краен срок за регистрация:</strong></td><td class="css_left"><input type="text" name="deadline" readonly="readonly" id="deadline1" class="ui-widget-header ui-corner-all ui-state-disabled" required/></td>
                </tr>
				<tr>
                    <td><strong>Кабинети:</strong></td><td class="css_left"><input type="text" name="rooms" id="rooms" class="text ui-widget-content ui-corner-all" value="<?php echo $this->input->post("rooms");?>" required/></td>
                </tr>
				<tr>
                    <td><strong>Такса:</strong></td><td class="css_left"><input type="text" name="fee" id="fee" class="text ui-widget-content ui-corner-all" value="<?php echo $this->input->post("fee");?>"/></td>
                </tr>
				<tr>
					<td rowspan="2"><strong>Класове:</strong></td>
					<td style="float: left;"><input style="width: 21px;" type="radio" value="low" name="class_range" <?php if($this->input->post('class_range')==0) echo "checked"; ?>/>2-7</td>
				</tr>
				<tr>
					<td style="float:left"><input style="width: 21px;" type="radio" value="high" name="class_range" <?php if($this->input->post('class_range')==1) echo "checked"; ?>/>5-12</td>
				</tr>
                <tr>
                    <td colspan="2"><input type="submit" name="comp_sub" id="comp_reg_btn" value="Създаване"/></td>
                </tr>
            </table>
        </span>
        <span style="width: 50%; display: inline;">
            <strong>Допълнителна информация:</strong><br/>
            <textarea cols="40" rows="10" name="info" class="text ui-widget-content ui-corner-all" >
				<?php echo $this->input->post("info");?>
			</textarea><br/>
			<font class="css_right">Възможно е използване на HTML тагове в доп.<br/> информация.</font>
        </span>
    </form>
	<?php
		}
		else if ($this->input->post("comp_choice_submit") == FALSE || $this->input->post("comp_sub") == FALSE) {
	?>
		<form method="post">
            <table style="margin: 0 auto">
                <tr>
                    <td><strong>Вид на състезанието:</strong></td>
                </tr>
                <tr>
                    <td style="float: right;">
						<input type="radio" value="1" name="type" id="type1" checked="checked" />Други състезания
					</td>
                    <td style="float: left;">
						<input type="radio" value="0" name="type"/>Олимпиада по ИТ
					</td>
                </tr>
            </table>
			<br/>
			<input id="comp_choose_btn" type="submit" value="Избери!" name="comp_choice_submit"/>
			<br/>
    </form>
	<?php
		}
	?>
</div>