@extends('layouts.admin-app')
@section('content')

<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Blog</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Blog </a>
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
          <h4 class="card-title">All Blogs</h4>
          <a href="{{config('app.baseURL')}}/admin/blog/add"> <button type="submit" class="btn pull-right btn btn-primary panel-button">Add Blog</button></a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">

            <div class="table-responsive">
              <table id="footer-table" class="table zero-configuration">
                <thead>
                  <tr>
                    <th>Blog Image</th>
                    <th>Blog Title</th>
                    <th>Blog Type</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Blog Image</th>
                    <th>Blog Title</th>
                    <th>Blog Type</th>
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
      "order": [[ 1, "desc" ]],
      "ajax": "{{config('app.baseURL')}}/admin/blog/allData",

      "columns":[{  
        "targets":-1,
        "mData": "image",
        "bSortable": false,
        "ilter":false,
        "mRender": function(data, type, row){
          return "<img src='{{config('app.baseURL')}}/storage/app/"+row.image+"' style='width:100px;height:50px;'>";},
        },{
          "mData":"blog_title"
        },{
          "mData":"blog_type.blog_type_name"
        },{  
          "targets":-1,
          "mData": "Action",
          "bSortable": false,
          "ilter":false,
          "mRender": function(data, type, row){
            if(row.is_deleted==0){
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/blog/" + row.blog_id+"><span><button type='submit' class='btn btn-primary'>Details</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/blog/inactive/" + row.blog_id+"><span><button type='submit' class='btn btn-danger'>Inactivate</button></span></a>";
            }else{
              return "<a class=datatable-left-link href={{config('app.baseURL')}}/admin/blog/" + row.blog_id+"><span><button type='submit' class='btn btn-primary'>Details</button></span></a> <a class=datatable-left-link href={{config('app.baseURL')}}/admin/blog/active/" + row.blog_id+"><span><button type='submit' class='btn btn-success'>Activate</button></span></a>";
            }
          },

        },
        ]
      });
  });


</script>
<!-- datatable js -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

