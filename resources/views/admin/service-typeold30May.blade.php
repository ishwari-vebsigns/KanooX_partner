@extends('layouts.admin-app')
@section('content')
<style>
    /* .row{
        margin-left: 15px;
        gap:20px;
    } */
 .card {
  position: relative;
  width: 303px;
  height: 250px;
  color: #2e2d31;
  background: #131313;
  overflow: hidden;
  border-radius: 20px;
}

.temporary_text {
  font-weight: bold;
  font-size: 24px;
  padding: 6px 12px;
  color: #f8f8f8;
}

.card_title {
  font-weight: bold;
}

.card_content {
  position: absolute;
  left: 0;
  bottom: 0;
    /* edit the width to fit card */
  width: 100%;
  padding: 20px;
  background: #f2f2f2;
  border-top-left-radius: 20px;
    /* edit here to change the height of the content box */
  transform: translateY(150px);
  transition: transform .25s;
}

.card_content::before {
  content: '';
  position: absolute;
  top: -47px;
  right: -45px;
  width: 100px;
  height: 100px;
  transform: rotate(-175deg);
  border-radius: 50%;
  box-shadow: inset 48px 48px #f2f2f2;
}

.card_title {
  color: #131313;
  line-height: 15px;
}

.card_subtitle {
  display: block;
  font-size: 12px;
  margin-bottom: 10px;
}

.card_description {
  font-size: 16px;
  opacity: 0;
  transition: opacity .5s;
}

.card:hover .card_content {
  transform: translateY(0);
}

.card:hover .card_description {
  opacity: 1;
  transition-delay: .25s;
}

</style>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <div class="content-body">
              <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                     
                        <div class="welcome-text">
                          @if(Auth::user()!=null)
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                            @endif

                        </div>
                        
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Apply</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Loans</a></li>
                        </ol>
                    </div>
                </div>  
                <div class="row" id="service-view" style="margin-left: 15px; gap:20px;">
                  @foreach($services as $service)
                  
                          @foreach($service->child_services as $child_service)
                    <article class="card">
                            <img src="{{$base_url}}/storage\app/{{$child_service->sub_service_image}}" alt="">
                        <div class="card_content">
                            @if(Auth::user()!=null)
                            <a href="{{$base_url}}/admin/services/bank/{{$child_service->child_service_id}}">
                            @else
                            <a href="{{$base_url}}/admin/direct-services/bank/{{$child_service->child_service_id}}?access_code={{$code}}">
                            @endif
                        <span class="card_title">{{$child_service->sub_service_name}}</span><i class="fa fa-arrow-right" style="margin-left: 80px;
                            font-size: 27px;" aria-hidden="true"></i></a>
                                <span class="card_subtitle"></span>
                                <p class="card_description">{{$child_service->description}}</p>  
                        </div>
                    </article>
                          @endforeach
                  @endforeach
                </div>
              </div>                    
            </div>

<script>
   @if(session()->has('success'))
        swal("Congratulations !!", "Your application submitted successfully, please provide copies of customer aadhar card, pan card and bank statement !!", "success");
        @php
            session()->forget('success');
        @endphp
   @endif
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

