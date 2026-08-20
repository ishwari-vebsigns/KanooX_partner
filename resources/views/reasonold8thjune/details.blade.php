@extends('layouts.admin-app')
@section('content')
<style>
  .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Wallet</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit {{$reason->reason_name}} Wallet Reason</a></li>
                        </ol>
                    </div>
                </div>
 
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit {{$reason->reason_name}} Wallet Reason</h4>
                            </div>
                            <div class="card-body"> 
                                <div class="form-validation">
                                    <form action="{{$reason->reason_id}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-10">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-number">Wallet Reason<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('reason_name') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="reason_name" value="{{old('reason_name',$reason->reason_name)}}" name="reason_name" placeholder="Reason Name" required>
                                                        @if ($errors->has('reason_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('reason_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Wallet Amount
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('amount') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="service_url" value="{{old('amount',$reason->amount)}}" name="amount" placeholder="Wallet Amount" required>
                                                        @if ($errors->has('amount'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('amount') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name="save" type="submit" class="btn btn-primary">Submit</button>
                                                        @if($reason->status_id ==0)
                                                        <button name="active" class="btn btn-success">Active</button>
                                                        @endif
                                                        @if($reason->status_id ==1)
                                                        <button name="inactive" class="btn btn-danger">In-Active</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<script class="">
   
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

