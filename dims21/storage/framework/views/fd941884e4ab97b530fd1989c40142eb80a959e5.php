<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <!-- DevExtreme theme -->
        <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.3/css/dx.light.css">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>

        <style>
            .dx-datagrid {
                font: 10px verdana;
                /* height: calc(100vh - 63px);
                max-height: calc(100vh - 63px); */
            }
        </style>

    </head>
    <body style="font-family: Sans-serif">
        <div class="col-12 p-3">
            <legend class="well-legend">Clocking Report</legend>

            <div class="row align-items-center mt-1">
                <div class="col-2">
                    <label for="dateFrom" class="col-form-label">Date From</label>
                </div>
                <div class="col-2">
                    <input type="date" id="dateFrom" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <span id="clocktimeHelp" class="form-text">
                        Select a report date from
                    </span>
                </div>
            </div>

            <div class="row align-items-center mt-1">
                <div class="col-2">
                    <label for="dateTo" class="col-form-label">Date To</label>
                </div>
                <div class="col-2">
                    <input type="date" id="dateTo" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <span id="clocktimeHelp" class="form-text">
                        Select a report date to
                    </span>
                </div>
            </div>

            <div class="row align-items-center mt-1">
                <div class="col-1">
                    <button type="button" id="getData" class="btn btn-success btn-sm w-100">Submit</button>
                </div>
            </div>

            <div id="gridContainer"></div>

        </div>
        
    </body>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Excel Saver -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>

    <!-- File Saver -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- DevExtreme library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/devextreme/22.2.3/js/dx.all.js"></script>
	
	<script>
		$(document).on('focus', ':input', function() {
			$(this).attr('autocomplete', 'off');
		});
		var clickTimer, lastRowClickedId;
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

            var dateFrom = (new Date()).toISOString().slice(0, 10);
            var dateTo = (new Date()).toISOString().slice(0, 10);
            $('#dateFrom').val(dateFrom);
            $('#dateTo').val(dateTo);

            $("#getData").click(function(){
                $.ajax({
                    url: '<?php echo url("/getUserLoggingReport"); ?>',
                    type: "GET",
                    data: {
                        dateFrom: $('#dateFrom').val(),
                        dateTo: $('#dateTo').val(),
                    },
                    success: function(data) {
                        var data = data;
                        updateGrid(data)
                    }
                });
            });

            $("#getData").click();
		});

        function updateGrid(data){
            $("#gridContainer").dxDataGrid({
                dataSource: data, //as json
                hoverStateEnabled: true,
                showBorders: true,
                filterRow: { visible: true },
                filterPanel: { visible: true },
                headerFilter: { visible: true },
                allowColumnResizing: true,
                columnAutoWidth: true,
                scrolling: {
                    rowRenderingMode: 'infinite',
                },
                paging:{
                    pageSize: 10,
                },
                pager: {
                    visible: true,
                    allowedPageSizes: [10, 20, 50, 100, 200, 500],
                    showPageSizeSelector: true,
                    showInfo: true,
                    showNavigationButtons: true,
                },
                export: {
                    enabled: true
                },
                editing: {
                    mode: 'single',
                    allowUpdating: false,
                    allowEditing: false,
                    allowDeleting: false,
                },
                selection: {
                    mode: 'single',
                },
                onExporting(e) {
                    const workbook = new ExcelJS.Workbook();
                    const worksheet = workbook.addWorksheet('userReport');
                    var From = $('#dateFrom').val();
                    var To = $('#dateTo').val();

                    DevExpress.excelExporter.exportDataGrid({
                        component: e.component,
                        worksheet,
                        autoFilterEnabled: true,
                    }).then(() => {
                        workbook.xlsx.writeBuffer().then((buffer) => {
                            saveAs(new Blob([buffer], { type: 'application/octet-stream' }), From+' - '+To+' User Clocking Report.xlsx');
                        });
                    });
                    e.cancel = true;
                },

				columns: [{
                        dataField: "strUserName",
                        caption: "Username",
                    }, {
                        dataField: "DayRecorded",
                        caption: "Date"
                    }, {
                        dataField: "ClockedHours",
                        caption: "Clocked Hours",
                        dataType: "datetime",
                        format: "HH:mm:ss"
                    },
                    {
                        dataField: "TotalHours",
                        caption: "Worked Hours",
                        dataType: "datetime",
                        format: "HH:mm:ss"
                    },{
                        dataField: "TotalHoursForRange",
                        caption: "Total Hours For Date Range",
                    },
                ],
				onRowUpdating: function(e) {

				},
				onRowRemoving: function(e) {

				},
			});
        }
	</script>

</html>

<?php /**PATH C:\wamp64\www\smdfmerchieadmin\dims21\resources\views/merchie/userLoggingReport.blade.php ENDPATH**/ ?>