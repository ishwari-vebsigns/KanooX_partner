@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Invoice</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Invoice </a>
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
          <h4 class="card-title">All Invoices</h4>
           <a href="{{config('app.baseURL')}}/admin/invoice/add"> <button type="submit" class="btn pull-right btn btn-primary panel-button">Create New</button></a> 
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Bank Name</th>
                    <th>Biller Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                   <th>Sr No</th>
                   <th>Bank Name</th>
                    <th>Biller Name</th>
                    <th>Amount</th>
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
      "order": [[ 0, "desc" ]],
      "ajax": "{{config('app.baseURL')}}/admin/invoice/allData",

      "columns":[{
          "mData":"sr_id"
        },{
          "mData":"bank_name"
        },{
          "mData":"biller_name_one"
        },{
          "mData":"amount"
          
        },{
          "mData":"created_at"
          
        },
        {  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){

            return "<a href='{{config('app.baseURL')}}/admin/invoice/"+row.sr_id+"' class=datatable-left-link><span><button type='submit' class='btn btn-primary'>Details</button></span></a>";
            // }
          },

        },
        ]
      });
  });


</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

@endsection

