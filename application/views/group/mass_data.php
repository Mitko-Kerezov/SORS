<div id="mass_data">
<form action="groupcont/mass_data" method="post">
<table style="margin: 0 auto;">
	<tr>
		<td>Състезание:</td><td><?php echo $cmp; ?></td>
	</tr>
	<tr>
		<td>Град:</td><td><input type="text" name="group_city" required></td>
	</tr>
	<tr>
		<td>Училище:</td><td><input type="text" name="group_school" required></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="group_submit" id="st_reg_btn" value="Напред"></td>
	</tr>	
</table>
</form>
<?php echo $errors; ?>
</div>