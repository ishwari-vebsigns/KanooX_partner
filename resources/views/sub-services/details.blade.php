@extends('layouts.admin-app')
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<style>
.subservice-edit-page {
    --kx-primary: #9D3895;
    --kx-primary-dark: #392367;
    --kx-soft: #F3D9F0;
    --kx-page-bg: #F8EAF7;
    --kx-text: #25213A;
    --kx-muted: #747080;
    --kx-border: #E9E3EA;
}

/* ---------- Page header ---------- */
.subservice-edit-page .kx-page-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.subservice-edit-page .kx-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.subservice-edit-page .kx-title-icon {
    flex: 0 0 auto;
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: var(--kx-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--kx-primary-dark);
    font-size: 20px;
}

.subservice-edit-page .kx-page-title {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: var(--kx-text);
    letter-spacing: -0.2px;
}

.subservice-edit-page .kx-page-subtitle {
    margin: 3px 0 0;
    font-size: 13.5px;
    color: var(--kx-muted);
}

.subservice-edit-page .kx-breadcrumb {
    margin: 0;
    padding: 8px 14px;
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 8px;
    font-size: 13px;
    color: var(--kx-muted);
    align-self: center;
    display: flex;
    align-items: center;
    gap: 6px;
}

.subservice-edit-page .kx-breadcrumb a {
    color: var(--kx-muted);
    text-decoration: none;
}

.subservice-edit-page .kx-breadcrumb a:hover {
    color: var(--kx-primary);
}

.subservice-edit-page .kx-breadcrumb .kx-crumb-current {
    color: var(--kx-primary-dark);
    font-weight: 600;
}

/* ---------- KYC alert ---------- */
.subservice-edit-page .kx-kyc-alert {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    background: #FDECEC;
    border: 1px solid #F6C9C9;
    color: #B93A3A;
    border-radius: 12px;
    font-size: 13.5px;
    margin-bottom: 20px;
}

.subservice-edit-page .kx-kyc-alert i {
    font-size: 16px;
    flex: 0 0 auto;
}

.subservice-edit-page .kx-kyc-alert a {
    color: #392367;
    font-weight: 700;
    text-decoration: underline;
}

/* ---------- Card ---------- */
.subservice-edit-page .kx-card {
    background: #fff;
    border: 1px solid var(--kx-border);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(57, 35, 103, 0.08);
    overflow: hidden;
}

.subservice-edit-page .kx-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    padding: 22px 26px;
    border-bottom: 1px solid var(--kx-border);
}

