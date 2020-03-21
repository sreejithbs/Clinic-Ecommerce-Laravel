@extends('_clinic.partials.master')
@section('page_title', 'Update My Profile | Inner Beauty')
@section('page_heading', 'Update My Profile')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <form method="post" action="{{ route('clinic_profile_update') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="form-body">
                                <h4 class="form-section">
                                    <i class="ft-user-plus"></i> My Profile Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" value="{{ $clinic->name }}" class="form-control" placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" value="{{ $clinic->email }}" class="form-control" placeholder="Email" name="email" disabled>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="password">Change Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control border-primary" placeholder="************" name="password" data-parsley-validate-if-empty="true">
                                    </div>
                                </div>

                                <h4 class="form-section">
                                    <i class="ft-clipboard"></i> Clinic Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="clinic_reference_num">Clinic Reference Number </label>
                                    <div class="col-md-9">
                                        <input type="text" id="clinic_reference_num" class="form-control" value="{{ $clinic->clinic_profile->clinicRefNum }}" placeholder="Clinic Reference Number" name="clinic_reference_num" required data-parsley-required-message="Please enter Clinic Reference Number" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="clinic_name">Clinic Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="clinic_name" class="form-control" value="{{ $clinic->clinic_profile->clinicName }}" placeholder="Clinic Name" name="clinic_name" required data-parsley-required-message="Please enter Clinic Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="clinic_address">Clinic Address *</label>
                                    <div class="col-md-9">
                                        <textarea id="clinic_address" rows="5" class="form-control" name="clinic_address" placeholder="Address" required data-parsley-required-message="Please enter Clinic Address">{{ $clinic->clinic_profile->clinicAddress }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="phone_number">Phone Number *</label>
                                    <div class="col-md-9">
                                        <input type="number" id="phone_number" class="form-control" value="{{ $clinic->clinic_profile->phoneNumber }}" placeholder="Phone Number" name="phone_number" required data-parsley-required-message="Please enter Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="secondary_email">Secondary Email *</label>
                                    <div class="col-md-9">
                                        <input type="email" id="secondary_email" class="form-control" value="{{ $clinic->clinic_profile->secondaryEmail }}" placeholder="Secondary Email" name="secondary_email" required data-parsley-required-message="Please enter Secondary Email">
                                    </div>
                                </div>

                                <h4 class="form-section">
                                    <i class="ft-briefcase"></i> Bank Account Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="ac_number">Account Number *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="ac_number" class="form-control" value="{{ $clinic->clinic_profile->bankAcNumber }}" placeholder="Account Number" name="ac_number" required data-parsley-required-message="Please enter Bank Account Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="ac_holder_name">Account Holder Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="ac_holder_name" class="form-control" value="{{ $clinic->clinic_profile->bankAcHolderName }}" placeholder="Account Holder Name" name="ac_holder_name" required data-parsley-required-message="Please enter Bank Account Holder Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="bank_name">Bank Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="bank_name" class="form-control" value="{{ $clinic->clinic_profile->bankName }}" placeholder="Bank Name" name="bank_name" required data-parsley-required-message="Please enter Bank Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="bank_code">IFSC / SWIFT Code *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="bank_code" class="form-control" value="{{ $clinic->clinic_profile->bankCode }}" placeholder="Bank IFSC / SWIFT Code" name="bank_code" required data-parsley-required-message="Please enter Bank IFSC/SWIFT Code">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="bank_address">Bank Address *</label>
                                    <div class="col-md-9">
                                        <textarea id="bank_address" rows="5" class="form-control" name="bank_address" placeholder="Bank Address" required data-parsley-required-message="Please enter Bank Address">{{ $clinic->clinic_profile->bankAddress }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <a href="{{ route('clinic_dashboard') }}" class="btn btn-warning mr-1">
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