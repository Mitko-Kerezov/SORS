<!DOCTYPE html>
<html>
    <head>
        <title>СОРС</title>
        <meta charset="UTF-8"/>
        <link  rel="stylesheet" type="text/css" href="style.css"/>
        <link  rel="stylesheet" type="text/css" href="css/start/jquery-ui-1.8.15.custom.css"/>
        <link  rel="stylesheet" type="text/css" href="css/start/demo_table_jui.css"/>
        <link  rel="stylesheet" type="text/css" href="css/start/ColVis.css"/>
        <link  rel="stylesheet" type="text/css" href="css/start/TableTools_JUI.css"/>
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.15.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/ColVis.min.js"></script>
        <script type="text/javascript" src="js/TableTools.min.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-bg.js"></script>
		<script type="text/javascript" src="js/filestyle.js" ></script>
		<script type="text/javascript" src="js/jquery.ui.print.js" ></script>

        <script type="text/javascript">
            $(function(){
                $("#menu").tabs({
                    select: function(event, ui) {
                        var url = $.data(ui.tab, 'load.tabs');
                        if( url ) {
                            location.href = url;
                            return false;
                        }
                        return true;
                    },
					disabled: [1,2,3]
                });
                $("#st_reg_btn").button();
				$("#type").buttonset();
				$("#comp_choose_btn").button();
				$("#admin_reg_btn").button();
                $("#comp_reg_btn").button();
				$("#file_sub").button();
				$("#rooms_sub").button();
				$("#new_room").button();
				$("#ex_class_post").button();
				$("#ex_submit")
					.button()
					.click(function(){
						if($("#ex_ids").val() != 0){
							marks = $("#ex_marks").val().replace(",", ".");
							$("#ajResult").load("excont/marks/"+$("#ex_ids").val()+"/"+marks);
						}
                        return false;
                    })
				$("input[type=file]").filestyle({ 
					 image: "css/start/images/upload.png",
					 
					 imageheight : 30,
					 imagewidth : 82,
					 width : 200,
					 
				 });
				
				$("#comp_edit_btn").button();
                $("#date").datepicker({
					firstDay: 1,
                    minDate: 0,
                    dateFormat: 'dd.mm.yy'
                });
				$("#date1").datepicker({
					firstDay: 1,
                    minDate: 0,
                    dateFormat: 'dd.mm.yy'
                });
                $("#deadline").datepicker({
					firstDay: 1,
					minDate: 0,
                    dateFormat: 'dd.mm.yy'
                });
				$("#deadline1").datepicker({
					firstDay: 1,
					minDate: 0,
                    dateFormat: 'dd.mm.yy'
                });
				
				
				$("#comp_selector_dialog").dialog({
					autoOpen: false,
					modal: true
				});
				$("#comp_selector_group").dialog({
					autoOpen: true,
					modal: true
				});
				$("#comp_selector_dialog_open")
					.button()
					.click(function(){
						$("#comp_selector_dialog").dialog("open");
					});
				$("#comp_select_button")
					.button()
					.click(function(){
						$("#event_info").load("indexcont/get_info/"+$("#comp_selector").val());
						$("#menu").tabs("option", "disabled" , []);
						var x = $("#comp_selector :selected").text();
						$("#comp_inp").attr("value", x);
						$("#st_reg_comp").attr("value", x);
						$("a[href=#home]").text(x);
						$("#comp_selector_dialog").dialog("close");
						$("#info").load("indexcont/reload_reg_info/"+$("#comp_selector").val());
						$("#st_reg").load("indexcont/reload_reg/"+$("#comp_selector").val());
					});
				$("#comp_select_group")
					.button()
					.click(function(){
						$.get("groupcont/comp_select/"+$("#comp_selector").val(), function(){ location.reload(); });
					});
				$("#st_reg_comp").click(function(){
					$("#comp_selector_dialog").dialog("open");
				});
                $("#dialog").dialog({
                    buttons: [{
                            text: "Ok",
                            click: function() { $(this).dialog("close"); }
                        }],
                    width: 550,
                    modal: true
                });
				
                $("#names").autocomplete({
                    source: "admincont/autocomplete",
                    minLength: 2,
                    select: function(event, ui){
                        $("#ids").val(ui.item.id);
                    }
                });
				$("#names_print2").autocomplete({
                    source: "admincont/autocomplete_paid",
                    minLength: 2,
                    select: function(event, ui){
                        $("#ids2").val(ui.item.id);
                    }
                });
				
				
				
				$("#print_sub")
                    .button()
                    .click(function(){
						if($("#ids2").val() != 0){
							var url_print="admincont/r_print_only/";
							url_print += $("#ids2").val();
							$("#printable2").load(url_print, function(){
									$("#printable2").printElement({printMode:'iframe'});
									$("#printable2").empty();
							 });
						}	
						else{
							$("#ajResult2").load("Грешка");
						};
                        return false;
                    });
                $("#paiment_sub")
                    .button()
                    .click(function(){
						if($("#ids").val() != 0){
							var url_pay="admincont/fPay/";
							url_pay += $("#ids").val();
							var url_print="admincont/r_print/";
							url_print += $("#ids").val();
							$("#ajResult").load(url_pay);
							$("#printable").load(url_print, function(){
									$("#printable").printElement({printMode:'iframe'});
									$("#printable").empty();
							 });
							document.getElementById('ids').value = "";
							document.getElementById('names').value = "";
						}	
						else{
							$("#ajResult").load("admincont/nPay/");
						};
                        return false;
                    });
                $("input[name='sType']").click(function(){
                    if(this.value == "name"){
                        $("#names").removeAttr("disabled");
                        $("#ids").attr("disabled", "disabled");
						$("#ex_names").removeAttr("disabled");
                        $("#ex_ids").attr("disabled", "disabled");
                    }
                    if(this.value == "id"){
						$("#ids").removeAttr("disabled");
                        $("#names").attr("disabled", "disabled");
                        $("#ex_names").attr("disabled", "disabled");
                        $("#ex_ids").removeAttr("disabled");
                    }
                });
				 $("input[name='sType2']").click(function(){
                    if(this.value == "name"){
                        $("#names2").removeAttr("disabled");
                        $("#ids2").attr("disabled", "disabled");
                    }
                    if(this.value == "id"){
						$("#ids2").removeAttr("disabled");
                        $("#names2").attr("disabled", "disabled");
                    }
                });
                $("#datatable").dataTable({
                    "sDom": '<"H"<"css_left"TC>fr>t<"F"ip>',
                    "bJQueryUI": true,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "bAutoWidth": true,
                    "sScrollX": "100%",
                    
                    "iDisplayLength": 19,
                    "oLanguage": {
                        "oPaginate": {
                            "sFirst": "Първа",
                            "sLast": "Последна",
                            "sNext": "Следваща",
                            "sPrevious": "Предишна"
                        },
                        "sEmptyTable": "Няма резултати",
                        "sInfo": "От _START_ до _END_ (Общо _TOTAL_)",
                        "sInfoEmpty": "Няма резултати",
                        "sInfoFiltered": " - сортирани от _MAX_",
                        "sSearch": "Филтри:",
                        "sZeroRecords": "Няма резултати"
                    },
                    "oColVis": {
                        "buttonText": "Колони"
                    },
                    "oTableTools": {
                        "aButtons": [
                            {
                                "sExtends":    "collection",
                                "sButtonText": "Съхрани",
                                "aButtons":    [ "xls" ]
                            }
                        ],
                        "sSwfPath": "swf/copy_cvs_xls.swf"
                    }
                });
            });
        </script>
    </head>
    <body>
        <header class="ui-corner-all ui-widget-header">
            <h1 id="headtxt">Система за Организация и Реализация на Състезания</h1>
        </header>