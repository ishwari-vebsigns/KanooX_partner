@extends('layouts.admin-app')
@section('content')

<style>
    .custom-width {
        width: 200px; /* Adjust the width as needed */
    }
</style>
   
<link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Custom Stylesheet -->
<link href="{{$base_url}}/css/style.css" rel="stylesheet">

<!-- Daterange picker -->
<link href="{{$base_url}}/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- Clockpicker -->
<link href="{{$base_url}}/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
<!-- asColorpicker -->
<link href="{{$base_url}}/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
<!-- Material color picker -->
<link href="{{$base_url}}/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- Pick date -->
<link rel="stylesheet" href="{{$base_url}}/vendor/pickadate/themes/default.css">
<link rel="stylesheet" href="{{$base_url}}/vendor/pickadate/themes/default.date.css">




    
    <!--**********************************
        Main wrapper start
    ***********************************-->
   

        <!--**********************************
            Nav header start
        ***********************************-->
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
      
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reports</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Loan Report</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                 <h4 class="card-title">Customer Loan Report</h4>
                 @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3)
                 <div class="form-group row justify-center">
                    
                    
                    <div class="col-lg-4">
                        <select class="form-control" id="agent_id" name="id" value="{{ old('id') }}" required>
                            <option value="">Please select Agent</option>
                            @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ old('id') == $agent->id ? 'selected' : '' }}>{{$agent->name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="col-lg-4">
                        <div class="input-group">
                            <input id="datereportrange" class="form-control input-daterange-datepicker custom-width" type="text" name="daterange">
                            {{-- <div class="input-group-append">
                                <button id="search" class="btn btn-primary" type="submit">Submit</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">
                            {{-- <input id="datereportrange" class="form-control input-daterange-datepicker custom-width" type="text" name="daterange"> --}}
                            {{-- <div class="input-group-append"> --}}
                                <button id="search" class="btn btn-primary" type="submit">Submit</button>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
                @else
                <div class="form-group row">
                    <div class="input-group mb-3">
                        <input id="datereportrange" class="form-control input-daterange-datepicker" type="text" name="daterange">
                        <div class="input-group-append">
                            <button id="search" class="btn btn-primary" type="submit">submit</button>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="justify-end">
                @if($my_permissions->contains('DOWNLOAD'))
                <button class="btn btn-primary" id="downloadButton">Download</button>
               @endif
               @if($my_permissions->contains('IMPORT'))
               <a href="{{$base_url}}/admin/report/import/file-loan-import" style="color:white;" class="btn btn-secondary">Import</a>
               @endif
               
               <a href="{{ url('admin/report/auto-import') }}" class="btn btn-success">
                Auto Import
            </a>
            
            </div>
            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Bank Name</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Loan Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                          
                                           
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--<link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">-->
        <!--<script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <!--<script>-->
    <!--  $( document ).ready(function() {-->
    <!--    @if(session('success'))-->
    <!--    toastr.success("{{Session::get('success')}}", "Success!", {-->
    <!--                    timeOut: 5e3,-->
    <!--                    closeButton: !0,-->
    <!--                    debug: !1,-->
    <!--                    newestOnTop: !0,-->
    <!--                    progressBar: !0,-->
    <!--                    positionClass: "toast-top-right",-->
    <!--                    preventDuplicates: !0,-->
    <!--                    onclick: null,-->
    <!--                    showDuration: "300",-->
    <!--                    hideDuration: "1000",-->
    <!--                    extendedTimeOut: "1000",-->
    <!--                    showEasing: "swing",-->
    <!--                    hideEasing: "linear",-->
    <!--                    showMethod: "fadeIn",-->
    <!--                    hideMethod: "fadeOut",-->
    <!--                    tapToDismiss: !1-->
    <!--                })-->
    <!--    @endif   -->
    <!--    @php-->
    <!--    session()->forget('success');-->
    <!--    @endphp-->
    <!--});-->
    <!--</script>-->
    <script>
$(document).ready(function() {

    @if(session('success'))
        toastr.success("{{ session('success') }}", "Success", {
            timeOut: 4000,
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right"
        });
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}", "Error", {
            timeOut: 4000,
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right"
        });
    @endif

});
</script>
 <script>
    $(document).ready(function() {
    isDownloaded = false;
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#datereportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#datereportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    function SaleByProductData(){
        var startDate = $('#datereportrange').data('daterangepicker').startDate._d;
			var endDate = $('#datereportrange').data('daterangepicker').endDate._d;
			var date_from=moment(startDate).format("YYYY-MM-DD");
			var date_to=moment(endDate).format("YYYY-MM-DD");
            @if(Auth::user()->role_id != 2 && Auth::user()->role_id != 3)
            var agentId = document.getElementById("agent_id").value;
            @endif

    var table = $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[0, "desc"]],
        columns: [
            { data: "loan_id" },
            // { data: "bank.bank_name" },
            {
    data: "bank",
    render: function (data, type, row) {
        if (data && data.bank_name) {
            return data.bank_name;
        }
        return '-';
    }
},

            { data: "email" },
            { data: "full_name" },
            { data: "mobile" },
            {
                data: "loan_amount",
                render: function(data, type, row) {
                    if(data==null){
                        return '-' ;
                    }
                    else{
                    return '₹' + data;
                }
                }
            },
            {
                data: "status_id",
                render: function(data, type, row) {
                    if (data === null) {
                        return '<span class="badge badge-primary">Document Pending</span>';
                    } else if (data === 1) {
                        return '<span class="badge badge-success">Approved</span>';
                    } else if (data === 2) {
                        return '<span class="badge badge-danger">Rejected</span>';
                    } else if (data === 3) {
                        return '<span class="badge badge-info">Disbursed</span>';
                    } else if (data === 5) {
                        return '<span class="badge badge-warning">Document Uploaded</span>';
                    } else {
                        return '<span class="badge badge-primary">Pending</span>';
                    }
                }
            },
            {
                data: null,
                sortable: false,
                filter: false,
                render: function(data, type, row) {
                   
                    return '<a type="button" href="customer-report/' + data.loan_id + '" class="btn btn-dark">Details</a>';

                }
            },
            
        ]
    });
           
      // Fetch data using AJAX
			console.log("nisarg"+date_from, date_to);
    @if(Auth::user()->role_id!=2 && Auth::user()->role_id!=3)
    $.ajax({
        url: '{{$base_url}}/admin/report/customer-reports/alldata?agent_id='+agentId+'&date_from='+date_from+"&date_to="+date_to,
        method: 'GET',
        success: function(response) {
            var newData = response.data;
            table.rows.add(newData).draw();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
    @else
    $.ajax({
        url: '{{$base_url}}/admin/report/customer-reports/alldata?date_from='+date_from+"&date_to="+date_to,
        method: 'GET',
        success: function(response) {
            var newData = response.data;
            table.rows.add(newData).draw();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
    @endif
    // Convert table data to Excel format
    function convertToExcel() {
            var workbook = XLSX.utils.table_to_book(document.getElementById('example'), { sheet: 'Sheet 1' });
            var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
            return excelData;
        }
        function downloadExcel() {
              var currentPage = table.page.info().page + 1;

              if (!isDownloaded) {
                isDownloaded = true;

                var excelData = convertToExcel();
                var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                console.log(currentPage);
                a.download = 'loan-report' + currentPage + '.xlsx';
                a.click();
                URL.revokeObjectURL(url);

                setTimeout(function() {
                  isDownloaded = false;
                }, 100);
              }
            }
            // Attach event listener to download button
            $(document).on('click', '#downloadButton', downloadExcel);
        }

    SaleByProductData();
    $("#search").click(function(){
        // alert("hi");
            isDownloaded = false;
			dataTable=$("#example").DataTable();
			dataTable.clear();
			dataTable.destroy();
			SaleByProductData();
		});

		$(".export-button").click(function(){
			var startDate = $('#datereportrange').data('daterangepicker').startDate._d;
			var endDate = $('#datereportrange').data('daterangepicker').endDate._d;
			var date_from=moment(startDate).format("YYYY-MM-DD");
			var date_to=moment(endDate).format("YYYY-MM-DD");
			

			$("#export-form").attr('action', "{{$base_url}}/admin/report/customer-reports/alldata?date_from="+date_from+"&date_to="+date_to);
			$("#export-form").submit();
		});
});
SaleByProductData();
 </script>
    
    
    <!-- Required vendors -->
     <!--<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>-->
    
     <!--   <script src="{{$base_url}}/vendor/moment/moment.min.js"></script>-->
     <!--   <script src="{{$base_url}}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>-->
        <!-- clockpicker -->
     <!--   <script src="{{$base_url}}/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>-->
        <!-- asColorPicker -->
     <!--   <script src="{{$base_url}}/vendor/jquery-asColor/jquery-asColor.min.js"></script>-->
     <!--   <script src="{{$base_url}}/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>-->
     <!--   <script src="{{$base_url}}/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>-->
        <!-- Material color picker -->
     <!--   <script src="{{$base_url}}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>-->
        <!-- pickdate -->
     <!--   <script src="{{$base_url}}/vendor/pickadate/picker.js"></script>-->
     <!--   <script src="{{$base_url}}/vendor/pickadate/picker.time.js"></script>-->
     <!--   <script src="{{$base_url}}/vendor/pickadate/picker.date.js"></script>-->
    
    
    
        <!-- Daterangepicker -->
     <!--   <script src="{{$base_url}}/js/plugins-init/bs-daterange-picker-init.js"></script>-->
        <!-- Clockpicker init -->
     <!--   <script src="{{$base_url}}/js/plugins-init/clock-picker-init.js"></script>-->
        <!-- asColorPicker init -->
     <!--   <script src="{{$base_url}}/js/plugins-init/jquery-asColorPicker.init.js"></script>-->
        <!-- Material color picker init -->
     <!--   <script src="{{$base_url}}/js/plugins-init/material-date-picker-init.js"></script>-->
        <!-- Pickdate -->
     <!--   <script src="{{$base_url}}/js/plugins-init/pickadate-init.js"></script>-->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Moment -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<!-- Date Range Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<!-- Export libs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>



@endsection