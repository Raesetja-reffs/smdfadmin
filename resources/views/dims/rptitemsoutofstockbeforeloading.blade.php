<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/ag_grid.js') }}"></script>
    <script src="{{ asset('public/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.dialogextend.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ag_css.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ag_cc_theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui2.min.css') }}" type="text/css" />
    <style>
        .rag-red {
            background-color: #f00f0c;
        }
        .rag-green {
            background-color: lightgreen;
        }
        .rag-amber {
            background-color: lightsalmon;
        }
        .rag-yellow {
            background-color: #f6ff23;
        }

        .rag-red-outer .rag-element {
            background-color: lightcoral;
        }

        .rag-green-outer .rag-element {
            background-color: lightgreen;
        }

        .rag-amber-outer .rag-element {
            background-color: lightsalmon;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            border: 1px solid #dddddd;

        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
        .table-container{
            height: 200px;
            overflow: scroll;
        }

        tr.row_selectedYellowish td{background-color:#91ff00 !important;}


    </style>
</head>
<body style="font-family: Sans-serif">
<p style="color:red;font-weight: 900">Press Ctrl+P to print</p>
<h2>Items Marked Out Of Stock Report </h2>

<input type="text"  id="deliverydate" value="{{$date}}"><button class="btn-primary" id="searchdeliverydate">Search</button>
<div class="table-container" style="height:100%">
    <div >
        <table id="orderheaders" class="table">
            <thead>
            <tr>
                <th>Description</th>
                <th>Qty Picked</th>
                <th>Picker Name</th>
                <th>Route</th>
                <th>OrderType</th>
                <th>StoreName</th>
                <th>DeliveryDate</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<?php
echo (new \DateTime())->format('Y-m-d H:i:s');
?>

<script type="text/javascript" charset="utf-8">


    $(document).ready(function() {
        $('#authRemoteOrder').hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        retreiveorders();

        $("#searchdeliverydate").click(function(){
            retreiveorders();
        });
    });

    function retreiveorders()
    {

        $.ajax({
            url: '{!!url("/itemsOutOfStockBeforePicking")!!}',
            type: "GET",
            data: {
                deldate:$('#deliverydate').val()
            },
            success: function (data) {
                var trHTML = '';
                $('.fast_removeOrders').empty();
                $.each(data, function (key, value) {
                    trHTML += '<tr role="row" class="fast_removeOrders"  style="font-size: 13px;color:black"><td>' +
                        value.strPastelDescription + '</td><td>' +
                        value.decQtyPicked + '</td><td>' +
                        value.strPickerName + '</td><td>'+  value.Route +
                        '</td><td>' +
                        value.OrderType + '</td><td>' +
                        value.StoreName + '</td><td>' +
                        value.DeliveryDate + '</td>' +
                        '</tr>';
                });
                $('#orderheaders').append(trHTML);

                $('#orderheaders tbody').on('click', 'tr', function (e){
                    $("#orderheaders tbody tr").removeClass('row_selectedYellowish');
                    $(this).addClass('row_selectedYellowish');
                });

                /*$('input[type="checkbox"]').on('change', function() {
                    $(this).siblings('input[type="checkbox"]').not(this).prop('checked', false);
                });*/
            }
        });

    }
    function getBooleanValue(cssSelector) {
        return document.querySelector(cssSelector).checked === true;
    }

    function numberParser(params) {
        var newValue = params.newValue;
        var valueAsNumber;
        if (newValue === null || newValue === undefined || newValue === '') {
            valueAsNumber = null;
        } else {
            valueAsNumber = parseFloat(params.newValue);
        }
        return valueAsNumber;
    }

    $(document).on('dblclick', 'tr', function(e) {
        var rowOnOrder =  $(this).closest("tr");
        var routingids = rowOnOrder.find('td:eq(0)').text();
        window.open('{!!url("/creditRequisitionByRoutingId")!!}/'+routingids, routingids, "location=1,status=1,scrollbars=1, width=1200,height=850");
    });
</script>
</body>
</html>