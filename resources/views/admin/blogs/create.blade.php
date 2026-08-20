@extends('layouts.admin-app')

@section('title', 'Add New Blog')

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

.form-control, .form-select, textarea{
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
        <h4 class="mb-0">Add New Blog</h4>

        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Blogs
        </a>
    </div>

    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="row">

            <!-- LEFT: CONTENT -->
            <div class="col-lg-8">

                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Blog Title *</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   placeholder="Enter blog title"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug *</label>
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   placeholder="example-blog-title"
                                   required>
                            <div class="helper-text">
                                Used in URL: /blog/<strong>slug</strong>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Excerpt (Short Summary)</label>
                            <textarea name="excerpt"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Short description for listing & SEO"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Blog Content *</label>
                            <textarea name="content"
                                      class="form-control"
                                      rows="10"
                                      placeholder="Write full blog content here..."
                                      required></textarea>
                            <div class="helper-text">
                                (HTML supported – we’ll add editor later)
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT: SEO & SETTINGS -->
            <div class="col-lg-4">

                <!-- PUBLISH -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">Publish Settings</div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Publish Date</label>
                            <input type="datetime-local"
                                   name="published_at"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <!-- FEATURED IMAGE -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">Featured Image</div>

                        <input type="file"
                               name="featured_image"
                               class="form-control">
                    </div>
                </div>

                <!-- SEO -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-title">SEO Settings</div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text"
                                   name="meta_title"
                                   class="form-control"
                                   placeholder="SEO title (60 chars)">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="SEO description (160 chars)"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text"
                                   name="meta_keywords"
                                   class="form-control"
                                   placeholder="loan, finance, credit">
                        </div>
                    </div>
                </div>

                <!-- ACTION -->
                <div class="card">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-primary">
                            Save Blog
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
</div>
@endsection
