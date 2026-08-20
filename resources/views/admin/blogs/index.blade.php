@extends('layouts.admin-app')

@section('title', 'Manage Blogs')

@section('content')

<link rel="stylesheet" href="{{$base_url}}/vendor/toastr/css/toastr.min.css">

<style>
    .table-scroll{
        max-height:420px;
        overflow:auto;
    }
    .table th,.table td{
        white-space:nowrap;
    }
    /* Sticky header */
    .table thead th{
        position:sticky;
        top:0;
        z-index:2;
        background-color:#eef2f7;
        color:#1f2937;
        font-weight:600;
        border-bottom:2px solid #d1d5db;
    }
    /* Body */
    .table tbody td{
        color:#374151;
        background:#ffffff;
    }
    .table tbody tr:nth-child(even) td{
        background:#f9fafb;
    }
    .table-hover tbody tr:hover td{
        background:#eef6ff;
    }
</style>

<div class="content-body">
    <div class="container-fluid">

        <!-- PAGE HEADER (same structure as Bank list page-titles row) -->
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Blogs</h4>
                    <p class="mb-0">Create, edit &amp; publish blog articles</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm" style="color:#fff;">
                            + Add New Blog
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-scroll table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Published At</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @forelse($blogs as $blog)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $blog->title }}</strong>
                                            @if($blog->excerpt)
                                                <div class="text-muted small" style="max-width:260px">
                                                    {{ Str::limit($blog->excerpt, 80) }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="text-muted">
                                            {{ $blog->slug }}
                                        </td>

                                        <td>
                                            @if($blog->status)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ optional($blog->published_at)->format('d M Y') ?? '-' }}
                                        </td>

                                        <td class="text-end">

                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this blog? This action cannot be undone.')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            No blogs found.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>

                            </table>
                        </div>

                        <!-- PAGINATION (if you use paginate later) -->
                        @if(method_exists($blogs, 'links'))
                            <div class="mt-3 d-flex justify-content-end">
                                {{ $blogs->links() }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{$base_url}}/vendordashboard/toastr/js/toastr.min.js"></script>
<script src="{{$base_url}}/js/plugins-init/toastr-init.js"></script>
<script>
   $( document ).ready(function() {
    @if(session('success'))
    toastr.success("{{Session::get('success')}}", "Success!", {
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    positionClass: "toast-top-right",
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                })
    @endif
    @php
    session()->forget('success');
    @endphp
});
</script>

@endsection