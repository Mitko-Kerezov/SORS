<script type="text/javascript">
	$(function(){
		$("#menu").tabs("option", "disabled" , []);
	})
</script>
<div id="print">
	Тук можете да разпечатате приходен касов ордер на участник, който вече е заплатил. <br/>
    Въведете поне два символа в полето за име на участник и изберете от падащият списък. Можете и директно да изпишете номера на участника.<br/><br/>
    <form method="post">
        <table style="margin: 0 auto;">
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType2" value="name" checked="checked"/>Име</td>
                <td>Име на участник:<input id="names_print2" class="text ui-widget-content ui-corner-all"/></td>
            </tr>
            <tr>
                <td style="text-align: left"><input style="width: 21px;" type="radio" name="sType2" value="id"/>Номер</td>
                <td style="float: right;">№:<input id="ids2" disabled="disabled" class="text ui-widget-content-disabled ui-corner-all"/></td>
            </tr>
            <tr><td colspan="2"><input type="submit" value="Принтирай" name="print_sub" id="print_sub"/></td></tr>
        </table>
    </form>
    <div id="ajResult2"></div>
	<div id="printable2"></div>
</div>