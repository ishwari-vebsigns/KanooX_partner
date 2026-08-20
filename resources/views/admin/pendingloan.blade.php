@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">All Loan Applications</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#">All Loan Applications</a>
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
              <h4 class="card-title">All Loan Applications</h4>
            </div>
            <div class="col-md-12 mt-2 form-group">
              <form method="" action="">
                <div class="row">
                  <div class="col-md-3">
                    <select class="form-control" name="status" id="status">
                      <option value="" selected="">Filter</option>
                      <option value="0">Loan Inprocess</option>
                      <option value="1">Documents Pending</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" id="submitstatus">Submit</button>
                  </div>  
                </div>
              </form>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">

                <div class="table-responsive">

                  <table id="footer-table" class="table zero-configuration">
                    <thead>
                      <tr>
                           <th>Loan Id</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Loan Amount</th>
                        <th>Loan Tenure</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Sub Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tfoot>
                      <tr>
                            <th>Loan Id</th>
                       <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Loan Amount</th>
                        <th>Loan Tenure</th>
                         <th>Assigned To</th>
                         <th>Status</th>
                        <th>Sub Status</th>
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
<script type="text/javascript">
   function showstatus(status){
  $(function(){
    $("#footer-table").DataTable({
      "processing": true,
      "serverSide": true,
      "responsive": true,
      "stateSave": true,
      "paging": true,
       dom: 'lBfrtip',
        buttons: [
          'excel', 'csv', 'pdf'
        ],

        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      "ajax": "{{config('app.baseURL')}}/admin/pendingallData?status={{$status}}",

      "columns":[{
        "mData":"loan_id"
        
      },{
        "mData":"full_name"
        
      },{
        "mData":"mobile",
        "mRender": function(data, type, row){

          return "<span><a href='tel:"+row.mobile+"'>"+row.mobile+"</a></span>";
          

        },
        
      },{
        "mData":"email",
        "mRender": function(data, type, row){

          return "<span><a href='mailto:"+row.email+"'>"+row.email+"</a></span>";
          

        }
       
      },{
        "mData":"loan_amount"
      },{  
        
        "mData": "loan_type"
        
      },{
        "mData":"assigned_to",
        "mRender": function(data, type, row){
          
          if(row.associate!=null){
               return row.associate.name;
          }else{
               return "--";
          }
        },
        
      },{
        "mData":"status",
        "mRender": function(data, type, row){
          
          if(row.status==0){
               return "Inprocess";
          }else if(row.status==1){
               return "Document Pending";
          }
        },
        
      },{
        "mData":"substatus.status_name",
        "mRender": function(data, type, row){
          
          if(row.substatus!=null){
               return row.substatus.status_name;
          }else{
               return "--";
          }
        },
        
      },{  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){
            return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/loanDetails/" + row.loan_id+"><span><button type='submit' class='btn btn-primary mr-1'>Details</button></span></a>";
          },
        },
      ]
    });
  });

}
showstatus();

   var status=$('#submitstatus').on("click", function (e) {
            
            var loan_status = $('#status').val();
            $("#footer-table").DataTable();
            $("#footer-table").DataTable().clear();
            $("#footer-table").DataTable().destroy();
            showdate(loan_status);

});
</script>


@endsection

