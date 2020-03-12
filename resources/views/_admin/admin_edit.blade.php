@extends('_admin.partials.master')
@section('page_title', 'Edit Admin | Inner Beauty')
@section('page_heading', 'Edit Admin')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h4 class="card-title" id="bordered-layout-basic-form">Info</h4>
                </div> -->
                <div class="card-content collpase show">
                    <div class="card-body">
                        <!-- <div class="card-text">
                            <p>Info</p>
                        </div> -->
                        <form method="post" action="{{ route('admin_user_update', $admin->unqId) }}" enctype="multipart/form-data" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}

                            <div class="form-body">

                                <h4 class="form-section">
                                	<i class="ft-user-plus"></i> Admin Login Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" value="{{ $admin->name }}" class="form-control" placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" value="{{ $admin->email }}" class="form-control" placeholder="Email" name="email" disabled>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="email">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control" value="*******************" placeholder="Password" name="password" disabled="">
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_user_list' ) }}" class="btn btn-warning mr-1">
                                    <i class="la la-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection