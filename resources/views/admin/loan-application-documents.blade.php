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

    .doc-box {
        border: 1px dashed #d1d5db;
        border-radius: 6px;
        padding: 16px;
        background: #f9fafb;
    }

    .doc-status {
        font-size: 13px;
        font-weight: 500;
    }
</style>

<div class="admin-content-wrapper">

    {{-- Header --}}
    <div class="row page-titles mx-0 mb-3">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Upload Documents</h4>
                <p class="mb-0 text-muted">
                    Loan Application ID: {{ $application->id }}
                </p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.loan.applications') }}">Loan Applications</a>
                </li>
                <li class="breadcrumb-item active">
                    Upload Documents
                </li>
            </ol>
        </div>
    </div>

    {{-- Card --}}
    <div class="card">
        <div class="card-body">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('loan-applications.upload-documents', $application->id) }}"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="row g-4">

                    {{-- Aadhaar --}}
                    <div class="col-md-4">
                        <div class="doc-box">
                            <label class="form-label fw-semibold">Aadhaar Card</label>
                            <input type="file" name="aadhaar_document" class="form-control mt-2">

                            <div class="mt-2 doc-status">
                                @if($application->aadhaar_document)
                                    <span class="text-success">✔ Uploaded</span>
                                @else
                                    <span class="text-muted">Not uploaded</span>
                                @endif
                            </div>
                            <a href="{{ url('/admin/loan-applications/'.$application->id.'/document/aadhaar') }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mt-2">
                               View
                            </a>

                        </div>
                        
                    </div>

                    {{-- PAN --}}
                    <div class="col-md-4">
                        <div class="doc-box">
                            <label class="form-label fw-semibold">PAN Card</label>
                            <input type="file" name="pan_document" class="form-control mt-2">

                            <div class="mt-2 doc-status">
                                @if($application->pan_document)
                                    <span class="text-success">✔ Uploaded</span>
                                @else
                                    <span class="text-muted">Not uploaded</span>
                                @endif
                            </div>
                            <a href="{{ url('/admin/loan-applications/'.$application->id.'/document/pan') }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mt-2">
                               View
                            </a>

                        </div>
                    </div>

                    {{-- Income Certificate --}}
                    <div class="col-md-4">
                        <div class="doc-box">
                            <label class="form-label fw-semibold">Income Certificate</label>
                            <input type="file" name="income_certificate" class="form-control mt-2">

                            <div class="mt-2 doc-status">
                                @if($application->income_certificate)
                                    <span class="text-success">✔ Uploaded</span>
                                @else
                                    <span class="text-muted">Not uploaded</span>
                                @endif
                            </div>
                            <a href="{{ url('/admin/loan-applications/'.$application->id.'/document/aadhaar') }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary mt-2">
                               View
                            </a>

                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.loan.applications') }}"
                       class="btn btn-secondary">
                        Back
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Save Documents
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
