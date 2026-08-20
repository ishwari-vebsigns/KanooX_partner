@extends('layouts.admin-app')
@section('content')


   
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
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Agent Report</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                 <h4 class="card-title">Agent Report</h4>
                 <div class="form-group row">
                    <div class="input-group mb-3">
                        <input id="datereportrange" class="form-control input-daterange-datepicker" type="text" name="daterange">
                        <div class="input-group-append">
                            <button id="search" class="btn btn-primary" type="submit">submit</button>
                        </div>
                    </div>
                </div>
                 <button class="btn btn-primary" id="downloadButton">Download</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Agent ID</th>
                                                <th>Agent Access Code</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Contact Number</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                <th>QR Code</th>


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
        <link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">
        <script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
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
    <script>
       $( document ).ready(function() {
        @if(session('success'))
        toastr.success("{{Session::get('success')}}", "Success!", {
                        timeOut: 5e3,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        positionClass: "toast-top-right",
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1
                    })
        @endif   
        @php
        session()->forget('success');
        @endphp
    });
    </script>
 <script>
    $(document).ready(function() {
    var isDownloaded = false; 
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#datereportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        if (start && end) {
        $('#downloadButton').prop('disabled', false);
        } else {
        $('#downloadButton').prop('disabled', true);
        }
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

    var table = $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [
            [0, 'desc']
        ],
        columns: [
            { data: "new_id" },
            { data: "agent_access_code" },
            { data: "email" },
            { data: "name" },
            { data: "contact_number" },
             {
                "mData": "created_at",
                "mRender": function(data, type, row) {
                var string=row.created_at;
                var date = new Date(string);
                return date.toLocaleString();
                }
            },
            // {
            //             data: "kyc_status",
            //             render: function(data, type, row) {
            //                 if (data === 1) {
            //                     return '<span class="badge badge-success">KYC Approved</span>';
            //                 } else if (data === 0) {
            //                     return '<span class="badge badge-danger">KYC Pending</span>';
                           
            //                 }
            //             }
            //         },
            {
    data: "kyc_status",
    render: function(data, type, row) {

        if (data == 1) {
            return '<span class="badge badge-success">KYC Approved</span>';
        } 
        else if (data == 0) {
            return '<span class="badge badge-warning">KYC Pending</span>';
        } 
        else if (data == 2) {
            return '<span class="badge badge-danger">KYC Rejected</span>';
        } 
        else {
            return '<span class="badge badge-secondary">Unknown</span>';
        }
    }
},
            // {
            //     data: "loan_amount",
            //     render: function(data, type, row) {
            //         return '₹' + data;
            //     }
            // },
           
            {
                data: null,
                sortable: false,
                filter: false,
                render: function(data, type, row) {
                    return '<a type="button" href="' + data.id + '" class="btn btn-dark">Details</a>';
                }
            },
            {
                data: null,
                sortable: false,
                filter: false,
                render: function(data, type, row) {
                    var url = "{{ route('generator', ':id') }}";
                    url = url.replace(':id', data.agent_access_code);
                    if(data.agent_qr==null){
                    return '<span class="badge badge-warning">Not Gernerated</span>';
                    }
                    if(data.agent_qr!=null){
                    return '<a href="' + url + '" type="button" class="btn btn-info">View</a>';
                    }
                }
            },
           
        ]
    });
    function fetchData() {
            $.ajax({
                url: '{{$base_url}}/admin/report/agent-report/alldata?date_from=' + date_from + "&date_to=" + date_to,
                method: 'GET',
                success: function(response) {
                    var newData = response.data;
                    table.clear().rows.add(newData).draw();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
       
    // Fetch data using AJAX
			console.log("nisarg"+date_from, date_to);

    $.ajax({
        url: '{{$base_url}}/admin/report/agent-report/alldata?date_from='+date_from+"&date_to="+date_to,
        method: 'GET',
        success: function(response) {
            var newData = response.data;
            table.rows.add(newData).draw();
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });

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
                a.download = 'agent-report' + currentPage + '.xlsx';
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
			

			$("#export-form").attr('action', "{{$base_url}}/admin/report/agent-report/alldata?date_from="+date_from+"&date_to="+date_to);
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