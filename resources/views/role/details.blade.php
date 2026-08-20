@extends('layouts.admin-app')
@section('content')
<link href="{{$base_url}}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Custom Stylesheet -->
<link href="{{$base_url}}/css/style.css" rel="stylesheet">
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/role/all">Roles</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Role Details</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    <form action="{{$role->role_id}}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                              
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Role<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('role') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('role', $role->role)}}" id="role" name="role" placeholder="Enter role name" readonly>
                                                        @if ($errors->has('role'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('role') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {{-- <div class="col-lg-8 ml-auto">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Permissions</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Permission ID</th>
                                                <th>Permission Name</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label">
                                                            @if(in_array($permission->permission_id, $permission_ids))
                                                            <input type="checkbox" onclick="permission({{$permission->permission_id}})" id="{{$permission->permission_id}}" class="form-check-input" value="{{$permission->permission_id}}" checked="">
                                                            @else
                                                            <input type="checkbox" onclick="permission({{$permission->permission_id}})" id="{{$permission->permission_id}}" class="form-check-input" value="{{$permission->permission_id}}">
                                                            @endif
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>{{$permission->permission_name}}</td>
                                                <td>{{$permission->permission_description}}</td>
                                            </tr>
                                            @endforeach
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <script>
         

           function permission(id){
            var role_id = {{$role->role_id}};
            // alert(id);
            $.ajax({
                url:role_id,
                type:"post",
                data:{
                "_token": "{{ csrf_token() }}", 'rid': role_id, 'pid': id,
                },
                success:function(response){
                    console.log(response);
                }
            });
           }
        </script>
        <script src="{{$base_url}}/js/quixnav-init.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>    
    
    
        <!-- Datatable -->
        <script src="{{$base_url}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/datatables.init.js"></script>
    
        <script class="">
 <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
</script>
@endsection

