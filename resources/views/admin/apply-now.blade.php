@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Apply Now</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Apply Now </a>
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
          <h4 class="card-title">All Apply Nows</h4>
                  </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Phone</th>
                    <th>Product Name</th>
                    <th>Equity Fund</th>
                    <th>Created At</th>
                   
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Phone</th>
                    <th>Product Name</th>
                    <th>Equity Fund</th>
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

<script>
  $(function(){
    $("#footer-table").DataTable({
      "processing": true,
      "serverSide": true,
     "responsive": true,
      "ajax": "{{config('app.baseURL')}}/admin/apply_now/allData",

      "columns":[{
          "mData":"phone",
                "mRender": function(data, type, row){
          
            return "<span><a href='tel:"+row.phone+"'>"+row.phone+"</a></span>";
          
         
        }
        },{  
        
        "mData": "product_id",
        "mRender": function(data, type, row){
          if(row.product_id==1){
            return "<span>Term Insurance</span>";
          }else if(row.product_id==2){
                         
                         return "<span>Health Insurance</span>";
          }else if(row.product_id==3){
                         
                         return "<span>Home Loan</span>";
          }else if(row.product_id==4){
                         
                         return "<span>Personal Loan</span>";
          }
          else if(row.product_id==5){
           return "<span>Mutual Fund</span>";
          }else{
             return "<span>--</span>";
          }

        }
      },{  
        
        "mData": "mutual_fund_list_id",
        "mRender": function(data, type, row){
          if(row.mutual_fund_list_id!="" && row.mutual_fund_list_id!=null && row.mutual_fund_list_id!=undefined){
            return "<span>"+row.mutual_fund_list.mutual_fund_name+"</span>";
          }
          else{
           return "<span>--</span>";
          }

        }
      },
        {
          "mData": "created_at"
        }]
      });
  });


</script>
<!-- datatable js -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

