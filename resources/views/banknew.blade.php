@extends('layouts.admin-app')
@section('content')
<style>
  .card {
    margin-left: 33px;
  overflow: hidden;
  border-radius: 0.5rem;
  max-width: 300px;
  width: 260px;
  background-color: #fff;
  color: #212121;
}

.image {
  height: 10rem;
  width: 100%;
  object-fit: cover;
  /* background-color: rgb(204, 0, 255); */
  /* background-image: linear-gradient(to right, rgb(255, 174, 0), rgb(204, 0, 255)); */
}

.content {
  padding: 1rem;
  text-align: center;
}

.text-1 {
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}

.text-2 {
  margin-top: 1rem;
  font-weight: 900;
  text-transform: uppercase;
}

.text-2 span:first-child {
  font-size: 2.25rem;
  line-height: 2.5rem;
  font-weight: 900;
}

.text-2 span:last-child {
  margin-top: 0.5rem;
  display: block;
  font-size: 0.70rem;
  line-height: 1.1rem;
}

.action {
  margin-top: 1rem;
  display: inline-block;
  width: 100%;
  background-color: rgb(212, 50, 50);
  padding-top: 1rem;
  padding-bottom: 1rem;
  border-radius: 4px;
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255, 255, 255, 1);
  text-decoration: none;
}
.card-img {
    width: 100%;
    height:100%;  
    border-radius: calc(0.25rem - 1px);
}
.date {
  margin-top: 1rem;
  font-size: 0.75rem;
  line-height: 1rem;
  font-weight: 500;
  text-transform: uppercase;
  color: rgba(156, 163, 175, 1);
}
</style>
<div class="content-body">
  <div class="container-fluid">
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            @if(Auth::user()!=null)
              <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
              @if (Auth::user()->role_id == 2)
                  <p class="mb-0">Agent ID: {{ Auth::user()->new_id }}</p>
              @endif
              @endif
          </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
          <ol class="breadcrumb">
          
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Banks</a></li>
          </ol>
      </div>
  </div>
          <div class="row">
            @if($pincodes=='[]')

            <div class="card-body">
              <div class="alert alert-warning solid alert-right-icon alert-dismissible fade show">
                <span><i class="mdi mdi-alert"></i></span>
                {{-- <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                </button> --}}
                <strong>Sorry!</strong> There is no any Bank in your area. Please visit nearest branch.
            </div>
            </div>
            @endif
           {{--@foreach($pincodes as $bank)--}}
           
                @php
$uniqueBanks = $pincodes->unique('bank_id');
@endphp


@foreach($uniqueBanks as $bank)
                  {{--<!--@if($bank->bank!=null)-->--}}
                  @if($bank->bank && $bank->bank->is_active == 1)
                  
                  {{--@if($bank->bank->banksubservice!=null)--}}
                  @php
                    
                    $subservice = $bank;
                @endphp
                
                @if($subservice)
                  
                    <div class="card">
                      <div class="image">
                        <img class="card-img" src="{{$base_url}}/storage\app/{{$bank->bank->bank_image}}" alt="">
                      </div>
                      
                        <div class="content">
                          <p class="text-1">
                            {{$bank->bank->bank_name}}
                          </p>
                          <div class="text-2">
                              <span>{{$bank->bank->description}}</span>
                          </div>
                          
                            @if($bank->bank->banksubservice->bank_url!= null)
                            
                              <a class="action" onclick="getbankid({{$bank->bank_id}})" target="_blank" href="{{$bank->bank->banksubservice->bank_url}}">
                                Apply Now
                              </a>
                            @else
                              @if(Auth::user()!=null)
                              <a class="action" onclick="getbankid({{$bank->bank_id}})" href="{{$base_url}}/admin/services/form/apply-user">
                              @else
                              <a class="action" onclick="getbankid({{$bank->bank_id}})" href="{{$base_url}}/admin/direct-services/form/apply-user?access_code={{$code}}">
                              @endif
                                Apply Now
                              </a>
                            @endif
                          
                            <p class="date">
                            
                            </p>
                        </div>
                       
                    </div>
              
                @else
                <div class="card">
                  <div class="image">
                    <img class="card-img" src="{{$base_url}}/storage\app/{{$bank->bank->bank_image}}" alt="">
                  </div>
                  
                    <div class="content">
                      <p class="text-1">
                        {{$bank->bank->bank_name}}
                      </p>
                      <div class="text-2">
                          <span>{{$bank->bank->description}}</span>
                      </div>
                      
                       
                          <a class="action" href="javascript:void(0);">Currently Not Providing Any Service.</a>
                        
                      
                        <p class="date">
                        
                        </p>
                    </div>
                   
                </div>
                
              @endif
              @endif
            @endforeach
            
<!--@foreach($pincodes as $bank)-->

<!--@if($bank->bank && $bank->bank->banksubservice)-->

<!--    @php-->
<!--        $subservice = $bank->bank->banksubservice->first();-->
<!--    @endphp-->

<!--    <div class="card">-->
<!--        <div class="image">-->
<!--            <img class="card-img"-->
<!--                 src="{{ asset('storage/'.$bank->bank->bank_image) }}"-->
<!--                 alt="">-->
<!--        </div>-->

<!--        <div class="content">-->
<!--            <p class="text-1">-->
<!--                {{ $bank->bank->bank_name }}-->
<!--            </p>-->

<!--            <div class="text-2">-->
<!--                <span>{{ $bank->bank->description }}</span>-->
<!--            </div>-->

<!--            @if(!empty($subservice->bank_url))-->
<!--                <a class="action"-->
<!--                   target="_blank"-->
<!--                   href="{{ $subservice->bank_url }}">-->
<!--                    Apply Now-->
<!--                </a>-->
<!--            @else-->
<!--                @if(Auth::check())-->
<!--                    <a class="action"-->
<!--                       href="{{ url('admin/services/form/apply-user?bank_id='.$bank->bank_id) }}">-->
<!--                        Apply Now-->
<!--                    </a>-->
<!--                @else-->
<!--                    <a class="action"-->
<!--                       href="{{ url('admin/direct-services/form/apply-user?bank_id='.$bank->bank_id.'&access_code='.$code) }}">-->
<!--                        Apply Now-->
<!--                    </a>-->
<!--                @endif-->
<!--            @endif-->

<!--        </div>-->
<!--    </div>-->

<!--@endif-->

<!--@endforeach-->
          </div>
        </div>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script>
        function getbankid(id){
          // alert(id);
          $.ajax({
                url:"{{$base_url}}/sendbankid",
                type:"post",
                data:{
                "_token": "{{ csrf_token() }}","bank_id":id,
                },
              
                
            });
        }
      </script>
@endsection

