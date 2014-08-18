<?php
	$id = $this->session->userdata("comp_id");
	$type_q = $this->db->select("type")->from("competitions")->where("id", $id);
	$type_q = $type_q->get();
	$type_q = $type_q->row();
?>
<div id="table_competitors">
    <table id="datatable">
        <thead>
            <tr>
				<th width="100px">Номер</th>
                <th width="300px">Имена</th>
                <th width="80px">Клас</th>
                <th width="250px">Училище</th>
                <th width="150px">Град</th>
				<?php if($type_q->type == 0){ ?>
                <th width="200px">Категория</th>
                <th width="250px">Тема</th>
                <th width="220px">Ръководител</th>
                <th width="150px">Съавторство</th>
				<?php } ?>
		<th width="80px">Стая</th>
		<th width="80px">Място</th>
                <th width="150px">Телефон</th>
                <th width="200px">E-mail</th>
		<th width="150px">Платил/а</th>
		<th width="80px">Точки</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_table = $this->db->select("*")->from("competitors")->where("comp_id", $id);
            $query_table = $query_table->get();

            foreach ($query_table->result() as $row) {
                if($row->coop == 1) $coop = "Да"; else $coop = "Не";
				if($row->paid == 1) $row->paid = "Да"; else $row->paid = "Не";
                echo '<tr>';
				echo '<td width="100px">'.$row->id.'</td>';
                echo '<td width="300px">' . $row->fname . " " . $row->mname ." ". $row->lname . '</td>';
                echo '<td width="80px">' . $row->class . '</td>';
                echo '<td width="250px">' . $row->school . '</td>';
                echo '<td width="150px">' . $row->city . '</td>';
				if($type_q->type == 0){
                echo '<td width="200px">' . $row->category . '</td>';
                echo '<td width="250px">' . $row->project . '</td>';
                echo '<td width="220px">' . $row->teacher . '</td>';
                echo '<td width="150px">' . $coop . '</td>';
				}
		echo '<td width="80px">' . $row->room . '</td>';
		echo '<td width="80px">' . $row->place . '</td>';
                echo '<td width="150px">' . $row->phone . '</td>';
                echo '<td width="200px">' . $row->email . '</td>';
		echo '<td width="150px">' . $row->paid . '</td>';
		echo '<td width="80px">' . $row->marks . '</td>';
				echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>