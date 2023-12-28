
<!DOCTYPE html>

<html>
<head>
<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <link href="{{ asset('css/jquery.flexdatalist.min.css') }}" rel="stylesheet"  type='text/css'>
    <script src="{{ asset('js/jquery.flexdatalist.min.js') }}"></script>
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
<fieldset class="well">
                    <legend class="well-legend">Parameters</legend>
                    <form >
                    <div class="form-group  col-md-2" style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="RepCodeInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Rep Name</label>
                            <input class="form-control input-sm col-xs-1" id="RepCodeInput" style="height:22px;font-size: 10px;"value =""></input>
                        </div>
                        <div class="form-group  col-md-2" style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="MerchieCodeInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Merchie Code</label>
                            <input class="form-control input-sm col-xs-1" id="MerchieCodeInput" style="height:22px;font-size: 10px;"value =""></input>
                        </div>
                        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="MerchieNameInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Merchie Name</label>
                            <input type="text" name="MerchieName" class="form-control input-sm col-xs-1" id="MerchieNameInput" style="height:22px;font-size: 10px;"value =""></input>
                        </div>

                        <div class="form-group col-md-3"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="MerchiePincodeInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Merchie Pincode</label>
                            <input type="number" name="MerchiePincode" class="form-control input-sm col-xs-1" id="MerchiePincodeInput" style="height:22px;font-size: 10px;"value =""></input>
                        </div>
                       

                        <button type="button" id="submitParams" class="btn-xs btn-primary">Submit</button>


                    </form>
                </fieldset>
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
    


    var jArrayRepCode =JSON.stringify({!! json_encode($repcode) !!});
    var RepCode = $.map(JSON.parse(jArrayRepCode), function (item) {
        return {
            strRepCode:item.strRepCode
        }

    });
    var RepCodeInput = $('#RepCodeInput').flexdatalist({
            minLength: 1,
            valueProperty: '*',
            selectionRequired: true,
            searchContain:true,
            focusFirstResult: true,
            visibleProperties: ["strRepCode"],
            searchIn: 'strRepCode',
            data: RepCode
        });
        RepCodeInput.on('select:flexdatalist', function (event, data) {

            $('#RepCodeInput').val(data.strRepCode);
        });
    var jArray = JSON.stringify({!! json_encode($usergrid) !!});

    var Commands = $.map(JSON.parse(jArray), function (item) {
        var booleanfromitem = (item.UserActive ==1); //wow that works use this as a comparator but be sure to make a string true false value in sql first
        return {
            UserID:item.UserID,
            UserTypeID: item.UserTypeID, //
            UserName:item.UserName,
            UserIdentity:item.UserIdentity,//
            UserStartDate:item.UserStartDate,//
            UserActive:booleanfromitem,
            PinCode:item.PinCode,//
            DIMSUser:item.DIMSUser,//
            Rep:item.Rep,//
            RepEmail:item.RepEmail,//
            RepEmailCC:item.RepEmailCC,//
            MerchieName:item.MerchieName,//
            MerchieCode:item.MerchieCode//
        }

    });

  

        $( document ).on( 'focus', ':input', function(){

            $( this ).attr( 'autocomplete', 'off' );
        });
        var clickTimer, lastRowClickedId;
        $(document).ready(function() {  
            $('#submitParams').click(function(){
                $.ajax({
                    url: '{!!url("/insertNewUserMerchie")!!}',
                    type: "POST",
                    data: {
                        MerchieCodePincode: $('#MerchiePincodeInput').val(),
                        MerchieName: $('#MerchieNameInput').val(),
                        MerchieCode: $('#MerchieCodeInput').val(),
                        RepCode: $('#RepCodeInput').val()
                    },
                    success: function (data) {
                                    location.reload();
                    }
                });
            });
        
           
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            

                            $("#gridContainer").dxDataGrid({
                                dataSource:Commands,
                                showBorders: true,
                                width:1500,
                                filterRow: { visible: true },scrolling: {
            columnRenderingMode: "virtual"
        },
        columnAutoWidth:true,
        editing: {
                                     mode: "row",
                                     refreshMode: "reshape",
                                     allowUpdating: true
                                },
                                columns: [
                                    {allowEditing:false,
                                        dataField: "UserID",
                                        caption: "UserID"

                                    },
                                    {
                                        dataField: "UserTypeID",
                                        caption: "User Type ID"

                                    },{
                                        dataField: "UserName",
                                        caption: "Usename "

                                    },{
                                        dataField: "UserIdentity",
                                        caption: "User Identity"

                                    },{
                                        dataField: "UserStartDate",
                                        dataType: 'date',  
                                        format: 'dd/MM/yyyy',  
                                        caption: "User Start Date"

                                    },{
                                        dataField: "UserActive",
                                        caption: "UserActive"

                                    },{
                                        dataField: "PinCode",
                                        caption: "Pincode"

                                    },{
                                        dataField: "DIMSUser",
                                        caption: "DIMSUser"

                                    },{
                                        dataField: "Rep",
                                        caption: "Rep"

                                    },{
                                        dataField: "RepEmail",
                                        caption: "RepEmail"

                                    },{
                                        dataField: "RepEmailCC",
                                        caption: "RepEmailCC"

                                    },{
                                        dataField: "MerchieCode",
                                        caption: "MerchieCode"

                                    },{
                                        dataField: "MerchieName",
                                        caption: "MerchieName"

                                    },

                                ] ,
                                
                                onRowUpdated: function(e) {
                                    $.ajax({
                                        url:'{!!url("/updateuser")!!}',
                                        type: "POST",
                                        data:{
                                            UserID: e.key.UserID,
                                            UserTypeID: e.key.UserTypeID,
                                            UserName: e.key.UserName,
                                            UserIdentity: e.key.UserIdentity,
                                            UserStartDate: e.key.UserStartDate,
                                            UserActive: e.key.UserActive,
                                            PinCode: e.key.PinCode,
                                            DIMSUser: e.key.DIMSUser,
                                            Rep: e.key.Rep,
                                            RepEmail: e.key.RepEmail,
                                            RepEmailCC: e.key.RepEmailCC,
                                            MerchieCode: e.key.MerchieCode,
                                            MerchieName: e.key.MerchieName,
                                        },
                                        success:function(data){

                                        }
                                    });
                                },
                            
                                onInitNewRow: function(e) {
                                    console.debug("InitNewRow");
                                },
                                onRowInserting: function(e) {
                                    console.debug("RowInserting");
                                },
                                onRowInserted: function(e) {
                                    console.debug("RowInserted");
                                },
                                onRowUpdating: function(e) {
                                    console.debug("RowUpdating");
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
