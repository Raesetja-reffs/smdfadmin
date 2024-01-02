
<!DOCTYPE html>

<html>
<head>
<script src="<?php echo e(asset('js/jquery-2.2.3.min.js')); ?>"></script>
    <link href="<?php echo e(asset('css/jquery.flexdatalist.min.css')); ?>" rel="stylesheet"  type='text/css'>
    <script src="<?php echo e(asset('js/jquery.flexdatalist.min.js')); ?>"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- ... -->
    <!-- DevExtreme themes -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.common.css">
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.light.css">

    <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui2.min.css')); ?>" type="text/css" />
    <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
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
                            <label class="control-label" for="CustCodeInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Customer Code</label>
                            <input class="form-control input-sm col-xs-1" id="CustCodeInput" style="height:22px;font-size: 10px;"value =""></input>
                        </div>
                        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="inputRepCode"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Rep Code</label>
                            <input type="text" name="custCode" class="form-control input-sm col-xs-1" id="inputRepCode" style="height:22px;font-size: 10px;"value =""></input>
                        </div>

                        <div class="form-group col-md-3"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="inputMerchCode"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Merchandiser Code</label>
                            <input type="text" name="custDescription" class="form-control input-sm col-xs-1" id="inputMerchCode" style="height:22px;font-size: 10px;"value =""></input>
                        </div>
                        <div class="form-group col-md-2 itCanHide"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                            <label class="control-label" for="IsSalesRepInput"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Is a Sales Rep</label>
                            <select type="text" class="form-control input-sm col-xs-1" id="IsSalesRepInput" style="height:22px;font-size: 10px;">
                            <option value = 0>No</option>
                            <option value = 1>Yes</option>
    </select>
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
    
    var jArray = JSON.stringify(<?php echo json_encode($merchies); ?>);
    var jArrayCustomerCode =JSON.stringify(<?php echo json_encode($customercode); ?>);
    var jArrayMerchieCodes =JSON.stringify(<?php echo json_encode($merchiecodes); ?>);

    var Commands = $.map(JSON.parse(jArray), function (item) {
        var booleanfromitem = (item.blnIsSaleRep ==1); //wow that works use this as a comparator but be sure to make a string true false value in sql first
        return {
            ID:item.intAutoId,
            CustomerCode: item.strCustomerCode, //
            RepCode:item.strRepCode,
            MerchieCode:item.strMerchieCode,//
            LastChanged:item.dteLatChanged,//
            blnIsSaleRep:booleanfromitem
        }

    });
    var CustomerCode = $.map(JSON.parse(jArrayCustomerCode), function (item) {
        return {
            CustomerPastelCode:item.CustomerPastelCode
        }

    });
    var MerchieCode = $.map(JSON.parse(jArrayMerchieCodes), function (item) {
        return {
            MerchieCode:item.merchiecode
        }

    });

    var CustCodeInput = $('#CustCodeInput').flexdatalist({
            minLength: 1,
            valueProperty: '*',
            selectionRequired: true,
            searchContain:true,
            focusFirstResult: true,
            visibleProperties: ["CustomerPastelCode"],
            searchIn: 'CustomerPastelCode',
            data: CustomerCode
        });
        CustCodeInput.on('select:flexdatalist', function (event, data) {

            $('#CustCodeInput').val(data.CustomerPastelCode);
        });
        var MerchieCodeInput = $('#inputMerchCode').flexdatalist({
            minLength: 1,
            valueProperty: '*',
            selectionRequired: true,
            searchContain:true,
            focusFirstResult: true,
            visibleProperties: ["MerchieCode"],
            searchIn: 'MerchieCode',
            data: MerchieCode
        });
        MerchieCodeInput.on('select:flexdatalist', function (event, data) {

            $('#inputMerchCode').val(data.MerchieCode);
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
            $('#submitParams').click(function(){
                console.log($('#CustCodeInput').val());
                console.log($('#inputMerchCode').val());
                $.ajax({
                    url: '<?php echo url("/insertNewMerchie"); ?>',
                    type: "POST",
                    data: {
                        CustCode: $('#CustCodeInput').val(),
                        RepCode: $('#inputRepCode').val(),
                        MerchieCode: $('#inputMerchCode').val(),
                        IsRep: $('#IsSalesRepInput').val()
                    },
                    success: function (data) {
                                    location.reload();
                    }
                });
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
                                     allowUpdating: true,
                                     allowDeleting: true
                                },
                                columns: [
                                    {allowEditing:false,
                                        dataField: "ID",
                                        caption: "ID"

                                    },
                                    {
                                        dataField: "CustomerCode",
                                        caption: "Customer Code"

                                    },{
                                        dataField: "RepCode",
                                        caption: "Rep Code"

                                    },{
                                        dataField: "MerchieCode",
                                        caption: "Merchandiser Code"

                                    },{allowEditing:false,
                                        dataField: "LastChanged",
                                        caption: "Last Changed"

                                    },{
                                        dataField: "blnIsSaleRep",
                                        caption: "Is a Sales Rep?"

                                    },

                                ] ,
                                
                                onRowUpdated: function(e) {
                                    $.ajax({
                                        url:'<?php echo url("/updateMerch"); ?>',
                                        type: "POST",
                                        data:{
                                            ID: e.key.ID,
                                            CustomerCode: e.key.CustomerCode,
                                            RepCode: e.key.RepCode,
                                            MerchieCode: e.key.MerchieCode,
                                            IsSalesRep: e.key.blnIsSaleRep,
                                        },
                                        success:function(data){
                                            var Response = data[0].Response;
                                            if (Response != 'No Error'){
                            var dialog = $('<p><strong style="color:red">Customer code does not exist, transaction failed</strong></p>').dialog({
                            height: 200, width: 700,modal: true,containment: false,
                            buttons: {
                                "Okay": function () {
                                    dialog.dialog('close');
                                    location.reload();
                                }
                            }
                        });
                                            }
                                        }
                                    });
                                },  onRowRemoved: function(e) {
                                    console.log(e.key.intAutoreturnId); 
                                    $.ajax({
                                        url:'<?php echo url("/deleteMerchie"); ?>',
                                        type: "POST",
                                        data:{
                                            merchieDelete: e.key.ID
                                        },
                                        success:function(data){
                                            location.reload();
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
<?php /**PATH C:\Users\deadl\Downloads\smdfmerchieadmin (3)\smdfmerchieadmin\dims21\resources\views/dims/merchiegrid.blade.php ENDPATH**/ ?>