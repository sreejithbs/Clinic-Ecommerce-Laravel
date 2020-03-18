@extends('_admin.partials.master')
@section('page_title', 'Update My Profile | Inner Beauty')
@section('page_heading', 'Update My Profile')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form method="post" action="{{ route('admin_profile_update') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                        	{{ csrf_field() }}

                            <div class="form-body">
                                <h4 class="form-section">
                                    <i class="ft-user-plus"></i> My Profile Details
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
                                    <label class="col-md-3 label-control" for="password">Change Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control border-primary" placeholder="************" name="password" data-parsley-validate-if-empty="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_dashboard') }}" class="btn btn-warning mr-1">
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