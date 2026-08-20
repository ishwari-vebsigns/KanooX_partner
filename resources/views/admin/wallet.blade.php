@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Approved Transaction</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Approved Transaction </a>
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
              <h4 class="card-title">All Approved Transaction</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">

                <div class="table-responsive">
                  <table id="footer-table" class="table zero-configuration">
                    <thead>
                      <tr>
                           <th>Trans ID</th>
                       <th>Loan ID</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Mobile</th>
                         <th>Amount</th>
                          <th>Refer By</th>
                        <th>Created At</th>

                      </tr>
                    </thead>

                    <tfoot>
                      <tr>
                        <th>Trans ID</th>
                       <th>Loan ID</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Mobile</th>
                        <th>Amount</th>
                        <th>Refer By</th>
                        <th>Created At</th>

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
<!-- datatable js -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function(){
    $("#footer-table").DataTable({
      "processing": true,
      "serverSide": true,
      "responsive": true,

      "ajax": "{{config('app.baseURL')}}/admin/wallet/allData",

      "columns":[{
        "mData":"wallet_transaction_id",
      },{
        "mData":"loan_id",
        "mRender": function(data, type, row){

          return row.loan_id;
          

        }
      },{
        "mData":"user.id",
      },{
        "mData":"user.name",
      },{
        "mData":"user.email",
      },{
        "mData":"amount",
      },{
        "mData":"loan.refered_by",
      },{
    "mData": "created_at"
  }]
});
  });


</script>

@endsection

