@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Referal Tool</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Referal Tool </a>
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
              <h4 class="card-title">All Referal Tool</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">

                <div class="table-responsive">
                  <table id="footer-table" class="table zero-configuration">
                    <thead>
                      <tr>
                        <!-- <th>Loan ID</th> -->
                        <th>ID</th>
                        <th>Refer By - Name</th>
                        <th>Refer By - Contact</th>
                        <th>Referal Code</th>
                        <th>Refer User Name</th>
                        <th>Refer User Contact</th>
                        <th>Refer User Email</th>
                        <th>Product Name</th>
                        <th>Created At</th>

                      </tr>
                    </thead>

                    <tfoot>
                      <tr>
                       <th>ID</th>
                        <th>Refer By - Name</th>
                        <th>Refer By - Contact</th>
                        <th>Referal Code</th>
                        <th>Refer User Name</th>
                        <th>Refer User Contact</th>
                        <th>Refer User Email</th>
                        <th>Product Name</th>
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

      "ajax": "{{config('app.baseURL')}}/admin/referal_tools/allData",

      "columns":[{
        "mData":"referal_tool_id",
        
      },{
        "mData":"refer_by.name",
        "mRender": function(data, type, row){
          if(row.refer_by==null)
          {
            return "<span style='color:#28c76f;'>--</span>";
          }
          else{
            return row.refer_by.name;
          }
        }
      },{
        "mData":"refer_by.contact_number",
        "mRender": function(data, type, row){
          if(row.refer_by==null)
          {
            return "<span style='color:#28c76f;'>--</span>";
          }
          else{
            if (row.refer_by.contact_number!=null) {
              return row.refer_by.contact_number;
            }
            else{
               return "<span style='color:#28c76f;'>--</span>";
            }
            
          }
        }
      },{

        "mData":"referal_code",
      },{

        "mData":"name",
      },
      {
        "mData":"phone",
        
      },{

        "mData":"email",
      },{  

        "mData": "Product Name",
        "mRender": function(data, type, row){
          if(row.product_id==1){
            return "<span>Home Loan</span>";
          }
          else if(row.product_id==2){
           return "<span>Mortgage Loan</span>";
         }
         else if(row.product_id==3){
           return "<span>Project Loan</span>";
         }
         else if(row.product_id==4){
           return "<span>Term Loan</span>";
         }
         else if(row.product_id==5){
           return "<span>Working Capital</span>";
         }
         else if(row.product_id==6){
           return "<span>Overdraft Facility</span>";
         }
         else if(row.product_id==7){
           return "<span>Machinary Loan</span>";
         }
         else{
           return "<span>Business Loan</span>";
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

