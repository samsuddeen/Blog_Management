@extends('admin.layouts.app')

@section('content')

    <div id="app-content">
        <!-- Container fluid -->
        <div class="app-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="mb-5">
                            <h3 class="mb-0">Deleted List</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-md-flex border-bottom-0">
                                    <!-- Add any header content if necessary -->
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table id="deletedTable" class="table text-nowrap table-centered mt-0"
                                            style="width: 100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Added Date</th>
                                                    <th>Status</th>
                                                    <th>Deleted Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $deletedItems = $deleteduser
                                                        ->merge($deletedBlogs)
                                                        ->merge($deletedcategory);
                                                @endphp


                                                @if ($deletedItems->count() > 0)
                                                    @foreach ($deletedItems as $item)
                                                        <tr>
                                                            <td>
                                                                <span
                                                                    class="badge
                                                                       {{ $item instanceof \App\Models\User
                                                                           ? 'badge-primary-soft'
                                                                           : ($item instanceof \App\Models\Blog
                                                                               ? 'badge-info-soft'
                                                                               : 'badge-warning-soft') }}">
                                                                    {{ $item instanceof \App\Models\User ? 'User' : ($item instanceof \App\Models\Blog ? 'Blog' : 'Category') }}
                                                                </span>

                                                            </td>

                                                            <td>
                                                                <h5 class="mb-0">
                                                                    <a href="#!"
                                                                        class="text-inherit">{{ $item->name }}</a>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="mb-0">
                                                                    <a href="#!"
                                                                        class="text-inherit">{{ $item->title }}</a>
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ asset($item->image) }}"
                                                                        alt="{{ $item->title }}"
                                                                        class="img-4by3-sm rounded-3" />
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge {{ $item->status ? 'badge-success-soft' : 'badge-danger-soft' }}">
                                                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-warning-soft">Soft Deleted</span>
                                                            </td>
                                                            <td>
                                                                <!-- Restore Button -->
                                                                <form
                                                                    action="{{ $item instanceof \App\Models\User
                                                                        ? route('user.restore', $item->id)
                                                                        : ($item instanceof \App\Models\Blog
                                                                            ? route('blog.restore', $item->id)
                                                                            : route('category.restore', $item->id)) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip">
                                                                        <i data-feather="refresh-cw" class="icon-xs"></i>
                                                                    </button>
                                                                </form>

                                                                <form
                                                                    action="{{ $item instanceof \App\Models\User
                                                                        ? route('user.forceDelete', $item->id)
                                                                        : ($item instanceof \App\Models\Blog
                                                                            ? route('blog.forceDelete', $item->id)
                                                                            : route('category.forceDelete', $item->id)) }}"
                                                                    method="POST" style="display:inline;"
                                                                    class="delete-form-permanent">
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
                                                        <td colspan="7" class="text-center">
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
            var table = $("#deletedTable").DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            });

            $('.delete-form-permanent').on('submit', function(e) {
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
@endpush
