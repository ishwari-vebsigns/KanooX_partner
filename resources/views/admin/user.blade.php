@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Users</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Users</a>
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
          <h4 class="card-title">All Users</h4>
                  </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Name</th> 
                    <th>Contact Number</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Created At</th> 
                    <th>Action</th>             
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                   <th>Name</th>
                     <th>Contact Number</th>
                    <th>Purpose</th>
                    <th>Amount</th>
                    <th>Created At</th>
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
      "responsive": true,
    
      "ajax": "{{config('app.baseURL')}}/admin/user/allData",

      "columns":[{
        "mData":"name"
      },
      // {
      //     "mData":"email",
      //     "mRender": function(data, type, row){
      //      return "<span><a href='mailto:"+row.email+"'>"+row.email+"</a></span>";
      //   },
      // },
      // {  
        
      //   "mData": "role_id",
      //   "mRender": function(data, type, row){
      //     if(row.role_id==1){
      //       return "<span>Admin</span>";
      //     }
      //     else{
      //      return "<span>Customer</span>";
      //     }

      //   }
      // },
      {
        "mData": "contact_number",
        "mRender": function(data, type, row){
          if(row.contact_number==null)
          {
            return "<span style='color:#28c76f;'>--</span>";
          }
          else{
            return row.contact_number;
          }
        }
      },
      {
        "mData": "purpose",
        "mRender": function(data, type, row){
          if(row.purpose==null)
          {
            return "<span style='color:#28c76f;'>--</span>";
          }
          else{
            return row.purpose;
          }
        }
      },
      {
        "mData": "amount",
        "mRender": function(data, type, row){
          if(row.amount==null)
          {
            return "<span style='color:#28c76f;'>--</span>";
          }
          else{
            return row.amount;
          }
        }
      },
      {
        "mData": "created_at"
      },
      
      {  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){
            if(row.is_active==1){
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/user/userbranch/all/" + row.id+"><span><button type='button' class='btn btn-primary'>Details</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/user/status/" + row.id+"><span><button type='button' class='btn btn-danger'>Inactivate</button></span></a>";
            }else{
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/user/userbranch/all/" + row.id+"><span><button type='button' class='btn btn-primary'>Details</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/user/status/" + row.id+"><span><button type='button' class='btn btn-success'>Activate</button></span></a>";
            }
          },

        },
        
        ]
      });
  });


</script>

@endsection

