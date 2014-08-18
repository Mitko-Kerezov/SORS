<script type="text/javascript">
	$(function(){
		$("#menu").tabs("option", "disabled" , []);
	})
</script>
<div id="paid">
    Въведете поне два символа в полето за име на участник и изберете от падащият списък. Можете и директно да изпишете номера на участника.<br/><br/>
    <form method="post">
        <table style="margin: 0 auto;">
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType" value="name" checked="checked"/>Име</td>
                <td>Име на участник:<input id="names" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType" value="id"/>Номер</td>
                <td style="float: right;">№:<input id="ids" disabled="disabled" class="text ui-widget-content-disabled ui-corner-all"/></td>
            </tr>
            <tr><td colspan="2"><input type="submit" value="Заплащане" name="paiment_sub" id="paiment_sub"/></td></tr>
        </table>
    </form>
    <div id="ajResult"></div>
	<div id="printable"></div>
</div>