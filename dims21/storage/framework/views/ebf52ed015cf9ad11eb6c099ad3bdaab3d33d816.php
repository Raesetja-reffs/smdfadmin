<!DOCTYPE html>
<html>
    <head>
        <script src="<?php echo e(asset('js/jquery-2.2.3.min.js')); ?>"></script>
        <link href="<?php echo e(asset('css/jquery.flexdatalist.min.css')); ?>" rel="stylesheet" type='text/css'>
        <script src="<?php echo e(asset('js/jquery.flexdatalist.min.js')); ?>"></script>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>

        <!-- DevExtreme themes -->
        <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.common.css">
        <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/20.1.7/css/dx.light.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.4.0/polyfill.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
        <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui2.min.css')); ?>" type="text/css" />
        <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script>
        <!-- DevExtreme library -->
        <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/20.1.7/js/dx.all.js"></script>
        <!-- datetimepicker plugin -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
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
            <legend class="well-legend">Clock In/Out</legend>
            <div class="row align-items-center mt-1">
                <div class="col-2">
                    <label for="inputMerchCode" class="col-form-label">Merchandiser Code</label>
                </div>
                <div class="col-2">
                    <input type="text" id="inputMerchCode" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <span id="inputMerchCodeHelp" class="form-text">
                        Select a merchandiser
                    </span>
                </div>
            </div>
            <div class="row align-items-center mt-1">
                <div class="col-2">
                    <label for="clockType" class="col-form-label">Clocking Type</label>
                </div>
                <div class="col-2">
                    <select type="text" class="form-select form-select-sm" id="clockType">
                        <option></option>
                        <option value="IN">IN</option>
                        <option value="OUT">OUT</option>
                    </select>
                </div>
                <div class="col-auto">
                    <span id="clockTypeHelp" class="form-text">
                        Select a clocking Type
                    </span>
                </div>
            </div>
            <div class="row align-items-center mt-1">
                <div class="col-2">
                    <label for="clocktime" class="col-form-label">Clocking Time</label>
                </div>
                <div class="col-2">
                    <input type="text" id="clocktime" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <span id="clocktimeHelp" class="form-text">
                        Select a clocking time
                    </span>
                </div>
            </div>

            <div class="row align-items-center mt-1">
                <div class="col-1">
                    <button type="button" id="submitParams" class="btn btn-success btn-sm w-100">Submit</button>
                </div>
                <div class="col-1">
                    <button type="button" id="getReport" class="btn btn-primary btn-sm w-100" onclick="window.location.href='<?php echo url("/userLoggingReport"); ?>'">Clocking Report</button>

                </div>
            </div>

            <div id="gridContainer"></div>

            
        </div>

    </body>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	
	<script>
		var jArray = JSON.stringify(<?php echo json_encode($clockinout); ?>);
		var jArrayMerchieCodes = JSON.stringify(<?php echo json_encode($merchiecodes); ?>);
		var clockin = $.map(JSON.parse(jArray), function(item) {
			return {
				intClockInOutID: item.intClockInOutID,
				strUserName: item.strUserName,
				strType: item.strType,
				dteSaved: item.dteSaved,
				strCoordinates: item.strCoordinates
			}
		});
		var MerchieCode = $.map(JSON.parse(jArrayMerchieCodes), function(item) {
			return {
				MerchieCode: item.merchiecode
			}
		});
		var MerchieCodeInput = $('#inputMerchCode').flexdatalist({
			minLength: 1,
			valueProperty: '*',
			selectionRequired: true,
			searchContain: true,
			focusFirstResult: true,
			visibleProperties: ["MerchieCode"],
			searchIn: 'MerchieCode',
			data: MerchieCode
		});
		MerchieCodeInput.on('select:flexdatalist', function(event, data) {
			$('#inputMerchCode').val(data.MerchieCode);
		});
		$('#clocktime').datetimepicker({
			// options here
		});
		$(document).on('focus', ':input', function() {
			$(this).attr('autocomplete', 'off');
		});
		var clickTimer, lastRowClickedId;
		$(document).ready(function() {

			$('#submitParams').click(function() {
				var User = $('#inputMerchCode').val();
				var Type = $('#clockType').val();
				var Time = $('#clocktime').val();
				//console.log(User);
				//console.log(Type);
				//console.log(Time);
				$.ajax({
					url: '<?php echo url("/insertClockInOutRecord"); ?>',
					type: "POST",
					data: {
						User: User,
						Type: Type,
						Time: Time,
					},
					success: function(data) {
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
                dataSource:clockin, //as json
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
                    allowUpdating: true,
                    allowEditing: true,
                    allowDeleting: true,
                },
                selection: {
                    mode: 'single',
                },
                onExporting: function(e) {
                    // Create a dialog box with a date range picker
                    var $dialog = $("<div>").html("Export data between");
                    var $startDate = $("<input>").datepicker({dateFormat: "yy-mm-dd"});
                    var $endDate = $("<input>").datepicker({dateFormat: "yy-mm-dd"});
                    $dialog.append("<br><br><label for='start-date'>Start date:</label>");
                    $dialog.append("<br>").append($startDate).append("<br>");
                    $dialog.append("<label for='end-date'>End date:</label>");
                    $dialog.append("<br>").append($endDate);
                    $dialog.dialog({
                        modal: true,
                        buttons: {
                            "Export": function() {
                                // Get the selected start and end dates from the date picker
                                var startDate = $startDate.datepicker("getDate");
                                var endDate = $endDate.datepicker("getDate");

                                // Filter the data to include only rows where dteSaved is between the start and end dates
                                var filteredData = e.component.getDataSource().filter(function(row) {
                                    var date = new Date(row.dteSaved);
                                    return date >= startDate && date <= endDate;
                                });

                                // Create an Excel workbook and worksheet
                                var workbook = new ExcelJS.Workbook();
                                var worksheet = workbook.addWorksheet('clockinout');

                                // Export the filtered data to the worksheet
                                DevExpress.excelExporter.exportDataGrid({
                                    component: e.component,
                                    worksheet: worksheet,
                                    autoFilterEnabled: true,
                                    rows: filteredData
                                }).then(function() {
                                    // Save the workbook as an Excel file and download it
                                    workbook.xlsx.writeBuffer().then(function(buffer) {
                                        saveAs(new Blob([buffer], {
                                            type: 'application/octet-stream'
                                        }), 'clockinout.xlsx');
                                    });
                                });

                                // Cancel the default export behavior
                                e.cancel = true;

                                // Close the dialog box
                                $(this).dialog("close");
                            },
                            "Cancel": function() {
                                $(this).dialog("close");
                            }
                        }
                    });

                    // Cancel the default export behavior
                    e.cancel = true;
                },
				columns: [{
                        allowEditing: false,
                        dataField: "intClockInOutID",
                        caption: "ID"
                    }, {
                        allowEditing: false,
                        dataField: "strUserName",
                        caption: "Username",
                    }, {
                        allowEditing: false,
                        dataField: "strType",
                        caption: "Clocking IN/OUT"
                    }, {
                        dataField: "dteSaved",
                        caption: "Time of clocking IN/OUT",
                        dataType: "datetime",
                        format: "yyy-MM-dd HH:mm:ss"
                    }, {
                        allowEditing: false,
                        dataField: "strCoordinates",
                        caption: "Coordinates"
                    }, 
                ],
				onRowUpdating: function(e) {
					var ID = e.oldData.intClockInOutID;
					var NewTime = e.newData.dteSaved;
					//console.debug(ID);
					//console.debug(NewTime);
					$.ajax({
						url: '<?php echo url("/updateClockInOutTime"); ?>',
						type: "POST",
						data: {
							ID: ID,
							NewTime: NewTime,
						},
						success: function(data) {
							location.reload();
						}
					});
				},
				onRowRemoving: function(e) {
					// console.debug(e);
					var ID = e.data.intClockInOutID;
					//console.debug(ID);
					$.ajax({
						url: '<?php echo url("/deleteClockInOutRecord"); ?>',
						type: "POST",
						data: {
							ID: ID,
						},
						success: function(data) {
							location.reload();
						}
					});
				},
			});

		});
	</script>

</html>

<?php /**PATH C:\wamp64\www\smdfmerchieadmin\dims21\resources\views/merchie/clockinout.blade.php ENDPATH**/ ?>