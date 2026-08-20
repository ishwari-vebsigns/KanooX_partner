@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Bank</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Bank </a>
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
          <h4 class="card-title">All Bank</h4>
          <a href="{{config('app.baseURL')}}/admin/bank/add"> <button type="submit" class="btn pull-right btn btn-primary panel-button">Add Bank</button></a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Bank Name</th>
                    <th>Blank Image</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Bank Name</th>
                    <th>Blank Image</th>
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
<!-- datatable js -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function(){
    $("#footer-table").DataTable({
      "processing": true,
      "serverSide": true,
      "order": [[ 1, "desc" ]],
      "ajax": "{{config('app.baseURL')}}/admin/bank/allData",

      "columns":[{
          "mData":"bank_name"
        },
        {  
        "targets":-1,
        "mData": "bank_image",
        "bSortable": false,
        "ilter":false,
        "mRender": function(data, type, row){
          return "<img src='{{config('app.baseURL')}}/storage/app/"+row.bank_image+"' style='width:100px;height:80px;'>";},
        },
        {  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){
            if(row.is_active==0){
              //return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/" + row.bank_id+"><span><button type='submit' class='btn btn-primary'>Edit</button></span></a> ";
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/" + row.bank_id+"><span><button type='submit' class='btn btn-primary'>Edit</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/inactive/" + row.bank_id+"><span><button type='submit' class='btn btn-danger'>Inactivate</button></span></a>";
            }else{
              //return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/" + row.bank_id+"><span><button type='submit' class='btn btn-primary'>Edit</button></span></a> ";
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/" + row.bank_id+"><span><button type='submit' class='btn btn-primary'>Edit</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/bank/active/" + row.bank_id+"><span><button type='submit' class='btn btn-success'>Activate</button></span></a>";
            }
          },

        },
        ]
      });
  });


</script>

@endsection

