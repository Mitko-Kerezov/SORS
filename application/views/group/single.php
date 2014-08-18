<div id="mass_data">
<form action="groupcont/single_data" method="post">
<table style="margin: 0 auto;">
	<tr>
		<td>Състезание:</td><td><?php echo $cmp; ?></td>
	</tr>
	<tr>
		<td>Град:</td><td><?php echo $c; ?></td>
	</tr>
	<tr>
		<td>Училище:</td><td><?php echo $s; ?></td>
	</tr>
	<tr>
		<td>Име:</td><td><input type="text" name="single[fname]" required></td>
	</tr>
	<tr>
		<td>Презиме:</td><td><input type="text" name="single[mname]" required></td>
	</tr>
	<tr>
		<td>Фамилия:</td><td><input type="text" name="single[lname]" required></td>
	</tr>
	<tr>
		<td>Клас:</td><td><select name="single[class]" class="text ui-widget-content ui-corner-all">
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select></td>
	</tr>
	<tr>
		<td>E-mail:</td><td><input type="text" name="single[email]" required></td>
	</tr>
	
	<?php if($type == 0){ ?>
	<tr>
        <td><strong>Ръководител:</strong></td>
        <td><input type="text" name="single[teacher]" class="text ui-widget-content ui-corner-all" required/></td>
    </tr>
    <tr>
        <td><strong>Тема на проект:</strong></td>
        <td><input type="text" name="single[project]" class="text ui-widget-content ui-corner-all" required/></td>
    </tr>
    <tr>
		<td><strong>Направление:</strong></td>
        <td><select name="single[category]" class="text ui-widget-content ui-corner-all">
                        <option value="Уеб сайт">Уеб сайт</option>
                        <option value="Мултимедия">Мултимедия</option>
                        <option value="Интернет приложения">Интернет приложения</option>
                        <option value="Приложни програми">Приложни програми</option>
                        <option value="Мултимедийни приложения">Мултимедийни приложения</option>
            </select></td>
    </tr>
    <tr>
        <td rowspan="2"><strong>Съавторство:</strong></td>
        <td style="float: left;"><input style="width: 21px;" type="radio" value="1" name="single[coop]"/>Да</td>
    </tr>
    <tr>
        <td style="float:left"><input style="width: 21px;" type="radio" value="0" name="single[coop]"/>Не</td>
    </tr>
	<?php } ?>
	
	<tr>
		<td><input type="submit" name="next" id="st_reg_btn" value="Напред"></td>
		<td><input type="submit" name="end" id="new_room" value="Край"></td>
	</tr>	
</table>
</form>
<?php echo $errors; ?>
</div>