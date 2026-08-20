@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Referral Claims</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Referral Claims </a>
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
              <h4 class="card-title">All Referral Claims</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">

                <div class="table-responsive">
                  <table id="footer-table" class="table zero-configuration">
                    <thead>
                      <tr>
                        <th>ID</th>
                                <th>Referral User ID</th>
                        <th>Referral User Name</th>
                        <th>Referral User Mobile</th>
                        <th>Refer By</th>
                        <th>Refer User Name</th>
                        <th>Loan Status</th>
                        <th>User Claimed</th>
                        <th>Created At</th>

                      </tr>
                    </thead>

                    <tfoot>
                      <tr>
                       <th>ID</th>
                        <th>Referral User ID</th>
                        <th>Referral User Name</th>
                        <th>Referral User Mobile</th>
                        <th>Refer By</th>
                        <th>Refer User Name</th>
                        <th>Loan Status</th>
                        <th>User Claimed</th>
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

      "ajax": "{{config('app.baseURL')}}/admin/refer_earn/allData",

      "columns":[{
        "mData":"loan_id",
        "mRender": function(data, type, row){

          return row.loan_id;
          

        }
      },{
        "mData":"loan_user_id",
      },{
        "mData":"loan.full_name",
      },{

        "mData":"loan.mobile",
      },
      {
        "mData":"referred_by",
        "mRender": function(data, type, row){

          return row.referred_by;
          

        }
      }, {
        
        "mRender": function(data, type, row){
           
           if(row.refer_by!="" && row.refer_by!=null && row.refer_by!="undefined"){
              
               return row.refer_by.name;
           }else{
               
               return "--";
           }
          
          

        }
      },{  

        "mData": "loan.status",
        "mRender": function(data, type, row){
          if(row.loan.status==2){
            return "<span style='color:#28c76f;'>Approved</span>";
          }
          else{
           return "<span style='color:#ff9f43;'>Pending</span>";
         }

       }
     },
     {  

      "mData": "loan.status",
      "mRender": function(data, type, row){
        if(row.is_claim==1){
          return "<span style='color:#28c76f;'>--</span>";
        }
         else if(row.is_claim==2){
         return "<span style='color:#ff9f43;'>User Claimed</span><br><a href='{{config('app.baseURL')}}/admin/approve/wallet/"+row.refer_friend_id +"'><button class='btn btn-primary'>Approve</button></a>";
       }else if(row.is_claim==3){
         return "<span style='color:#ff9f43;'>Claimed & Approved</span>";
       }else{
         return "<span style='color:#ff9f43;'>--</span>";
       }

     }
   },
   {
    "mData": "created_at"
  }]
});
  });


</script>

@endsection

