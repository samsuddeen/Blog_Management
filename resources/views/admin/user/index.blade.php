@extends('admin.layouts.app')
@section('content')

@push('style')
<style>

    .custom-toggle .form-check-input {
        width: 50px;
        height: 25px;
        cursor: pointer;
        border: 2px solid #ddd;
        background-color: #ccc;
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .custom-toggle .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }

    .custom-toggle .status-label {
        font-size: 14px;
        font-weight: 600;
        margin-left: 10px;
        color: #333;
    }
</style>

@endpush

    <div id="app-content">
        <!-- Container fluid -->
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="mb-5">
                            <h3 class="mb-0">User List</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex border-bottom-0">
                                    <div class="flex-grow-1">
                                        <a href="{{ route('user.create') }}" class="btn btn-primary">+ Add User</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table id="slidertable" class="table text-nowrap table-centered mt-0"
                                            style="width: 100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="pe-0">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="checkAll" />
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th>Name</th>
                                                    <th >Email</th>
                                                    <th>Added Date</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($users) > 0)
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="pe-0">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="contactCheckbox2" />
                                                                    <label class="form-check-label"
                                                                        for="contactCheckbox2"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ms-3">
                                                                    <h5 class="mb-0">
                                                                        <a href="#!"
                                                                            class="text-inherit">{{ $user->name }}</a>
                                                                    </h5>
                                                                    {{-- <p class="text-muted mb-0">{{ $user->subtitle }}</p> --}}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="ms-3">
                                                                    <h5 class="mb-0">
                                                                        <a href="#!"
                                                                            class="text-inherit">{{ $user->email }}</a>
                                                                    </h5>
                                                                    {{-- <p class="text-muted mb-0">{{ $user->subtitle }}</p> --}}
                                                                </div>
                                                            </td>
                                                            {{-- <td class="ps-0">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset($user->image) }}"
                                                                        alt="{{ $user->title }}"
                                                                        class="img-4by3-sm rounded-3" />

                                                                </div>
                                                            </td> --}}
                                                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                                                            <td>{{ $user->role ?? '' }}</td>
                                                            {{-- <td>
                                                                <a href="javascript:void(0);"
                                                                   class="badge status-badge {{ $user->status ? 'badge-success-soft' : 'badge-danger-soft' }}"
                                                                   data-id="{{ $user->id }}"
                                                                   data-status="{{ $user->status }}">
                                                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                                                </a>
                                                            </td> --}}




                                                            {{-- <td>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input toggle-status" type="checkbox"
                                                                           data-id="{{ $user->id }}"
                                                                           {{ $user->status ? 'checked' : '' }}>
                                                                </div>
                                                            </td> --}}

                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch custom-toggle">
                                                                        <input class="form-check-input toggle-status" type="checkbox"
                                                                               data-id="{{ $user->id }}"
                                                                               id="toggle-{{ $user->id }}"
                                                                               {{ $user->status ? 'checked' : '' }}>
                                                                        {{-- <label class="form-check-label status-label" for="toggle-{{ $user->id }}">
                                                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                                                        </label> --}}
                                                                    </div>
                                                                </div>
                                                            </td>



                                                            <td>
                                                                {{-- <a href="{{ route('user.show', $user->id) }}"
                                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                    data-template="eyeOne">
                                                                    <i data-feather="eye" class="icon-xs"></i>
                                                                    <div id="eyeOne" class="d-none">
                                                                        <span>View</span>
                                                                    </div>
                                                                </a> --}}
                                                                <a href="{{ route('user.edit', $user->id) }}"
                                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                    data-template="editOne">
                                                                    <i data-feather="edit" class="icon-xs"></i>
                                                                    <div id="editOne" class="d-none">
                                                                        <span>Edit</span>
                                                                    </div>
                                                                </a>


                                                                <form action="{{ route('user.destroy', $user->id) }}"
                                                                    method="POST" style="display:inline;"
                                                                    class="delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip">
                                                                        <i data-feather="trash-2" class="icon-xs"></i>
                                                                    </button>
                                                                </form>


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            <p class="text-muted">No records found.</p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')


    <script type="text/javascript">
        $(document).ready(function() {

            var table = $("#slidertable").DataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });


            $('.delete-form').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.off('submit').submit();
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function(){
            $(document).on('click', '.status-badge', function(){
                let badge = $(this);
                let sliderId = badge.data('id');
                let newstatus = badge.data('status') == 1 ? 0 : 1;

                $.ajax({
                    url: `{{ url('admin/change-status') }}/${sliderId}`,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newstatus
                    },
                    success: function(response) {
                        if (response.status) {
                            // Update badge status
                            badge.data('status', newstatus);
                            badge.removeClass('badge-success-soft badge-danger-soft')
                                 .addClass(newstatus ? 'badge-success-soft' : 'badge-danger-soft')
                                 .text(newstatus ? 'Active' : 'Inactive');

                            // Show success message
                            toastr.success('Status Changed Successfully', 'Success', {
                                timeOut: 3000,
                                progressBar: true
                            });
                        }
                    },
                    error: function() {
                        toastr.error('Failed to update status!', 'Error', {
                            timeOut: 3000,
                            progressBar: true
                        });
                    }
                });
            });
        });
    </script> --}}

    <script>
        $(document).ready(function(){
            $(document).on('change', '.toggle-status', function(){
                let toggleSwitch = $(this);
                let userId = toggleSwitch.data('id');
                let newStatus = toggleSwitch.prop('checked') ? 1 : 0;

                $.ajax({
                    url: `{{ url('admin/user/change-status') }}/${userId}`,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.status) {
                            toastr.success('Status Updated Successfully', 'Success', {
                                timeOut: 3000,
                                progressBar: true
                            });
                        } else {
                            toastr.error('Failed to update status!', 'Error', {
                                timeOut: 3000,
                                progressBar: true
                            });
                            toggleSwitch.prop('checked', !newStatus); // Revert switch if error
                        }
                    },
                    error: function() {
                        toastr.error('Failed to update status!', 'Error', {
                            timeOut: 3000,
                            progressBar: true
                        });
                        toggleSwitch.prop('checked', !newStatus);
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function(){
            $(document).on('change', '.toggle-status', function(){
                let toggleSwitch = $(this);
                let sliderId = toggleSwitch.data('id');
                let newStatus = toggleSwitch.prop('checked') ? 1 : 0;
                let statusLabel = toggleSwitch.closest('.custom-toggle').find('.status-label');

                $.ajax({
                    url: `{{ url('admin/change-status') }}/${sliderId}`,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.status) {
                            statusLabel.text(newStatus ? 'Active' : 'Inactive'); // Update status text
                            toastr.success('Status Updated Successfully', 'Success', {
                                timeOut: 3000,
                                progressBar: true
                            });
                        } else {
                            toastr.error('Failed to update status!', 'Error', {
                                timeOut: 3000,
                                progressBar: true
                            });
                            toggleSwitch.prop('checked', !newStatus);
                        }
                    },
                    error: function() {
                        toastr.error('Failed to update status!', 'Error', {
                            timeOut: 3000,
                            progressBar: true
                        });
                        toggleSwitch.prop('checked', !newStatus);
                    }
                });
            });
        });
    </script> --}}




@endpush
