<form method="post">
    <table style="margin: 0 auto">
        <tr>
            <td><strong>Въведете своя e-mail, за проверите имате ли регистрация за <?php echo $competit_name; ?>:</strong></td>
        </tr>
		<tr>    
			<td><input type="email" name="email_check" class="text ui-widget-content ui-corner-all" required/></td>
			<td><input type="hidden" name="comp_id" value="<?php echo $competit_id; ?>"/></td>
			<td><input type="hidden" name="comp_name" value="<?php echo $competit_name; ?>"/></td>
		</tr>
    </table>
    <br/>
	<input id="info_check_btn" type="submit" value="Провери!" name="info_check"/>
</form>
<script type="text/javascript"> 
  $("#info_check_btn").button();
</script>