.subservice-edit-page .kx-card-header-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.subservice-edit-page .kx-card-icon {
    flex: 0 0 auto;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--kx-page-bg);
    color: var(--kx-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.subservice-edit-page .kx-card-title {
    margin: 0;
    font-size: 16.5px;
    font-weight: 700;
    color: var(--kx-text);
}

.subservice-edit-page .kx-card-subtitle {
    margin: 2px 0 0;
    font-size: 12.5px;
    color: var(--kx-muted);
}

/* status badge in header */
.subservice-edit-page .kx-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.subservice-edit-page .kx-status .kx-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.subservice-edit-page .kx-status-active {
    background: #EAF8EF;
    color: #238B45;
}
.subservice-edit-page .kx-status-active .kx-dot { background: #238B45; }

.subservice-edit-page .kx-status-inactive {
    background: #FDECEC;
    color: #D64545;
}
.subservice-edit-page .kx-status-inactive .kx-dot { background: #D64545; }

/* ---------- Form body ---------- */
.subservice-edit-page .kx-form-body {
    padding: 30px 26px 32px;
}

/* image previews */
.subservice-edit-page .kx-image-previews {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
}

.subservice-edit-page .kx-image-preview-box {
    border: 1px solid var(--kx-border);
    border-radius: 12px;
    padding: 10px;
    background: var(--kx-page-bg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.subservice-edit-page .kx-image-preview-box img {
    max-height: 140px;
    max-width: 140px;
    border-radius: 8px;
    object-fit: contain;
}

.subservice-edit-page .kx-field {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 4px 24px;
    margin-bottom: 22px;
}

.subservice-edit-page .kx-field:last-of-type {
    margin-bottom: 0;
}

.subservice-edit-page .kx-field-label {
    flex: 0 0 200px;
    max-width: 200px;
    padding-top: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--kx-text);
}

.subservice-edit-page .kx-field-label .text-danger {
    color: #D64545;
}

.subservice-edit-page .kx-field-control {
    flex: 1 1 320px;
    max-width: 420px;
}

.subservice-edit-page .kx-input,
.subservice-edit-page select.kx-input,
.subservice-edit-page textarea.kx-input {
    width: 100%;
    border: 1px solid var(--kx-border);
    border-radius: 9px;
    padding: 0 14px;
    font-size: 13.5px;
    color: var(--kx-text);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.subservice-edit-page .kx-input {
    height: 44px;
}

.subservice-edit-page select.kx-input {
    height: 44px;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%23747080' viewBox='0 0 16 16'%3E%3Cpath d='M8 11 3 6h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 34px;
}

.subservice-edit-page textarea.kx-input {
    height: auto;
    padding: 12px 14px;
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

.subservice-edit-page .kx-input:focus,
.subservice-edit-page select.kx-input:focus,
.subservice-edit-page textarea.kx-input:focus {
    border-color: var(--kx-primary);
    box-shadow: 0 0 0 3px rgba(157, 56, 149, 0.12);
}

.subservice-edit-page .kx-help-block {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #D64545;
    font-weight: 600;
}

/* file input */
.subservice-edit-page .kx-file-input {
    width: 100%;
    border: 1px dashed var(--kx-border);
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    color: var(--kx-muted);
    background: var(--kx-page-bg);
    cursor: pointer;
    transition: border-color 0.2s ease, background 0.2s ease;
}

.subservice-edit-page .kx-file-input:hover {
    border-color: var(--kx-primary);
    background: #fff;
}

/* ---------- Buttons ---------- */
.subservice-edit-page .kx-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    padding-top: 6px;
}

.subservice-edit-page .kx-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 9px;
    border: 1px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, color 0.2s ease;
    line-height: 1.2;
}

.subservice-edit-page .kx-btn:hover {
    transform: translateY(-1px);
}

.subservice-edit-page .kx-btn-primary {
    background: linear-gradient(135deg, var(--kx-primary), var(--kx-primary-dark));
    color: #fff;
    box-shadow: 0 6px 16px rgba(157, 56, 149, 0.28);
}

.subservice-edit-page .kx-btn-primary:hover {
    color: #fff;
    box-shadow: 0 10px 22px rgba(157, 56, 149, 0.34);
}

.subservice-edit-page .kx-btn-success {
    background: #EAF8EF;
    color: #238B45;
    border-color: #CDEFDA;
}

.subservice-edit-page .kx-btn-success:hover {
    background: #238B45;
    color: #fff;
    box-shadow: 0 8px 18px rgba(35, 139, 69, 0.22);
}

.subservice-edit-page .kx-btn-danger {
    background: #FDECEC;
    color: #D64545;
    border-color: #F6C9C9;
}

.subservice-edit-page .kx-btn-danger:hover {
    background: #D64545;
    color: #fff;
    box-shadow: 0 8px 18px rgba(214, 69, 69, 0.22);
}

@media (max-width: 767px) {
    .subservice-edit-page .kx-page-head {
        flex-direction: column;
    }
    .subservice-edit-page .kx-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .subservice-edit-page .kx-field-label {
        flex: 0 0 100%;
        max-width: 100%;
        padding-top: 0;
    }
    .subservice-edit-page .kx-field-control {
        max-width: 100%;
    }
}
</style>

<div class="content-body subservice-edit-page">
    <div class="container-fluid">

        <div class="kx-page-head">
            <div class="kx-title-wrap">
                <div class="kx-title-icon"><i class="fa fa-sitemap"></i></div>
                <div>
                    <h4 class="kx-page-title">Hi, welcome {{Auth::user()->name}}!</h4>
                    <p class="kx-page-subtitle">
                        Update this sub-service's details below.
                        @if(Auth::user()->role_id==2)
                            &nbsp;&middot;&nbsp;Agent ID: {{Auth::user()->new_id}}
                        @endif
                    </p>
                </div>
            </div>
            <nav class="kx-breadcrumb">
                <a href="{{$base_url}}/admin/sub-services/all">Services</a> / <span class="kx-crumb-current">Edit {{$services->service_name}}</span>
            </nav>
        </div>

        @if(Auth::user()->kyc_status==0 && Auth::user()->role_id==2)
        <div class="kx-kyc-alert">
            <i class="fa fa-exclamation-circle"></i>
            <span>Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</span>
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="kx-card">
                    <div class="kx-card-header">
                        <div class="kx-card-header-left">
                            <div class="kx-card-icon"><i class="fa fa-pencil"></i></div>
                            <div>
                                <h4 class="kx-card-title">Edit {{$services->service_name}}</h4>
                                <p class="kx-card-subtitle">Update the images, service, name, URL, and description</p>
                            </div>
                        </div>
                        @if($services->status_id==0)
                        <span class="kx-status kx-status-inactive"><span class="kx-dot"></span>Inactive</span>
                        @else
                        <span class="kx-status kx-status-active"><span class="kx-dot"></span>Active</span>
                        @endif
                    </div>

                    <div class="kx-form-body">
                        <div class="kx-image-previews">
                            <div class="kx-image-preview-box">
                                <img src="{{$base_url}}/storage\app/{{$servicehierarchy->sub_service_image}}" id="current_product_image" onerror="this.src='{{$base_url}}/web-assets/images/resources/product.png';">
                            </div>
                            @if($servicehierarchy->sub_service_image_2)
                            <div class="kx-image-preview-box">
                                <img src="{{$base_url}}/storage/app/{{$servicehierarchy->sub_service_image_2}}">
                            </div>
                            @endif
                        </div>

                        <form class="" action="{{$services->service_id}}" method="post" enctype='multipart/form-data'>
                            @csrf

                            <div class="kx-field">
                                <label class="kx-field-label" for="sub_service_image">Sub Service Image/Logo <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('sub_service_image') ? ' has-error' : '' }}">
                                    <input type="file" class="kx-file-input" id="sub_service_image" name="sub_service_image">
                                    @if ($errors->has('sub_service_image'))
                                    <span class="kx-help-block">{{ $errors->first('sub_service_image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label">Sub Service Image 2</label>
                                <div class="kx-field-control">
                                    <input type="file" class="kx-file-input" name="sub_service_image_2">
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="val-skill">Select Service <span class="text-danger">*</span></label>
                                <div class="kx-field-control">
                                    <select name="service_id" id="main_service" class="kx-input" id="val-skill" name="gender" required>
                                        <option value="">Please select</option>
                                        @foreach($main_services as $service)
                                        <option value="{{$service->service_id}}">{{$service->service_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="sub_service_name">Sub Service Name <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('sub_service') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" id="sub_service_name" value="{{old('sub_service',$services->service_name)}}" name="sub_service" placeholder="Service Name">
                                    @if ($errors->has('sub_service'))
                                    <span class="kx-help-block">{{ $errors->first('sub_service') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="sub_service_url">Service URL <span class="text-danger">*</span></label>
                                <div class="kx-field-control {{ $errors->has('sub_service_url') ? ' has-error' : '' }}">
                                    <input type="text" class="kx-input" id="sub_service_url" value="{{old('sub_service_url',$services->service_url)}}" name="sub_service_url" placeholder="Service URL" required>
                                    @if ($errors->has('sub_service_url'))
                                    <span class="kx-help-block">{{ $errors->first('sub_service_url') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kx-field">
                                <label class="kx-field-label" for="val-suggestions">Description <span class="text-danger">*</span></label>
                                <div class="kx-field-control">
                                    <textarea class="kx-input" id="val-suggestions" name="description" rows="5" placeholder="What would you like to see?" required>{{old('description',$servicehierarchy->description)}}</textarea>
                                </div>
                            </div>

                            <div class="kx-field">
                                <div class="kx-field-label"></div>
                                <div class="kx-field-control kx-actions">
                                    <button name="save" type="submit" class="kx-btn kx-btn-primary"><i class="fa fa-check"></i> Submit</button>
                                    @if($services->status_id ==0)
                                    <button name="active" class="kx-btn kx-btn-success"><i class="fa fa-toggle-on"></i> Active</button>
                                    @endif
                                    @if($services->status_id ==1)
                                    <button name="inactive" class="kx-btn kx-btn-danger"><i class="fa fa-toggle-off"></i> In-Active</button>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script class="">
    $("#main_service option[value={{$servicehierarchy->parent_service->service_id}}]").prop('selected',true);

     $("#sub_service_name").keyup(function(){
    var Text = $(this).val();
        $("#sub_service_url").val(Text);
      });

      $( document ).ready(function() {
     <?php if(session()->has('success')){ ?>

         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection