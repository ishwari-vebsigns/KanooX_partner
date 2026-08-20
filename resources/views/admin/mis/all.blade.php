@extends('layouts.admin-app')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

<style>
    .dt-buttons{
        margin-top:20px;
    }
    .dt-button{
        background: #4839eb;
    border: 0px;
    border-radius: 3px;
    padding: 5px 19px;
    color: #fff;
    }
</style>
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">MIS</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> MIS </a>
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
          <h4 class="card-title">All MIS Data</h4>
           <a href="{{config('app.baseURL')}}/admin/mis/add"> <button type="submit" class="btn pull-right btn btn-primary panel-button">Add New</button></a> 
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Customer Name</th>
                    <th>Residence Address</th>
                    <th>Office Address</th>
                    <th>Contact Number</th>
                    <th>Email Id</th>
                    <th>Loan Amount</th>
                    <th>Product</th>
                    <th>Bank /NBFC Name</th>
                    <th>Property Details</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pin Code</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                   <th>Sr No</th>
                    <th>Customer Name</th>
                    <th>Residence Address</th>
                    <th>Office Address</th>
                    <th>Contact Number</th>
                    <th>Email Id</th>
                    <th>Loan Amount</th>
                    <th>Product</th>
                    <th>Bank /NBFC Name</th>
                    <th>Property Details</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pin Code</th>
                    <th>Remarks</th>
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
                dom: 'lBfrtip',
        buttons: [
          'excel', 'csv'
        ],
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      "ajax": "{{config('app.baseURL')}}/admin/mis/allData",

      "columns":[{
          "mData":"sr_id"
        },{
          "mData":"customer_name"
        },{
          "mData":"customer_residence",
          
        },{
          "mData":"office_shop_add",
          
        },             
        {
          "mData":"contact_no",
          
        },
        {
          "mData":"email",
          
        },
        {
          "mData":"required_loan",
          
        },
        {
          "mData":"product",
          
        }, {
          "mData":"bank_nbfc_name",
          
        },{
          "mData":"property_details",
          
        },{
          "mData":"city",
          
        },{
          "mData":"state",
          
        },{
          "mData":"pincode",
          
        },{
          "mData":"remarks",
          
        },{  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){

            return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/mis/" + row.sr_id+"><span><button type='submit' class='btn btn-primary'>Details</button></span></a>";
            // }
          },

        },
        ]
      });
  });


</script>
<!-- datatable js -->

@endsection

