@extends('_admin.partials.master')
@section('page_title', 'Add new Admin | Inner Beauty')
@section('page_heading', 'Add new Admin')

@section('content')

<section id="basic-form-layouts">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <form method="post" action="{{ route('admin_user_store') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                        	{{ csrf_field() }}

                            <div class="form-body">
                                <h4 class="form-section">
                                    <i class="ft-user-plus"></i> Admin Login Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control" placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email *</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" required data-parsley-required-message="Please enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="password">Password *</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" required data-parsley-required-message="Please enter Password">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="password_confirmation">Confirm Password *</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password_confirmation" class="form-control" placeholder="Confirm Password" name="password_confirmation" required data-parsley-required-message="Please re-enter Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_user_list') }}" class="btn btn-warning mr-1">
                                    <i class="la la-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
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