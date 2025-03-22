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
                            <h3 class="mb-0">Blogs List</h3>
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
                                        <a href="{{ route('blog.create') }}" class="btn btn-primary">+ Add blog</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table id="blogtable" class="table text-nowrap table-centered mt-0"
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
                                                    <th>Title</th>
                                                    <th class="ps-1">blog</th>

                                                    <th>Category</th>
                                                    <th>Added Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($blogs) > 0)
                                                    @foreach ($blogs as $blog)
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
                                                                            class="text-inherit">{{ $blog->title }}</a>
                                                                    </h5>
                                                                    {{-- <p class="text-muted mb-0">{{ $blog->subtitle }}</p> --}}
                                                                </div>
                                                            </td>
                                                            <td class="ps-0">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset($blog->image) }}"
                                                                        alt="{{ $blog->title }}"
                                                                        class="img-4by3-sm rounded-3" />

                                                                </div>
                                                            </td>
                                                            <td>{{ $blog->category->name ?? '' }}</td>
                                                            <td>{{ $blog->created_at->format('d M, Y') }}</td>
                                                            {{-- <td>
                                                                <a href="javascript:void();"
                                                                    class="badge badge-status {{ $blog->status ? 'badge-success-soft' : 'badge-danger-soft' }}"
                                                                    data-id="{{ $blog->id }}" data-status="{{ $blog->status }}" >
                                                                    {{ $blog->status ? 'Active' : 'Inactive' }}
                                                                </a>
                                                            </td> --}}

                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch custom-toggle">
                                                                        <input class="form-check-input toggle-status" type="checkbox"
                                                                               data-id="{{ $blog->id }}"
                                                                               id="toggle-{{ $blog->id }}"
                                                                               {{ $blog->status ? 'checked' : '' }}>
                                                                        {{-- <label class="form-check-label status-label" for="toggle-{{ $slider->id }}">
                                                                            {{ $slider->status ? 'Active' : 'Inactive' }}
                                                                        </label> --}}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{-- <a href="{{ route('blog.show', $blog->id) }}"
                                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                    data-template="eyeOne">
                                                                    <i data-feather="eye" class="icon-xs"></i>
                                                                    <div id="eyeOne" class="d-none">
                                                                        <span>View</span>
                                                                    </div>
                                                                </a> --}}
                                                                <a href="{{ route('blog.edit', $blog->id) }}"
                                                                    class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                    data-template="editOne">
                                                                    <i data-feather="edit" class="icon-xs"></i>
                                                                    <div id="editOne" class="d-none">
                                                                        <span>Edit</span>
                                                                    </div>
                                                                </a>
                                                                {{-- <form action="{{ route('blog.destroy', $blog->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                                        data-template="trashOne">
                                                                        <i data-feather="trash-2" class="icon-xs"></i>
                                                                        <div id="trashOne" class="d-none">
                                                                            <span>Delete</span>
                                                                        </div>
                                                                    </button>
                                                                </form> --}}

                                                                <form action="{{ route('blog.destroy', $blog->id) }}"
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
            var table = $("#blogtable").DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
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
            $('.badge-status').on('click', function(){
                // alert('ok');
                let badge = $(this);
                let blogId = badge.data('id');
                let newStatus = badge.data('status') == 1 ? 0 : 1;


                $.ajax({
                    url: "{{ url('admin/blog/change-status') }}/" + blogId,
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status:newStatus
                    },
                    success: function(response){
                        if(response.status){
                            toastr.success('Status Change Successfully !', 'Success',{

                                timeOut:3000,
                                progressBar:true
                            });
                            badge.data('status', newStatus);
                            if(newStatus == 1){
                                badge.removeClass('badge-danger-soft').addClass('badge-success-soft').text('Active');
                            } else{
                                badge.removeClass('badge-success-soft').addClass('badge-danger-soft').text('Inactive');

                            }
                        }
                    },
                    error: function(xhr, status, error){
                        let errormessage = xhr.responseJSON ? xhr.responseJSON.message : responseText;
                        toastr.error('soemthing went wrong' + errormessage);
                    }

                });

            });

        });
    </script> --}}
    <script>
        $(document).ready(function(){
            $('.toggle-status').on('click', function(){
                // alert('ok')
                let toggleswitch = $(this);
                let blogId = toggleswitch.data('id');
                let newStatus = toggleswitch.prop('checked') ? 1 :0;

                $.ajax({
                    url: "{{ url('admin/blog/change-status') }}/" +blogId,
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response){
                        if(response.status){
                            toastr.success('Status Change Successfully !', 'Success', {
                                timeOut: 3000,
                                progressBar:true
                            });

                        } else{
                            toastr.error('failed to update');
                            toggleswitch.prop('checked', !newStatus);

                        }

                    },

                    error: function(xhr, status,error){
                            let errormessage = xhr.responseJSON ? xhr.responseJSON.message : responseText;
                            toastr.error('something went wrong' + errormessage);
                            toggleswitch.prop('checked', !newStatus);
                        }

                });

            });


        });
    </script>



@endpush
