<?php
		
			if (isset($compet_id)){
			$this->db->select("type")->select("name")->from("competitions")->where("id", $compet_id);
			$quer = $this->db->get();
			$rw = $quer->row();           //in $rw->type we have the type of the competition - 1 for ordinary , 0 for IT
			}
?>
    <form method="post">
		<?	$this->session->set_userdata("competition_id", $compet_id); ?>
        <table style="margin: 0 auto">
			<tr>
				<td><strong>Състезание:</strong></td>
				<td><input type="text" id="st_reg_comp" name="st_reg_comp" class="text ui-widget-content ui-corner-all" readonly="readonly" required/></td>
			</tr>
            <tr>
                <td><strong>Име:</strong></td>
                <td><input type="text" name="fname" value="<?php echo $this->session->userdata('re_fname'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Презиме:</strong></td>
                <td><input type="text" name="mname" value="<?php echo $this->session->userdata('re_mname'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Фамилия:</strong></td>
                <td><input type="text" name="lname" value="<?php echo $this->session->userdata('re_lname'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Телефон:</strong></td>
                <td><input type="text" name="tel" value="<?php echo $this->session->userdata('re_tel'); ?>" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td><strong>E-mail:</strong></td>
                <td><input type="email" name="email" value="<?php echo $this->session->userdata('re_email'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Град:</strong></td>
                <td><input type="text" name="city" value="<?php echo $this->session->userdata('re_city'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Училище:</strong></td>
                <td><input type="text" name="school" value="<?php echo $this->session->userdata('re_school'); ?>" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Клас:</strong></td>
                <td><select name="class" class="text ui-widget-content ui-corner-all">
						<option value="2" <?php if($this->session->userdata('re_class')==2) echo "selected"; ?>>2</option>
						<option value="3" <?php if($this->session->userdata('re_class')==3) echo "selected"; ?>>3</option>
						<option value="4" <?php if($this->session->userdata('re_class')==4) echo "selected"; ?>>4</option>
                        <option value="5" <?php if($this->session->userdata('re_class')==5) echo "selected"; ?>>5</option>
                        <option value="6" <?php if($this->session->userdata('re_class')==6) echo "selected"; ?>>6</option>
                        <option value="7" <?php if($this->session->userdata('re_class')==7) echo "selected"; ?>>7</option>
                    </select>
				</td>
            </tr>
			<?php
			
				if (isset($rw->type) && $rw->type == 0 )
				{
			?>
            <tr>
                <td><strong>Ръководител:</strong></td>
                <td><input type="text" value="<?php echo $this->session->userdata('re_teacher'); ?>" name="teacher" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Тема на проект:</strong></td>
                <td><input type="text" value="<?php echo $this->session->userdata('re_project'); ?>" name="project" class="text ui-widget-content ui-corner-all" required/></td>
            </tr>
            <tr>
                <td><strong>Направление:</strong></td>
                <td><select name="category" class="text ui-widget-content ui-corner-all">
                        <option value="Уеб сайт" <?php if($this->session->userdata('re_category')=="Уеб сайт") echo "selected"; ?>>Уеб сайт</option>
                        <option value="Мултимедия" <?php if($this->session->userdata('re_category')=="Мултимедия") echo "selected"; ?>>Мултимедия</option>
                        <option value="Интернет приложения" <?php if($this->session->userdata('re_category')=="Интернет приложения") echo "selected"; ?>>Интернет приложения</option>
                        <option value="Приложни програми" <?php if($this->session->userdata('re_category')=="Приложни програми") echo "selected"; ?>>Приложни програми</option>
                        <option value="Мултимедийни приложения" <?php if($this->session->userdata('re_category')=="Мултимедийни приложения") echo "selected"; ?>>Мултимедийни приложения</option>
                    </select></td>
            </tr>
            <tr>
                <td rowspan="2"><strong>Съавторство:</strong></td>
                <td style="float: left;"><input style="width: 21px;" type="radio" value="yes" name="coop" <?php if($this->session->userdata('re_coop')==1) echo "checked"; ?>/>Да</td>
            </tr>
            <tr>
                <td style="float:left"><input style="width: 21px;" type="radio" value="no" name="coop" <?php if($this->session->userdata('re_coop')==0) echo "checked"; ?>/>Не</td>
            </tr>
			<?php
				}
			//$this->session->sess_destroy();
			?>			
        </table>
        <br/>
        <input id="st_reg_btn" type="submit" value="Регистрирай се!" name="submit"/>
        <br/>
    </form>
			
<script type="text/javascript">
 $(function(){
  $("#st_reg_btn").button();
  $("#st_reg_comp").click(function(){
     $("#comp_selector_dialog").dialog("open");
  });
  var x = $("#comp_selector :selected").text();
  $("#comp_inp").attr("value", x);
  $("#st_reg_comp").attr("value", x);
  $("a[href=#home]").text(x);
 })
</script>