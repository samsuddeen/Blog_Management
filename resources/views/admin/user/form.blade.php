@extends('admin.layouts.app')
@section('content')

<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="mb-5">
                        <h3 class="mb-0">{{ isset($user) ? 'Edit User' : 'Add User' }}</h3>
                    </div>
                </div>
            </div>
            <div>
                <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
                    method="POST"
                    enctype="multipart/form-data">
                  @csrf
                  @if(isset($user))
                      @method('PUT')
                  @endif
                <div class="row">
                    <div class="col-lg-8 col-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label">Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
                                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <label class="form-label">Email <span style="color: red">*</span></label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
                                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password <span style="color: red">*</span></label>

                                        @if(isset($user))
                                            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                        @else
                                            <input type="password" name="password" class="form-control" required>
                                        @endif

                                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role <span style="color: red">*</span></label>
                                        <select class="form-select" name="role" required>
                                            <option value="" disabled selected>Select Role</option>
                                            <option value="admin" {{ isset($user) && $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ isset($user) && $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('role') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="col-lg-4 col-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ old('status', $user->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $user->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>



                            </div>
                        </div>



                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($user) ? 'Update' : 'Create' }} User
                                </button>
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
