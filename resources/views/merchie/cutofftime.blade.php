
<!DOCTYPE html>

<html>
<head>
<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <link href="{{ asset('css/jquery.flexdatalist.min.css') }}" rel="stylesheet"  type='text/css'>
    <script src="{{ asset('js/jquery.flexdatalist.min.js') }}"></script>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ... -->
    <!-- DevExtreme themes -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.common.css">
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.light.css">

    <link rel="stylesheet" href="{{ asset('css/jquery-ui2.min.css') }}" type="text/css" />
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <!-- DevExtreme library -->
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/20.1.7/js/dx.all.js"></script>


    <style>
        .dx-datagrid{
            font:10px verdana;
        }

    </style>
</head>
<body style="font-family: Sans-serif">
<table class='border' style = "width:800">
                <tbody>

<tr>
                        <td>
                            <div id="gridContainer"/>


                        </td>

                    </tr>
                </tbody>
            </table>


<script>
    
    var jArray = JSON.stringify({!! json_encode($cutoff) !!});
	

   
    var CutOff = $.map(JSON.parse(jArray), function (item) {
        return {
            ID:item.ID,
            strDayOfWeek:item.strDayOfWeek,
            strCutOffTime:item.strCutOffTime
        }

    });
   
  

        $( document ).on( 'focus', ':input', function(){

            $( this ).attr( 'autocomplete', 'off' );
        });
        var clickTimer, lastRowClickedId;
        $(document).ready(function() {  

           
           
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
          
        
                            $("#gridContainer").dxDataGrid({
                                dataSource:CutOff,
                                showBorders: true,
                                width:1500,
                                filterRow: { visible: true },scrolling: {
            columnRenderingMode: "virtual"
        },
        columnAutoWidth:true,
        editing: {
                                     mode: "row",
                                     refreshMode: "reshape",
                                     allowUpdating: true,
                                     allowDeleting: true
                                },
                                columns: [
								
                                    {
                                        allowEditing:false,
                                        dataField: "ID",
                                        caption: "ID"

                                    },{
                                        allowEditing:false,
                                        dataField: "strDayOfWeek",
                                        caption: "Day Of Week"

                                    },{
                                        dataField: "strCutOffTime",
                                        caption: "Cut Off Time(in HH:MM 24h format)"

                                    },

                                ] ,
                                
                                onRowUpdated: function(e) {
                                    $.ajax({
                                        url:'{!!url("/updateCutoffTime")!!}',
                                        type: "POST",
                                        data:{
                                            ID: e.key.ID,
											Cutoff: e.key.strCutOffTime
                                        },
                                        success:function(data){
										console.log(data);
                                            var Response = data[0].Response;
                                            if (Response != 'No Error'){
                            var dialog = $('<p><strong style="color:red">Incorrect Format</strong></p>').dialog({
                            height: 200, width: 700,modal: true,containment: false,
                            buttons: {
                                "Okay": function () {
                                    dialog.dialog('close');
									
                                }
                            }
                        });
                                            }
											else 
											{
											alert(data[0].Response);
											location.reload();
											}
                                        }
                                    });
                                }
                                
                        });
                
            });
            function showDialog(tag,width,height)
    {
        $( tag ).dialog({height: height, modal: false,
            width: width,containment: false}).dialogExtend({
            "closable" : true, // enable/disable close button
            "maximizable" : false, // enable/disable maximize button
            "minimizable" : true, // enable/disable minimize button
            "collapsable" : true, // enable/disable collapse button
            "dblclick" : "collapse", // set action on double click. false, 'maximize', 'minimize', 'collapse'
            "titlebar" : false, // false, 'none', 'transparent'
            "minimizeLocation" : "right", // sets alignment of minimized dialogues
            "icons" : { // jQuery UI icon class

                "maximize" : "ui-icon-circle-plus",
                "minimize" : "ui-icon-circle-minus",
                "collapse" : "ui-icon-triangle-1-s",
                "restore" : "ui-icon-bullet"
            },
            "load" : function(evt, dlg){ }, // event
            "beforeCollapse" : function(evt, dlg){ }, // event
            "beforeMaximize" : function(evt, dlg){ }, // event
            "beforeMinimize" : function(evt, dlg){ }, // event
            "beforeRestore" : function(evt, dlg){ }, // event
            "collapse" : function(evt, dlg){  }, // event
            "maximize" : function(evt, dlg){ }, // event
            "minimize" : function(evt, dlg){  }, // event
            "restore" : function(evt, dlg){  } // event
        });
    }
    </script>
</div>
</body>
</html>
