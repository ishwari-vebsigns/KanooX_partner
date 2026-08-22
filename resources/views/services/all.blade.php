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

<style>
.services-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.services-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.services-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.services-page .kx-title-icon {
    flex: 0 0 auto;
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: var(--kx-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--kx-primary-dark);
    font-size: 20px;
}

.services-page .kx-title-icon i {
    line-height: 1;
}

.services-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.services-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.services-page .kx-breadcrumb {
    margin: 0;
    padding: 8px 14px;
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    font-size: 13px;
    color: var(--kx-muted);
    align-self: center;
}

.services-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.services-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}
.services-page .dataTables_wrapper .dataTables_length,
.services-page .dataTables_wrapper .dataTables_filter {
    display: inline-flex;
    align-items: center;
    float: none !important;
    margin-bottom: 15px;
}

.services-page .dataTables_wrapper .dataTables_filter {
    margin-left: 25px;
}
/* ---------- Card ---------- */
.services-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.services-page .kx-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    padding: 22px 26px;
    border-bottom: 1px solid var(--kx-border);
}

.services-page .kx-card-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.services-page .kx-card-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.services-page .kx-card-title {
    margin: 0;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.services-page .kx-card-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

.services-page .kx-card-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.services-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 9px;
    border: 1px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
    line-height: 1.2;
}

.services-page .kx-btn:hover {
    transform: translateY(-1px);
}

.services-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.services-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.services-page .kx-btn-outline {
    background: #fff;
    border-color: var(--kx-primary);
    color: var(--kx-primary);
}

.services-page .kx-btn-outline:hover {
    background: var(--kx-primary);
    color: #fff;
    box-shadow: 0 8px 18px rgba(157, 56, 149, 0.22);
}

/* ---------- Table ---------- */
.services-page .kx-table-wrap {
    padding: 10px 26px 26px;
}

.services-page table.dataTable {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0;
}

.services-page table.dataTable thead th {
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    padding: 14px 16px !important;
    border-bottom: none !important;
    white-space: nowrap;
}

.services-page table.dataTable thead th:first-child { border-radius: 10px 0 0 10px; }
.services-page table.dataTable thead th:last-child { border-radius: 0 10px 10px 0; }

.services-page table.dataTable tbody td {
    padding: 16px !important;
    font-size: 13.5px;
    color: var(--kx-text);
    border-bottom: 1px solid var(--kx-border) !important;
    vertical-align: middle;
    background: #fff;
}

.services-page table.dataTable tbody tr {
    transition: background 0.15s ease;
}

.services-page table.dataTable tbody tr:hover td {
    background: #FCF6FC;
}

.services-page table.dataTable tbody tr:last-child td {
    border-bottom: none !important;
}

/* Service ID pill */
.services-page .kx-id-pill {
    display: inline-block;
    padding: 4px 12px;
    background: var(--kx-soft);
    color: var(--kx-primary-dark);
    border-radius: 999px;
    font-weight: 700;
    font-size: 12.5px;
}

/* Service name */
.services-page .kx-service-name {
    font-weight: 600;
    color: var(--kx-primary-dark);
    transition: color 0.2s ease;
}

.services-page tr:hover .kx-service-name {
    color: var(--kx-primary);
}

/* Service URL */
.services-page .kx-service-url {
    color: var(--kx-muted);
    font-size: 12.5px;
}

/* Updated at */
.services-page .kx-updated {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--kx-muted);
    font-size: 12.5px;
    white-space: nowrap;
}

.services-page .kx-updated i {
    color: var(--kx-primary);
    font-size: 13px;
}

/* Status pills */
.services-page .kx-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.services-page .kx-status .kx-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.services-page .kx-status-active {
    background: #EAF8EF;
    color: #238B45;
}
.services-page .kx-status-active .kx-dot { background: #238B45; }

.services-page .kx-status-inactive {
    background: #FDECEC;
    color: #D64545;
}
.services-page .kx-status-inactive .kx-dot { background: #D64545; }

/* Details button */
.services-page .kx-btn-details {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    font-size: 12.5px;
    font-weight: 600;
    border-radius: 8px;
    background: var(--kx-page-bg);
    color: var(--kx-primary-dark);
    border: 1px solid var(--kx-soft);
    text-decoration: none;
    transition: all 0.2s ease;
}

.services-page .kx-btn-details:hover {
    background: var(--kx-primary-dark);
    border-color: var(--kx-primary-dark);
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 8px 16px rgba(57, 35, 103, 0.2);
}

/* ---------- DataTables controls ---------- */
.services-page .dataTables_wrapper .dataTables_length select,
.services-page .dataTables_wrapper .dataTables_filter input {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    height: 40px;
    padding: 0 12px;
    font-size: 13px;
    color: var(--kx-text);
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.services-page .dataTables_wrapper .dataTables_filter input {
    padding-left: 34px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23747080' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: 10px center;
    min-width: 220px;
}

.services-page .dataTables_wrapper .dataTables_filter input:focus,
.services-page .dataTables_wrapper .dataTables_length select:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.services-page .dataTables_wrapper .dataTables_filter label,
.services-page .dataTables_wrapper .dataTables_length label {
    font-size: 13px;
    color: var(--kx-muted);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.services-page .dataTables_wrapper .dataTables_info {
    color: var(--kx-muted);
    font-size: 12.5px;
    padding-top: 14px;
}

/* Pagination */
.services-page .dataTables_wrapper .dataTables_paginate {
    margin-top: 15px;
}

.services-page .dataTables_wrapper .dataTables_paginate .paginate_button {
    display: inline-block;
    padding: 6px 14px;
    margin: 0 3px;
    border-radius: 8px;
    border: 1px solid var(--kx-border);
    color: var(--kx-primary-dark) !important;
    background: #fff;
    cursor: pointer;
    text-decoration: none !important;
    transition: all .2s ease;
}

.services-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--kx-soft) !important;
    border-color: var(--kx-soft);
    color: var(--kx-primary-dark) !important;
    transform: translateY(-1px);
}

.services-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark)) !important;
    border-color: var(--kx-primary-dark);
    color: #fff !important;
}

