@extends('layouts.admin-app')
@section('content')

<style>
   #icon {
  font-size: 28px;
  margin-left: 51px;
  /* padding: 12px; */
  color: lightgreen;
}
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    @if(Auth::user() != null)
                    <h4>Hi, welcome {{ Auth::user()->name }}!</h4>
                    @if(Auth::user()->role_id == 2)
                    <p class="mb-0">Agent ID: {{ Auth::user()->new_id }}</p>
                    @endif
                    @endif
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Document Upload</a></li>
                </ol>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Name - {{ $loan->full_name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <div class="row">

                                @if($loan->bank_service==53)
                                <div class="col-xl-6">
                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                       @if($gstlending!=null)
                                       <div class="image-container">
                                        <iframe id="img1" style="max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$gstlending->document}}" alt=""></iframe>
                                        <button id="" class="btn btn-danger delete-button" onclick="deleteImage('gstlending', this.id)">Delete & Update</button>
                                        </div>                                    
                                        @else
                                        <iframe id="img1" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt=""></iframe>
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">GST Certificate<span class="text-danger">*</span></label>
                                            <input id="input1" type="file" class="form-control" id="val-phoneus" name="GSTCertification-RegProof">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary upload-button" data-file-type="GSTCertification-RegProof" name="GSTCertification-RegProof" type="submit" onclick="handleUpload('GSTCertification-RegProof')">Upload</button>
                                            </div>
                                            <span id="status-icon-GSTCertification-RegProof"></span>
    
                                            @if ($errors->has('GSTCertification-RegProof'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('GSTCertification-RegProof') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                        @if($pancardlending!=null)
                                        <div class="image-container">
                                        <iframe id="img2" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$pancardlending->document}}" alt=""></iframe>
                                        <button id="" class="btn btn-danger delete-button" onclick="deleteImage('PanCard-Personal', this.id)">Delete & Update</button>
                                        </div>
                                        @else
                                        <iframe id="img2" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt=""></iframe>
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">PAN Card<span class="text-danger">*</span></label>
                                            <input id="input2" type="file" class="form-control" id="val-phoneus" name="pancard1">
                                            <div class="input-group-append">
                                                <button  class="btn btn-primary upload-button" data-file-type="PanCard-Personal" name="PanCard-Personal" type="submit" onclick="handleUpload('PanCard-Personal')">Upload</button>
                                            </div>
                                            <span id="status-icon-PanCard-Personal"></span>
                                            @if ($errors->has('PanCard-Personal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('PanCard-Personal') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                        @if($bankStatementlending!=null)
                                        <div class="image-container">
                                        <iframe id="img3" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$bankStatementlending->document}}" alt=""></iframe>
                                        <button id="" class="btn btn-danger delete-button" onclick="deleteImage('pancard', this.id)">Delete & Update</button>
                                        </div>
                                        @else
                                        <iframe id="img3" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt=""></iframe>
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">Bank Statement<span class="text-danger">*</span></label>
                                            <input id="input3" type="file" class="form-control" id="val-phoneus" name="BankStatement-Company">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary upload-button" data-file-type="BankStatement-Company" name="BankStatement-Company" type="submit" onclick="handleUpload('BankStatement-Company')">Upload</button>
                                            </div>
                                            <span id="status-icon-BankStatement-Company"></span>
    
                                            @if($errors->has('BankStatement-Company'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('BankStatement-Company') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <a href="{{$base_url}}/admin/services/1" class="btn btn-primary">Save And Submit</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                               
                                @if($loan->bank_service==56)
                                <div class="col-xl-6">
                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                       @if($profile!=null)
                                       <div class="image-container">
                                        <img id="img1" style="max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$profile->document}}" alt="">
                                        <button id="{{$profile->check_sum}}" class="btn btn-danger delete-button" onclick="deleteImage('profile', this.id)">Delete & Update</button>
                                        </div>                                    
                                        @else
                                        <img id="img1" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt="">
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">Profile Picture<span class="text-danger">*</span></label>
                                            <input id="input1" type="file" class="form-control" id="val-phoneus" name="profile1">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary upload-button" data-file-type="profile" name="profile" type="submit" onclick="handleUpload('profile')">Upload</button>
                                            </div>
                                            <span id="status-icon-profile"></span>
    
                                            @if ($errors->has('profile'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('profile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                        @if($pancard!=null)
                                        <div class="image-container">
                                        <img id="img2" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$pancard->document}}" alt="">
                                        <button id="{{$pancard->check_sum}}" class="btn btn-danger delete-button" onclick="deleteImage('pancard', this.id)">Delete & Update</button>
                                        </div>
                                        @else
                                        <img id="img2" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt="">
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">PAN Card<span class="text-danger">*</span></label>
                                            <input id="input2" type="file" class="form-control" id="val-phoneus" name="pancard1">
                                            <div class="input-group-append">
                                                <button  class="btn btn-primary upload-button" data-file-type="pancard" name="pancard" type="submit" onclick="handleUpload('pancard')">Upload</button>
                                            </div>
                                            <span id="status-icon-pancard"></span>
                                            @if ($errors->has('pancard1'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pancard1') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="input-group mb-3">
                                        <label class="col-lg-4 col-form-label" for="val-phoneus"></label>
                                        @if($bankStatement!=null)
                                        <div class="image-container">
                                        <iframe id="img3" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/storage\app/{{$bankStatement->document}}" alt=""></iframe>
                                        <button id="{{$bankStatement->check_sum}}" class="btn btn-danger delete-button" onclick="deleteImage('pancard', this.id)">Delete & Update</button>
                                        </div>
                                        @else
                                        <iframe id="img3" style="margin:auto;max-height:200px;max-width:200px;" src="{{ $base_url }}/web-assets/images/resources/product.png" alt=""></iframe>
                                        <div class="input-group mb-3">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">Bank Statement<span class="text-danger">*</span></label>
                                            <input id="input3" type="file" class="form-control" id="val-phoneus" name="bankStatement">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary upload-button" data-file-type="bankStatement" name="bankStatement" type="submit" onclick="handleUpload('bankStatement')">Upload</button>
                                            </div>
                                            <span id="status-icon-bankStatement"></span>
    
                                            @if($errors->has('bankStatement'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bankStatement') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    

                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <a href="{{$base_url}}/admin/services/1" class="btn btn-primary">Save And Submit</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-xl-6"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">
        <script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
        <script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
        @if($loan->bank_service==53)
        <script>
            function deleteImage(fileType, id) {
                // Make an AJAX request to delete the image from the database
                axios.post("{{$base_url}}/admin/document-load/delete", {
                    file_type: fileType,
                    _csrf: "{{ csrf_token() }}",
                    id: id
                })
                .then(response => {
                    // Handle the success response if needed
                    console.log(response.data);
                    if (response.data.statusCode === 200) {
                        toastr.success("Image deleted successfully.");
                        // Remove the image element from the DOM
                        let imageContainer = document.querySelector('.image-container');
                        imageContainer.parentNode.removeChild(imageContainer);
                    } else {
                        toastr.error("Failed to delete image.");
                    }
                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error(error);
                });
            }
        </script>
        <script>
            let img1 = document.getElementById('img1');
            let input1 = document.getElementById('input1');

            let img2 = document.getElementById('img2');
            let input2 = document.getElementById('input2');

            let img3 = document.getElementById('img3');
            let input3 = document.getElementById('input3');

            input1.onchange = () => {
                if (input1 && input1.files && input1.files[0]) {
                    img1.src = URL.createObjectURL(input1.files[0]);
                }
            }

            input2.onchange = () => {
                if (input2 && input2.files && input2.files[0]) {
                    img2.src = URL.createObjectURL(input2.files[0]);
                }
            }

            input3.onchange = () => {
                if (input3 && input3.files && input3.files[0]) {
                    img3.src = URL.createObjectURL(input3.files[0]);
                }
            }
            function handleUpload(fileType) {
                let file;
                let input;

                if (fileType === 'GSTCertification-RegProof') {
                    file = input1.files[0];
                    input = input1;
                } else if (fileType === 'PanCard-Personal') {
                    file = input2.files[0];
                    input = input2;
                } else if (fileType === 'BankStatement-Company') {
                    file = input3.files[0];
                    input = input3;
                }

                if (file) {
                    if (validateFileType(fileType, file)) {
                    uploadFile(file, fileType);
                    } else {
                    toastr.error(`Invalid file format for ${fileType}`);
                    }
                } else {
                    toastr.error(`No file selected for ${fileType}`);
                }
            }
            function validateFileType(fileType, file) {
            if (fileType === 'GSTCertification-RegProof' || fileType === 'PanCard-Personal' || fileType === 'BankStatement-Company') {
            const allowedFormats = ['jpg', 'pdf', 'jpeg', 'png', 'xlsx', 'xls', 'doc'];
            const fileExtension = getFileExtension(file.name);

            return allowedFormats.includes(fileExtension.toLowerCase());
            } 

            return false;
            }
            function getFileExtension(filename) {
                return filename.split('.').pop();
            }

            function showPreview(inputId, imageId) {
                const input = document.getElementById(inputId);
                const image = document.getElementById(imageId);

                if (input && input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                }
            }

            // Show status icon based on upload result
            function showStatusIcon(fileType, success) {
                let icon = document.getElementById('status-icon-' + fileType);
                if (icon) {
                    icon.innerHTML = success ? '<i id="icon" class="fa fa-check"></i>' : '<i id="icon" class="fa fa-times"></i>';
                }
            }

            function uploadFile(file, fileType) {
                let formData = new FormData();
                formData.append('file', file);
                formData.append('file_type', fileType);

                axios.post("{{ $loan->response_id }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        // Handle the success response if needed
                        console.log(response.data);
                        if( response.data.statusCode === 200){
                            toastr.success("Thank You. Your documents have been uploaded successfully.You can monitor status of your application in Loan report section");
                        }
                        showStatusIcon(fileType, response.data.statusCode === 200);
                    })
                    .catch(error => {
                        // Handle the error response if needed
                        console.error(error);
                    });
                    setTimeout(function() {
            const statusCode = 200; // Replace with actual status code from the backend response
            showStatusIcon(fileType, statusCode === 200);
            }, 2000); // Adjust the delay as needed
            }
        </script>
        @endif
        @if($loan->bank_service==56)
        <script>
            function deleteImage(fileType, id) {
                // Make an AJAX request to delete the image from the database
                axios.post("{{$base_url}}/admin/document-load/delete", {
                    file_type: fileType,
                    _csrf: "{{ csrf_token() }}",
                    id: id
                })
                .then(response => {
                    // Handle the success response if needed
                    console.log(response.data);
                    if (response.data.statusCode === 200) {
                        toastr.success("Image deleted successfully.");
                        // Remove the image element from the DOM
                        let imageContainer = document.querySelector('.image-container');
                        imageContainer.parentNode.removeChild(imageContainer);
                    } else {
                        toastr.error("Failed to delete image.");
                    }
                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error(error);
                });
            }
        </script>
        <script>
            let img1 = document.getElementById('img1');
            let input1 = document.getElementById('input1');

            let img2 = document.getElementById('img2');
            let input2 = document.getElementById('input2');

            let img3 = document.getElementById('img3');
            let input3 = document.getElementById('input3');

            input1.onchange = () => {
                if (input1 && input1.files && input1.files[0]) {
                    img1.src = URL.createObjectURL(input1.files[0]);
                }
            }

            input2.onchange = () => {
                if (input2 && input2.files && input2.files[0]) {
                    img2.src = URL.createObjectURL(input2.files[0]);
                }
            }

            input3.onchange = () => {
                if (input3 && input3.files && input3.files[0]) {
                    img3.src = URL.createObjectURL(input3.files[0]);
                }
            }
            function handleUpload(fileType) {
                let file;
                let input;

                if (fileType === 'profile') {
                    file = input1.files[0];
                    input = input1;
                } else if (fileType === 'pancard') {
                    file = input2.files[0];
                    input = input2;
                } else if (fileType === 'bankStatement') {
                    file = input3.files[0];
                    input = input3;
                }

                if (file) {
                    if (validateFileType(fileType, file)) {
                    uploadFile(file, fileType);
                    } else {
                    toastr.error(`Invalid file format for ${fileType}`);
                    }
                } else {
                    toastr.error(`No file selected for ${fileType}`);
                }
            }
            function validateFileType(fileType, file) {
            if (fileType === 'profile' || fileType === 'pancard') {
            const allowedFormats = ['jpeg', 'jpg'];
            const fileExtension = getFileExtension(file.name);

            return allowedFormats.includes(fileExtension.toLowerCase());
            } else if (fileType === 'bankStatement') {
            const allowedFormat = 'pdf';
            const fileExtension = getFileExtension(file.name);

            return fileExtension.toLowerCase() === allowedFormat;
            }

            return false;
            }
            function getFileExtension(filename) {
                return filename.split('.').pop();
            }

            function showPreview(inputId, imageId) {
                const input = document.getElementById(inputId);
                const image = document.getElementById(imageId);

                if (input && input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                }
            }

            // Show status icon based on upload result
            function showStatusIcon(fileType, success) {
                let icon = document.getElementById('status-icon-' + fileType);
                if (icon) {
                    icon.innerHTML = success ? '<i id="icon" class="fa fa-check"></i>' : '<i id="icon" class="fa fa-times"></i>';
                }
            }

            function uploadFile(file, fileType) {
                let formData = new FormData();
                formData.append('file', file);
                formData.append('file_type', fileType);

                axios.post("{{ $loan->response_id }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => {
                        // Handle the success response if needed
                        console.log(response.data);
                        if( response.data.statusCode === 200){
                            toastr.success("Document Uploaded Successfully.");
                        }
                        showStatusIcon(fileType, response.data.statusCode === 200);
                    })
                    .catch(error => {
                        // Handle the error response if needed
                        console.error(error);
                    });
                    setTimeout(function() {
            const statusCode = 200; // Replace with actual status code from the backend response
            showStatusIcon(fileType, statusCode === 200);
            }, 2000); // Adjust the delay as needed
            }
        </script>
        @endif

<script class="">
    @if(session()->has('success'))
    swal("Congratulations !!", "{{ Session::get('success') }}", "success");
    @php
        session()->forget('success');
    @endphp
    @endif
    @if(session()->has('error'))
    swal("OHH !!", "{{ Session::get('error') }}", "error");
    @php
        session()->forget('error');
    @endphp
    @endif
</script>

@endsection
