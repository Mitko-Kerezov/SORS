<div id="marks">
	<form method="post" action="excont/marks">
        <table style="margin: 0 auto;">
			<tr>
				<td colspan="2">Клас: <?php echo $ex_class; ?></td>
			</tr>
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType" value="name" checked="checked"/>Име</td>
                <td>Име на участник:<input id="ex_names" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType" value="id"/>Номер</td>
                <td style="float: right;">№:<input id="ex_ids" disabled="disabled" class="text ui-widget-content-disabled ui-corner-all" name="ex_ids"/></td>
            </tr>
			<tr>
				<td>Получени точки:</td>
				<td><input type="text" name="ex_marks" id="ex_marks" class="text ui-widget-content-disabled ui-corner-all"></td>
			</tr>
            <tr><td colspan="2"><input type="submit" value="Записване" name="ex_submit" id="ex_submit"/></td></tr>
        </table>
    </form>
    <div id="ajResult"></div>
</div>
<script type="text/javascript">
	$(function(){
		$("#menu").tabs({selected: 1});
		$("#ex_names").autocomplete({
                    source: "excont/autocomplete/<?php echo $ex_class; ?>",
                    minLength: 2,
                    select: function(event, ui){
                        $("#ex_ids").val(ui.item.id);
                    }
                });
	})
</script>