@extends('layouts.admin-app')

@section('content')

<style>

.admin-content-wrapper {
    margin-left: 260px;
    padding-top: 120px;
    padding-left: 24px;
    padding-right: 24px;
}

@media (max-width: 991px) {
    .admin-content-wrapper {
        margin-left: 0;
    }
}

</style>

<div class="admin-content-wrapper">

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
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Send Notification</li>
    </ol>
</div>


</div>

<div class="card">
<div class="card-body">

<h4 class="mb-4">Send Push Notification</h4>

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form method="POST" action="/admin/send-notification">
@csrf

<div class="form-group mb-3">
<label>Notification Title</label>
<input type="text"
name="title"
class="form-control"
placeholder="Enter notification title"
required>
</div>

<div class="form-group mb-3">
<label>Notification Message</label>
<textarea
name="message"
class="form-control"
rows="4"
placeholder="Enter notification message"
required></textarea>
</div>

<button class="btn btn-primary">
Send Notification
</button>

</form>

</div>
</div>

</div>

@endsection
