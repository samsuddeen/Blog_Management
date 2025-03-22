@extends('admin.layouts.app')
@section('content')

<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="mb-5">
                        <h3 class="mb-0">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h3>
                    </div>
                </div>
            </div>
            <div>
                <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                  @csrf
                  @if(isset($category))
                      @method('PUT')
                  @endif
                <div class="row">
                    <div class="col-lg-8 col-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" >
                                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="1" {{ isset($category) && $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ isset($category) && $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                            <button type="submit" class="btn btn-primary">
                                                {{ isset($category) ? 'Update' : 'Create' }} Category
                                            </button>
                                </div>
                            </div>
                        </div>




                        </form>
                    </div>
                </div>
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
@endpush
