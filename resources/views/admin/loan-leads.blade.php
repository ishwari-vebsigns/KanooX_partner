@extends('layouts.admin-app')

@section('content')
<style>
.table-scroll{
    max-height:420px;
    overflow:auto;
}
.table th,.table td{white-space:nowrap}
.table thead th{
    position:sticky;
    top:0;
    background:#f8f9fa;
    z-index:2;
}
/* THEAD (table header) */
.table thead th {
    background-color: #eef2f7;   /* light bluish-grey */
    color: #1f2937;              /* dark readable text */
    font-weight: 600;
    border-bottom: 2px solid #d1d5db;
}

/* TABLE BODY */
.table tbody td {
    color: #374151;              /* dark grey (very readable) */
    background-color: #ffffff;
}

/* Alternate row color for readability */
.table tbody tr:nth-child(even) td {
    background-color: #f9fafb;   /* very light grey */
}

/* Hover effect */
.table-hover tbody tr:hover td {
    background-color: #eef6ff;   /* subtle blue hover */
}

</style>

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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Loan Lead Report</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="mb-0">Loan Leads</h4>

                            <a href="{{ route('loan.leads.export') }}"
                               class="btn btn-success btn-sm">
                                Download Excel
                            </a>
                        </div>
                        <div class="mb-3">
                            <input type="text"
                                   id="tableSearch"
                                   class="form-control"
                                   placeholder="Search customer, mobile...">
                        </div>

                        <div class="table-scroll table-responsive">
                        <table class="table table-bordered table-hover mb-0">


                        <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Customer</th>
                            <th>Mobile</th>
                            <th>Pincode</th>
                            <th>Loan Type</th>
                            <th>Loan Details</th>
                            <th>User ID</th>
                            <th>Created At</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($leads as $lead)
                        <tr>
                            <td>{{ $loop->iteration + ($leads->currentPage()-1)*$leads->perPage() }}</td>

                            <td>
                                <strong>{{ $lead->customer_name }}</strong>
                            </td>

                            <td>{{ $lead->contact_no }}</td>

                            <td>{{ $lead->pincode }}</td>

                            <td>
                                {{ optional($lead->service)->name ?? '-' }}
                            </td>

                            <td style="max-width:260px">
                                @if(!empty($lead->dynamic_fields) && is_array($lead->dynamic_fields))
                                    <ul class="mb-0 ps-3">
                                        @foreach(collect($lead->dynamic_fields)->except(['loan_amount_min', 'income_min']) as $key => $value)
                                            <li>
                                                <strong>{{ ucwords(str_replace('_',' ', $key)) }}:</strong>
                                                {{ $value ?? '-' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{-- fallback for old records --}}
                                    @php
                                        $fallback = [];
                                        if($lead->company_name) $fallback['Company'] = $lead->company_name;
                                        if($lead->salary) $fallback['Salary'] = number_format($lead->salary,2);
                                        if($lead->loan_amount) $fallback['Loan Amount'] = number_format($lead->loan_amount,2);
                                    @endphp

                                    @if(count($fallback))
                                        <ul class="mb-0 ps-3">
                                            @foreach($fallback as $k => $v)
                                                <li><strong>{{ $k }}:</strong> {{ $v }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                @endif
                            </td>

                            <td>{{ $lead->user_id ?? '-' }}</td>

                            <td>{{ $lead->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                        </tbody>

                        </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-end">
                            {{ $leads->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.getElementById('tableSearch').addEventListener('keyup', function () {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('tbody tr');

    rows.forEach(function(row) {

        let text = row.innerText.toLowerCase();

        if (text.includes(value)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });
});
</script>
@endsection