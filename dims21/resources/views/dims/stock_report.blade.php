@extends('layouts.app')

@section('content')



    <div class="col-lg-12" >
        <div class="form-group  col-md-2"  style="-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
             -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
             box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);background: mediumpurple;height: 300px;overflow-y: scroll;font-size: 10px !important">
            <h5>Choose Department</h5>
            @foreach($cats as $value)
                <label class="containercheckbox">{{$value->strDepartment}}
                    <input type="checkbox" name="departmentID[]" class="routescheckd" value="{{$value->departmentID}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
            <button class="btn-md btn-success" id="dept">Submit</button>
        </div>
        <div class="form-group  col-md-2"  style="-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
            box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);background: mediumpurple;height: 300px;overflow-y: scroll;font-size: 10px !important">
            <h5>Choose Picking Team</h5>
            @foreach($cats as $value)
                <label class="containercheckbox">{{$value->strDepartment}}
                    <input type="checkbox" name="teamsids[]" class="routescheckd" value="{{$value->departmentID}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
            <button class="btn-md btn-success" id="teamsbtn">Submit Team</button>
        </div>
        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;background: white;">
            <h5>Choose Category</h5>
            @foreach($prodCats as $value)
                <label class="containercheckbox">{{$value->Category}}
                    <input type="checkbox" name="binloc[]"  class="routescheckd" value="{{$value->MainCatId}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
            <button class="btn-md btn-success" id="binsbtn">Submit Category Info</button>
        </div>
        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
            <h5>Choose Status of Products</h5>
            <div id="productlastselection">

                <select id="actpriducts" class="actpriducts">
                    <option value="include">Active Products with 0 onHand</option>
                    <option value="exclude">Active Products Excluding 0 </option>
                </select>

            </div>

            <button class="btn-md btn-success" id="produclastsbtn">Submit Status And Get Data</button>
        </div>
        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">
            <h5>Sales Quantity Date</h5>
            <div class="form-group">
                <label class="control-label" for="datefrom"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">FROM</label>
                <input type="text" class="form-control input-sm "  id="datefrom" >
            </div>
            <div class="form-group">
                <label class="control-label" for="dateto"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">TO</label>
                <input type="text" class="form-control input-sm "  id="dateto" >
            </div>


        </div>

        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">

        </div>
        <div class="form-group  col-md-2"  style="margin-bottom: 0px;font-weight: 700;font-size: 11px;">

        </div>
        <div class="form-group  col-md-12" id="testi">
            <table class="table2 table-bordered " id="gridstock" style="overflow-y: auto;width:100%;color: black;    font-weight: 700;" tabindex=0>
                <thead>
                <tr>
                    <th >PastelCode</th><th >PastelDescription</th><th>Item Unit</th><th >Instock</th><th>Available</th><th>On Orders</th><th>Count</th><th>Sales Qty</th><th>Cost</th><th>Binnumber/Team</th></tr></thead>
                <tfoot>
                <tr>
                    <th >PastelCode</th><th >PastelDescription</th><th>Item Unit</th><th >Instock</th><th>Available</th><th>On Orders</th><th>Sales Qty</th><th>Cost</th><th>Binnumber/Team</th></tr>
                </tfoot>

            </table>
        </div>
    </div>

@endsection
<style>
#pg_vwInStockQty_pager1{
    height: 51px;
}
</style>
<?php $data = ''; ?>
<script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
<script>
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
    $(document).ready(function() {
        $("#delvDate").datepicker({
            changeMonth: true,//this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            dateFormat: 'dd-mm-yy'
        });
        $("#datefrom").datepicker({
            changeMonth: true,//this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            dateFormat: 'dd-mm-yy'
        });
        $("#dateto").datepicker({
            changeMonth: true,//this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            dateFormat: 'dd-mm-yy'
        });
        $('#popUpIndividualBulk').hide();
        $('#popUpBatchBulk').hide();
        $('#orderListing').hide();
        $('#pricing').hide();
        $('#pricingOnCustomer').hide();
        $('#callList').hide();
        $('#tabletLoadingApp').hide();
        $('#copyOrdersBtn').hide();
        $('#salesOnOrder').hide();
        $('#salesInvoiced').hide();
        $('#posCashUp').hide();
        $('#teamsbtn').hide();
        $('#binsbtn').hide();
        $('#produclastsbtn').hide();
        $('#productlastselection').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //dept
        $('#dept').click(function() {
            $('#teamsbtn').show();


            var searchIDs = $("input[name='departmentID[]']:checked").map(function () {
                return $(this).val();
            }).get();
            $.ajax({
                url: '{!!url("/getPickingTeamsByDept")!!}',
                type: "POST",
                data: {
                    deptids: searchIDs,
                },
                success: function (data) {

                    console.debug(data);
                    $('#teams').empty();
                    var trHTML = '';
                    $.each(data, function (key, value) {
                        trHTML += '<input type="checkbox" name="teamsids[]"  class=" class="routescheckd" value="'+value.PickingTeamId+'">'+value.PickingTeam+'<br>';
                    });
                    $('#teams').append(trHTML)
                }
            });
        });

        $('#teamsbtn').click(function() {
            $('#binsbtn').show();
            //$('#produclastsbtn').hide();
            var teamsIDs = $("input[name='teamsids[]']:checked").map(function () {
                return $(this).val();
            }).get();
            $.ajax({
                url: '{!!url("/getBinLocationByPickingTimes")!!}',
                type: "POST",
                data: {
                    teams: teamsIDs,
                },
                success: function (data) {

                    console.debug(data);
                    $('#binns').empty();
                    var trHTML = '';
                    $.each(data, function (key, value) {
                        trHTML += '<label class="containercheckbox">'+value.Binnumber+'<input type="checkbox" name="binloc[]"  class=" class="routescheckd" value="'+value.Binnumber+'"><span class="checkmark"></span></label>';
                    });
                    $('#binns').append(trHTML)
                }
            });
        });

        $('#binsbtn').click(function(){
            $('#productlastselection').show();
            $('#produclastsbtn').show();
        });

        $('#produclastsbtn').click(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var teamsIDs = $("input[name='teamsids[]']:checked").map(function () {
                return $(this).val();
            }).get();

            console.debug(teamsIDs);
            var bin = $("input[name='binloc[]']:checked").map(function () {
                return $(this).val();
            }).get();
            otable = $('#gridstock').DataTable({
                "ajax": {
                    url: '{!!url("/gridResult")!!}', "type": "POST", data: function (data) {
                        data.teams = teamsIDs;
                        data.bin= bin;
                        data.actpriducts = $('#actpriducts').val();
                        data.datefrom = $('#datefrom').val();
                        data.dateto = $('#dateto').val();

                    }
                },
                "processing": false,
                "serverSide": false,
                "stateSave": false,
                "columns": [
                    {"data": "PastelCode", "class": "small", "bSortable": true},
                    {"data": "PastelDescription", "class": "small"},{"data": "UnitSize", "class": "small"},
                    {"data": "Instock", "class": "small"},
                    {"data": "Available", "class": "small"},
                    {"data": "Ordered", "class": "small"},
                    {"data": "counts", "class": "small"},
                    {"data": "saleQuantity", "class": "small"},
                    {"data": "Cost", "class": "small"},

                    {"data": "Binnumber", "class": "small"},

                ],
                "order": [[ 0, "desc" ]],
                "deferRender": true,
                "scrollY": "370px",
                "scrollCollapse": true,
                searching: true,
                bPaginate: false,
                bFilter: false,
                "LengthChange": true,
                "info": false,
                "ordering": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                "bDestroy": true
            });

        });

    });
</script>