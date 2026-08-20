@extends('layouts.admin-app')
@section('content')
<!-- <style>
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

</style> -->
<style>
.loan-card {
    position: relative;
    width: 280px;
    height: 260px;
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 28px rgba(15,50,100,0.08);
    transition: transform .3s ease, box-shadow .3s ease;
}

.loan-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(15,50,100,0.15);
}

/* IMAGE */
.loan-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

/* CONTENT */
.loan-card-content {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 18px 20px;
    background: #ffffff;
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    transform: translateY(90px);
    transition: transform .3s ease;
}

.loan-card:hover .loan-card-content {
    transform: translateY(0);
}

/* TITLE */
.loan-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #0F3264;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* DESCRIPTION */
.loan-card-desc {
    font-size: 13px;
    color: #64748b;
    margin-top: 10px;
    line-height: 1.5;
    opacity: 0;
    transition: opacity .3s ease;
}

.loan-card:hover .loan-card-desc {
    opacity: 1;
}

/* ARROW */
.loan-arrow {
    font-size: 20px;
    color: #FCB650;
}
.loan-card-new {
    position: relative;
    width: 280px;
    height: 260px;
    border-radius: 18px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 12px 30px rgba(15,50,100,0.1);
    transition: all .3s ease;
}

.loan-card-new:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 38px rgba(15,50,100,0.18);
}

/* BACKGROUND IMAGE */
.loan-bg {
    height: 150px;
    background-size: cover;
    background-position: center;
    filter: brightness(0.85);
}

/* ICON */
.loan-icon {
    position: absolute;
    top: 110px;
    left: 20px;
    width: 64px;
    height: 64px;
    background: #fff;
    border-radius: 50%;
    padding: 10px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.loan-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* CONTENT */
.loan-card-content-new {
    padding: 55px 20px 20px;
}

.loan-card-content-new h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0F3264;
    margin-bottom: 6px;
}

.loan-card-content-new p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
}

/* ARROW */
.loan-arrow-new {
    position: absolute;
    bottom: 18px;
    right: 20px;
    color: #FCB650;
    font-size: 20px;
}
.ls-card {
    position: relative;
    width: 300px;
    height: 230px;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 14px 32px rgba(15,50,100,0.12);
    transition: all .3s ease;
}

.ls-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 22px 40px rgba(15,50,100,0.2);
}

/* BACKGROUND */
.ls-bg {
    height: 120px;
    background-size: cover;
    background-position: center;
    position: relative;
}

.ls-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(15,50,100,0.15),
        rgba(15,50,100,0.6)
    );
}

/* ICON */
.ls-icon {
    position: absolute;
    top: 80px;
    left: 20px;
    width: 64px;
    height: 64px;
    background: #fff;
    border-radius: 50%;
    padding: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    z-index: 2;
}

.ls-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* CONTENT */
.ls-content {
    padding: 50px 20px 20px;
}

.ls-content h4 {
    font-size: 16px;
    font-weight: 700;
    color: #0F3264;
    margin-bottom: 6px;
}

.ls-content p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
}

/* ARROW */
.ls-arrow {
    position: absolute;
    bottom: 16px;
    right: 18px;
    font-size: 18px;
    color: #FCB650;
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
                <!-- <div class="row" id="service-view" style="margin-left: 15px; gap:20px;">
                  @foreach($services as $service)
                  
                    <article class="card">
                            <img src="{{$base_url}}/storage\app/{{$service->sub_service_image}}" alt="">
                        <div class="card_content">
                            @if(Auth::user()!=null)
                            <a href="{{$base_url}}/admin/services/bank/{{$service->child_service_id}}">
                            @else
                            <a href="{{$base_url}}/admin/direct-services/bank/{{$service->child_service_id}}?access_code={{$code}}">
                            @endif
                        <span class="card_title">{{$service->sub_service_name}}</span><i class="fa fa-arrow-right" style="margin-left: 80px;
                            font-size: 27px;" aria-hidden="true"></i></a>
                                <span class="card_subtitle"></span>
                                <p class="card_description">{{$service->description}}</p>  
                        </div>
                    </article>
                  @endforeach
                </div> -->
                <div class="row" style="gap:20px; margin-left:15px;">
@foreach($services as $service)

<div class="ls-card">

    <!-- BACKGROUND -->
    <div class="ls-bg"
         style="background-image:url('{{ $base_url }}/storage/app/{{ $service->sub_service_image_2 }}')">
        <div class="ls-overlay"></div>
    </div>

    <!-- ICON -->
    <div class="ls-icon">
        <img src="{{ $base_url }}/storage/app/{{ $service->sub_service_image }}"
             alt="{{ $service->sub_service_name }}">
    </div>

    <!-- CONTENT -->
    <div class="ls-content">
        @if(Auth::user())
            <a href="{{ $base_url }}/admin/services/bank/{{ $service->child_service_id }}">
        @else
            <a href="{{ $base_url }}/admin/direct-services/bank/{{ $service->child_service_id }}?access_code={{ $code }}">
        @endif

            <h4>{{ $service->sub_service_name }}</h4>
            <p>{{ $service->description }}</p>

            <span class="ls-arrow">
                <i class="fa fa-arrow-right"></i>
            </span>
        </a>
    </div>

</div>

@endforeach
</div>



              </div>                    
            </div>

<script>
   @if(session()->has('success'))
        swal("Congratulations !!", "{{Session::get('success')}}", "success");
        @php
            session()->forget('success');
        @endphp
   @endif
   @if(session()->has('cancel'))
        swal("{{Session::get('cancel')}}");
        @php
            session()->forget('cancel');
        @endphp
   @endif
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

