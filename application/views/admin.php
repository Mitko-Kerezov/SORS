<div id="admin" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
            <form method="post">
                <table style="margin: 0 auto">
                    <tr>
                        <td><strong>Потребителско име:</strong></td>
                        <td><input type="text" name="uname" class="text ui-widget-content ui-corner-all" required/></td>
                    </tr>
                    <tr>
                        <td><strong>Парола:</strong></td>
                        <td><input type="password" name="pass" class="text ui-widget-content ui-corner-all" required/></td>
                    </tr>
                </table>
                <br/>
				<input type="hidden" name="competition" value="" id="comp_inp"/>
                <input id="admin_reg_btn" type="submit" value="Влез!" name="admin_submit"/>
            </form>
</div>