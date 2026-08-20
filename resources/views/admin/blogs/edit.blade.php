@extends('layouts.admin-app')

@section('title', 'Edit Blog')

@section('content')
<style>
.admin-content-wrapper{
    margin-left:260px;
    padding-top:150px;
    padding-left:24px;
    padding-right:24px;
}
@media(max-width:991px){
    .admin-content-wrapper{margin-left:0}
}

.form-label{
    font-weight:600;
    color:#1f2937;
}

.form-control,
.form-select,
textarea{
    border-radius:8px;
}

.section-title{
    font-size:16px;
    font-weight:700;
    color:#0B0D3E;
    margin-bottom:12px;
}

.helper-text{
    font-size:12px;
    color:#6b7280;
}
</style>

<div class="admin-content-wrapper">
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Blog</h4>

        <a href="{{ route('admin.blogs.index') }}"
           class="btn btn-outline-secondary btn-sm">
            ← Back to Blogs
        </a>
    </div>

    <!-- FORM -->
    <form method="POST"
          action="{{ route('admin.blogs.update', $blog->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- LEFT COLUMN -->
            <div class="col-lg-8">

                <div class="card mb-4">
                    <div class="card-body">

                        <!-- TITLE -->
                        <div class="mb-3">
                            <label class="form-label">Blog Title *</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $blog->title) }}"
                                   required>
                        </div>

                        <!-- SLUG -->
                        <div class="mb-3">
                            <label class="form-label">Slug *</label>
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   value="{{ old('slug', $blog->slug) }}"
                                   required>
                            <div class="helper-text">
                                URL: /blog/<strong>{{ $blog->slug }}</strong>
                            </div>
                        </div>

                        <!-- EXCERPT -->
                        <div class="mb-3">
                            <label class="form-label">Excerpt</label>
                            <textarea name="excerpt"
                                      class="form-control"
                                      rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        </div>

                        <!-- CONTENT -->
                        <div class="mb-3">
                            <label class="form-label">Blog Content *</label>
                            <textarea name="content"
                                      class="form-control"
                                      rows="10"
                                      required>{{ old('content', $blog->content) }}</textarea>
                            <div class="helper-text">
                                HTML supported (editor can be added later)
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-lg-4">

                <!-- PUBLISH SETTINGS -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">Publish Settings</div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $blog->status ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="0" {{ !$blog->status ? 'selected' : '' }}>
                                    Draft
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Publish Date</label>
                            <input type="datetime-local"
                                   name="published_at"
                                   class="form-control"
                                   value="{{ optional($blog->published_at)->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                </div>

                <!-- FEATURED IMAGE -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">Featured Image</div>

                        @if($blog->featured_image)
                            <div class="mb-2">
                                <img src="{{ asset($blog->featured_image) }}"
                                     alt="Featured Image"
                                     style="width:100%;border-radius:8px">
                            </div>
                        @endif

                        <input type="file"
                               name="featured_image"
                               class="form-control">
                    </div>
                </div>

                <!-- SEO SETTINGS -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">SEO Settings</div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text"
                                   name="meta_title"
                                   class="form-control"
                                   value="{{ old('meta_title', $blog->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description"
                                      class="form-control"
                                      rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text"
                                   name="meta_keywords"
                                   class="form-control"
                                   value="{{ old('meta_keywords', $blog->meta_keywords) }}">
                        </div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="card">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-primary">
                            Update Blog
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
</div>
@endsection
