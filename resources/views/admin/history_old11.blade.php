@extends('layouts.admin-app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">History</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> History </a>
              </li>
              <li class="breadcrumb-item">
              All                                </li>
            </ol> 
          </div>
        </div>
      </div>
    </div>

  </div>                    
  <div class="content-body">
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">All History</h4>
           <a href="{{config('app.baseURL')}}/admin/sanctioncalculator"> <button type="submit" class="btn pull-right btn btn-primary panel-button">Sanction Calculator</button></a> 
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Date Of Birth</th>
                     <th>Age</th>
                   <th>Loan Amount</th>
                   <th>Interest Rate</th>
                    <th>Time Period</th>
                   <th>EMI</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                   <th>Name</th>
                    <th>Date Of Birth</th>
                     <th>Age</th>
                   <th>Loan Amount</th>
                   <th>Interest Rate</th>
                    <th>Time Period</th>
                   <th>EMI</th>
                   <th>Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>

<script>
  $(function(){
    $("#footer-table").DataTable({
      "processing": true,
      "serverSide": true,
      "order": [[ 7, "desc" ]],
      "ajax": "{{config('app.baseURL')}}/admin/sanctioncalculatorhistoryAll",

      "columns":[{
          "mData":"name"
        },{
          "mData":"dob",
          
        },{
          "mData":"age",
          
        },
        {
          "mData":"calc_loan_amt",
          
        },
        {
          "mData":"calc_interest_rate",
          
        },
        {
          "mData":"calc_time_period",
          
        },
        {
          "mData":"calc_emi",
          
        }, {
          "mData":"updated_at",
          
        },{  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){

            return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/sanctioncalculator/" + row.sanction_calc_id+"><span><button type='submit' class='btn btn-primary'>Details</button></span></a>";
            // }
          },

        },
        ]
      });
  });


</script>
<!-- datatable js -->

@endsection

