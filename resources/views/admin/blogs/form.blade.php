@extends('admin.layouts.app')
@section('content')

<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="mb-5">
                        <h3 class="mb-0">{{ isset($blog) ? 'Edit Blog' : 'Add Blog' }}</h3>
                    </div>
                </div>
            </div>
            <div>
                <form action="{{ isset($blog) ? route('blog.update', $blog->id) : route('blog.store') }}"
                    method="POST" enctype="multipart/form-data">
                  @csrf
                  @if(isset($blog))
                      @method('PUT')
                  @endif
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" >
                                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="editor1" name="content" rows="6">{{ old('content', $blog->content ?? '') }}</textarea>
                                    @error('content') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select" name="category_id" >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ @$category->id }}" {{ isset($blog) && $blog->category_id == $category->id ? 'selected' : '' }}>{{ @$category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="1" {{ isset($blog) && $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ isset($blog) && $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $blog->meta_title ?? '') }}" placeholder="Enter meta title">
                                    @error('meta_title') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}" placeholder="Enter meta keywords">
                                    @error('meta_keywords') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" rows="3">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                    @error('meta_description') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-4">
                                    <h4 class="mb-4">Featured Image</h4>
                                    <div class="input-group">
                                        <input id="thumbnail" class="form-control" type="text" name="image" value="{{ old('image', $blog->image ?? '') }}" >
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                <i class="fa-solid fa-image"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <img id="holder" src="{{ old('image', $blog->image ?? '') }}" style="margin-top:15px;max-height:100px;">
                                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($blog) ? 'Update' : 'Create' }} Blog
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#lfm').filemanager('image');

        $('#thumbnail').on('change', function () {
            var imageUrl = $(this).val();
            if (imageUrl) {
                $('#holder').attr('src', imageUrl).show();
            } else {
                $('#holder').hide();
            }
        });
    });
</script>
    <script>
    CKEDITOR.replace('editor1');
</script>
@endpush