.services-page .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    color: #bbb !important;
    cursor: not-allowed;
    background: #fafafa;
}

.services-page .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: #fafafa !important;
    color: #bbb !important;
    border-color: var(--kx-border);
    transform: none;
}

/* Responsive */
@media (max-width: 767px) {
    .services-page .kx-page-head {
        flex-direction: column;
    }
    .services-page .kx-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .services-page .kx-card-actions {
        width: 100%;
    }
    .services-page .kx-btn {
        flex: 1;
        justify-content: center;
    }
    .services-page .dataTables_wrapper .dataTables_filter input {
        min-width: 100%;
    }
}
</style>

<div class="content-body services-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-cubes"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome {{Auth::user()->name}}!</h4>
                    <p class="kx-page-subtitle">
                        Manage and monitor all available services from one place.
                        @if(Auth::user()->role_id==2)
                            &nbsp;&middot;&nbsp;Agent ID: {{Auth::user()->new_id}}
                        @endif
                    </p>
                </div>
            </div>
            <nav class="kx-breadcrumb">
                <a href="{{$base_url}}/admin">Home</a> / <span class="kx-crumb-current">Services</span>
            </nav>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-left">
                            <div class="kx-card-icon"><i class="fa fa-th-large"></i></div>
                            <div>
                                <h4 class="kx-card-title">Services</h4>
                                <p class="kx-card-subtitle">Manage and monitor your available services</p>
                            </div>
                        </div>
                        <div class="kx-card-actions">
                            @if($my_permissions->contains('SERVICE_ADD'))
                            <a href="add" class="kx-btn kx-btn-primary"><i class="fa fa-plus"></i> Add Service</a>
                            @endif
                            <button class="kx-btn kx-btn-outline" id="downloadButton"><i class="fa fa-download"></i> Download</button>
                        </div>
                    </div>

                    <div class="kx-table-wrap">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Service ID</th>
                                        <th>Service Name</th>
                                        <th>Service URL</th>
                                        <th>Updated At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
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

    var table = $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        columns: [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return '<span class="kx-id-pill">' + (meta.row + 1) + '</span>';
                }
            },
            {
                data: "service_name",
                render: function(data) {
                    return '<span class="kx-service-name">' + data + '</span>';
                }
            },
            {
                data: "service_url",
                render: function(data) {
                    return '<span class="kx-service-url">' + data + '</span>';
                }
            },
            {
                "mData": "updated_at",
                "mRender": function(data, type, row) {
                    var string = row.updated_at;
                    var date = new Date(string);
                    return '<span class="kx-updated"><i class="fa fa-clock-o"></i>' + date.toLocaleString() + '</span>';
                }
            },
            {
                data: "status_id",
                render: function(data, type, row) {
                    if (data == 0) {
                        return '<span class="kx-status kx-status-inactive"><span class="kx-dot"></span>Inactive</span>';
                    }
                    if (data == 1) {
                        return '<span class="kx-status kx-status-active"><span class="kx-dot"></span>Active</span>';
                    }
                }
            },
            {
                data: null,
                render: function(data, type, row) {

                    @if($my_permissions->contains('SERVICE_DETAILS'))
                        return '<a type="button" href="edit/' + data.service_id + '" class="kx-btn-details"><i class="fa fa-arrow-right"></i> Details</a>'
                    @endif

                }
            },

        ]
    });

    // Fetch data using AJAX
    $.ajax({
        url: 'allData',
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

    // Generate and download the Excel file
    function downloadExcel() {
        var excelData = convertToExcel();
        var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'data.xlsx';
        a.click();
        URL.revokeObjectURL(url);
    }

    // Attach event listener to download button
    $('#downloadButton').on('click', downloadExcel);

});
</script>

<!-- Required vendors -->
<script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="{{$base_url}}/vendor/moment/moment.min.js"></script>
<script src="{{$base_url}}/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- clockpicker -->
<script src="{{$base_url}}/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<script src="{{$base_url}}/vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="{{$base_url}}/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="{{$base_url}}/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="{{$base_url}}/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- pickdate -->
<script src="{{$base_url}}/vendor/pickadate/picker.js"></script>
<script src="{{$base_url}}/vendor/pickadate/picker.time.js"></script>
<script src="{{$base_url}}/vendor/pickadate/picker.date.js"></script>

<!-- Daterangepicker -->
<script src="{{$base_url}}/js/plugins-init/bs-daterange-picker-init.js"></script>
<!-- Clockpicker init -->
<script src="{{$base_url}}/js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="{{$base_url}}/js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<script src="{{$base_url}}/js/plugins-init/material-date-picker-init.js"></script>
<!-- Pickdate -->
<script src="{{$base_url}}/js/plugins-init/pickadate-init.js"></script>

@endsection