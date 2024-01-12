<!doctype html>
<html lang="en">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
        <!--meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"-->
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
		<title>Specials</title>
		<link rel="icon" href="{{asset('images/logo.png')}}" type="image/icon type">
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
        <!-- DevExtreme theme -->
        {{-- <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.3/css/dx.light.css"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.carmine.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.contrast.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.dark.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.darkmoon.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.darkviolet.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.greenmist.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.light.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.blue.dark.css" rel="stylesheet"> --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.blue.light.css" rel="stylesheet">
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.lime.dark.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.lime.light.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.orange.dark.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.orange.light.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.purple.dark.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.purple.light.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.teal.dark.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.material.teal.light.css" rel="stylesheet"> --}}
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/css/dx.softblue.css" rel="stylesheet"> --}}


	</head>
	<body>
		{{-- @include('header')


        @include('nav') --}}

        <div class="col-md-12 ms-sm-auto col-lg-12" style="padding:0px !important; height:95vh;">
            <header style="height:7%;" class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 pr-3 shadow">
                <h1 id="stats" style="padding: 10px;">SPECIALS HEADERS</h1><br>
            </header>

            <div id="specialsheader" style="width: 100% !important; height:43%;">
            </div>

            <header style="height:7%;" id="specialslinesheader" class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0 pr-3 shadow">
                <h1 style="padding: 10px;">SPECIALS LINES</h1>  
            </header>

            <div id="specialslines" style="width: 100% !important; height:43%;">
            </div>

		</div>

	</body>
</html>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<!-- DevExtreme library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/js/dx.all.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('focus', ':input', function() {
        $(this).attr('autocomplete', 'off');
    });
	
    $(document).ready(function() {     
        $('#specialslinesheader').hide();
        specialsFunction();
	});
    function specialsFunction(){
        $.ajax({
            url: '{!!url("/getSpecialsHeaders")!!}',
            type: "GET",
            data: {

            },
            success: function (data) {
                //console.debug(data);
                
                $("#specialsheader").dxDataGrid({
                    dataSource:data, //as json
                    showBorders: true,
                    hoverStateEnabled: true,
                    filterRow: { visible: true },
                    filterPanel: { visible: true },
                    headerFilter: { visible: true },
                    allowColumnResizing: true,
                    columnAutoWidth: true,
                    noDataText: 'No Specials Headers Found',
                    scrolling: {
                        mode: 'infinite',
                    },
                    paging:{
                        pageSize: 20,
                    },
                    editing:{
                        mode: 'form',
                        // allowUpdating: true,
                        // allowAdding: true,
                        //allowDeleting: true,
                        //useIcons: true,
                    },
                    selection: {
                        mode: 'single',
                    },
                    columns: [
                        {
                            dataField: "SpecialHeaderId",
                            caption: "ID",
                            visible: false,
                        }, 
                        {
                            dataField: "CustomerId",
                            caption: "Customer ID",
                        },{
                            dataField: "CustomerPastelCode",
                            caption: "Customer Code",
                        },
                        {
                            dataField: "StoreName",
                            caption: "Store Name",
                        }, 
                        {
                            dataField: "DateFrom",
                            caption: "From",
                            dataType: "date",
                            format: 'dd-MM-yyyy',
                        }, 
                        {
                            dataField: "DateTo",
                            caption: "To",
                            dataType: "date",
                            format: 'dd-MM-yyyy',
                        },
                        {
                            dataField: "SalesRep",
                            caption: "Sales Rep",
                        },
                        {
                            dataField: "isDealtWith",
                            caption: "DealtWith",
                            visible: false,
                        },
                        {
                            dataField: "strSpecialNotes",
                            caption: "Comment",
                        }, 
                    ],

                    onRowClick:function(e){
                        $('#specialslinesheader').show();
                        var headerID = e.data.SpecialHeaderId
                        $.ajax({
                            url: '{!!url("/getSpecialsLines")!!}',
                            type: "GET",
                            data: {
                                ID : headerID,
                            },
                            success: function (data) {
                                //console.debug(data);
                                
                                const orderlines = $("#specialslines").dxDataGrid({
                                    dataSource:data, //as json
                                    showBorders: true,
                                    hoverStateEnabled: true,
                                    filterRow: { visible: true },
                                    filterPanel: { visible: true },
                                    headerFilter: { visible: true },
                                    allowColumnResizing: true,
                                    columnAutoWidth: true,
                                    scrolling: {
                                        mode: 'infinite',
                                    },
                                    paging:{
                                        pageSize: 20,
                                    },editing: {
                                        mode: 'row',
                                        //allowUpdating: true,
                                        // allowAdding: true,
                                        //allowDeleting: true,
                                        //useIcons: true,
                                    },
                                    selection: {
                                        mode: 'single',
                                    },
                                    export: {
                                        enabled: true
                                    },
                                    onExporting(e) {
                                        const workbook = new ExcelJS.Workbook();
                                        const worksheet = workbook.addWorksheet('specials');

                                        DevExpress.excelExporter.exportDataGrid({
                                            component: e.component,
                                            worksheet,
                                            autoFilterEnabled: true,
                                        }).then(() => {
                                            workbook.xlsx.writeBuffer().then((buffer) => {
                                                saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'specials.xlsx');
                                            });
                                        });

                                        e.cancel = true;

                                        $.ajax({
                                            url: '{!!url("/exportToExcel")!!}',
                                            type: "GET",
                                            data: {
                                                ID : headerID,
                                            },
                                            success: function (data) {
                                                alert("successfully exported");
												location.reload();
                                            }
                                        });
                                    },
                                    columns: [
                                        {
                                            dataField: "placeholder",
                                            caption: "placeholder",
                                        },
										{
                                            dataField: "strSpecialNotes",
                                            caption: "comment",
                                        },{
                                            dataField: "strContactType",
                                            caption: "Type",
                                        }, {
                                            dataField: "customerbuyer",
                                            caption: "Buyer",
                                        },  {
                                            dataField: "DateTo",
                                            caption: "To",
                                            dataType: "date",
                                            format: 'yyyy-MM-dd',
                                        }, {
                                            dataField: "Price",
                                            caption: "Price",
                                        }, {
                                            dataField: "UnitSize",
                                            caption: "Unit Size",
                                        }, {
                                            dataField: "PriceMethod",
                                            caption: "Price Method",
                                        }, {
                                            dataField: "DateFrom",
                                            caption: "From",
                                            dataType: "date",
                                            format: 'yyyy-MM-dd',
                                        },  {
                                            dataField: "stockCode",
                                            caption: "Stock Code",
                                        },{
                                            dataField: "stockName",
                                            caption: "Stock Name",
                                        }, {
                                            dataField: "CustomerSpecial",
                                            caption: "Customer Special",
                                        },{
                                            dataField: "ErrorDescription",
                                            caption: "Error Description",
                                        }, 
                                    ],
                                });
                            }
                        });
                    },
                });
            }
        });
    };
</script>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }

</script>
