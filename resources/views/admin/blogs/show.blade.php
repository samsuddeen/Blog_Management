@extends('admin.layouts.app')

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Blog Details</h4>
                            <a href="{{ route('blog.index') }}" class="btn btn-primary">Back to List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Blog Image -->
                                <div class="col-md-6">
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                                </div>

                                <!-- Blog Details Table -->
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $blog->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $blog->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>Content</th>
                                            <td>{!! $blog->content !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $blog->category->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Meta Title</th>
                                            <td>{{ $blog->meta_title ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Meta Description</th>
                                            <td>{{ $blog->meta_description ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Meta Keywords</th>
                                            <td>{{ $blog->meta_keywords ?? '' }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge {{ $blog->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $blog->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created By</th>
                                            <td>{{ $blog->user->name ?? 'Admin' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $blog->created_at->format('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $blog->updated_at->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- card-body end -->
                    </div> <!-- card end -->
                </div> <!-- col end -->
            </div> <!-- row end -->
        </div> <!-- container-fluid end -->
    </div> <!-- app-content-area end -->
</div> <!-- app-content end -->
@endsection
