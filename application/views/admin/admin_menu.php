<div id="menu">
    <ul>
	<?php if($user_type == 'admin'){ ?>
		<li><a href="#edit">Промяна</a></li>
	<?php }
		  else if ($user_type == 'dom'){ ?>
		  <li><a href="#edit">Състезание</a></li>
	<?php } ?>
		  
		<li><a href="#paid">Платили</a></li>
		<li><a href="#print">Принт</a></li>
		<li><a href="#table_competitors">Участници</a></li>
	<?php if($user_type == 'admin'){ ?>
		<li><a href="#files">Файлове</a></li>
		<li><a href="#rooms">Стаи</a></li>
	<?php } ?>	
        <li style="float: right;"><a href="admincont/logout">Изход</a></li> 
	<?php if($user_type == 'admin'){ ?>
		<li style="float: right;"><a href="#new_comp">Ново състезание</a></li>
    <?php } ?>
	</ul>