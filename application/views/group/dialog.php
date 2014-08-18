<div id="mass_data">
<p>
	<strong>Състезание</strong>: <?php echo $cmp; ?> </br>
	<strong>Град</strong>: <?php echo $c; ?><br/>
	<strong>Училище</strong>: <?php echo $s; ?></br>
</p>
<table id="datatable">
<thead>
<tr>
	<th>Име</th>
	<th>Презиме</th>
	<th>Фамилия</th>
	<th>Клас</th>
	<th>E-mail</th>
	<?php if($type == 0){ ?>
		<th>Ръководител</th>
		<th>Проект</th>
		<th>Направление</th>
		<th>Съавторство</th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php foreach($n as $key => $value){ ?>
	<tr>
		<?php foreach($value as $var => $info){ ?>
			<td> <?php echo $info; ?> </td>
		<?php } ?>
	</tr>
<?php } ?>
</tbody>
</table>
<a href="groupcont/process_data" id="st_reg_btn">Изпращане</a>
</div>