@extends('admin.layouts.app')
@section('content')

<div id="app-content">


    <div class="app-content-area">
        <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
        <div class="container-fluid mt-n22">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <!-- Page header -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="mb-2 mb-lg-0">
                            <h3 class="mb-0 text-white">Dashboard</h3>
                        </div>
                        {{-- <div>
                            <a href="#!" class="btn btn-white">Create New Project</a>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                    <a href="{{ route('user.index') }}" class="text-decoration-none">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Total User</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                                        <i data-feather="briefcase" height="20" width="20"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $total_user ?? '' }}</h1>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                    <a href="{{ route('blog.index') }}" class="text-decoration-none">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Total Blogs</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                                        <i data-feather="briefcase" height="20" width="20"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $total_blogs ?? '' }}</h1>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                    <a href="{{ route('category.index') }}" class="text-decoration-none">
                        <div class="card h-100 card-lift">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Total Category</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                                        <i data-feather="briefcase" height="20" width="20"></i>
                                    </div>
                                </div>
                                <div class="lh-1">
                                    <h1 class="mb-1 fw-bold">{{ $total_categories ?? '' }}</h1>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>






        </div>
    </div>
</div>
@endsection
