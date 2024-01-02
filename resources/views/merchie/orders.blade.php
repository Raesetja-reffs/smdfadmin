<!DOCTYPE html>
<html>
    <head>
    <script src="{{ asset('js/ag_grid.js') }}"></script>
    <script src="{{ asset('public/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="{{ asset('css/ag_css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ag_cc_theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui2.min.css') }}" type="text/css" />
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<body style="font-family: Sans-serif">
<div class="form-group col-md-3 itCanHide"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
                    <label class="control-label" for="dateFrom"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Date From</label>
                    <input type="text" class="form-control input-sm col-xs-1" id="dateFrom" style="font-weight: 900;    color: black;font-size: 13px;">
                
                    <label class="control-label" for="dateTo"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">Date To</label>
                    <input type="text" class="form-control input-sm col-xs-1" id="dateTo" style="font-weight: 900;    color: black;font-size: 13px;">

                </div>
<button id="fetchData" class="btn-success btn-lg">FETCH DATA </button>

<div id="gridContainer"></div>
<br>
<br>
<br>
<h1 id = "storeName"></h1>
<div id="gridLines"></div>

</body>

<script type="text/javascript" charset="utf-8">

$( document ).on( 'focus', ':input', function(){

$( this ).attr( 'autocomplete', 'off' );
});
var clickTimer, lastRowClickedId;
$(document).ready(function() {  
    $("#dateFrom").datepicker({
            changeMonth: true,//this option for allowing user to select month
            changeYear: true,
            dateFormat: 'yy-mm-dd' });
        $("#dateTo").datepicker({
            changeMonth: true,//this option for allowing user to select month
            changeYear: true,
            dateFormat: 'yy-mm-dd' });
        var currentdate = new Date();
        $("#dateFrom").val($.datepicker.formatDate('yy-mm-dd', currentdate));
        $("#dateTo").val($.datepicker.formatDate('yy-mm-dd', currentdate));
    

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$('#fetchData').click(function () {
                    $.ajax({
                        url: '{!! url("/getMerchieOrders") !!}',
                        type: "GET",
                        data: {

                            DateFrom: $('#dateFrom').val(),
                            DateTo:$('#dateTo').val()

                        },success: function (data) {
                            $("#gridContainer").dxDataGrid({
                    dataSource:data,
                    showBorders: true,
                    filterRow: { visible: true },scrolling: {
                    columnRenderingMode: "virtual"
                    },
                    columnAutoWidth:true,
                        columns: [
                            {
                            dataField: "ID",
                            caption: "ID"

                        },{
                            dataField: "OrderDate",
                            caption: "Order Date"

                        },{
                            dataField: "DeliveryDate",
                            caption: "Delivery Date"

                        },{
                            dataField: "OrderNumber",
                            caption: "Order Number"

                        },{
                            dataField: "CustomerCode",
                            caption: "Customer Code"

                        },{
                            dataField: "StoreName",
                            caption: "Customer Name"

                        },{
                            dataField: "Notes",
                            caption: "Notes"

                        },{
                            dataField: "UserName",
                            caption: "UserName"

                        },{
                            dataField: "ExportedToDims",
                            caption: "Exported To Dims"

                        },{
                            dataField: "NumLines",
                            caption: "Number Of Lines"

                        },{
                            dataField: "DimsOrderID",
                            caption: "Dims Order ID"

                        },{
                            dataField: "TreatAsQuotation",
                            caption: "Treat As Quotation"
                        },{
                            dataField: "intUserId",
                            caption: "User ID"

                        },{
                            dataField: "lat",
                            caption: "Latitude"

                        },{
                            dataField: "lon",
                            caption: "Longtitude"

                        },

                    ] ,
                    
            onRowClick: function (e) {
                document.getElementById("storeName").innerHTML=e.key.StoreName;
                $.ajax({
                        url: '{!! url("/getMerchieOrderLines") !!}',
                        type: "GET",
                        data: {

                            ID:e.key.ID

                        },success: function (data) {
                            $("#gridLines").dxDataGrid({
                    dataSource:data,
                    showBorders: true,
                    filterRow: { visible: true },scrolling: {
                    columnRenderingMode: "virtual"
                    },
                    columnAutoWidth:true,
                        columns: [
                            {
                            dataField: "ID",
                            caption: "ID"

                        },{
                            dataField: "strPartNumber",
                            caption: "Item Code"

                        },{
                            dataField: "PastelDescription",
                            caption: "Item Name"

                        },{
                            dataField: "Quantity",
                            caption: "Quantity"

                        },{
                            dataField: "Price",
                            caption: "Price"

                        },{
                            dataField: "DIMSOrderDetailID",
                            caption: "DIMSOrderDetailID"

                        },{
                            dataField: "isReady",
                            caption: "isReady"

                        },{
                            dataField: "strCustomerCode",
                            caption: "Customer Code"

                        },

                    ] ,
                    
            onRowClick: function (e) {
              

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
                        }
                    });

                });
                
    
});
</script>
</html>