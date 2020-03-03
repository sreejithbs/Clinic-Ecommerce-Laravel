@extends('_admin.partials.master')
@section('page_title', 'Edit Clinic | Inner Beauty')
@section('page_heading', 'Edit Clinic')

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
                        <form method="post" action="{{ route('admin_clinic_update', $clinic->unqId) }}" enctype="multipart/form-data" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="">
                        	{{ csrf_field() }}

                            <div class="form-body">

                                <h4 class="form-section">
                                	<i class="ft-clipboard"></i> Clinic Info
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="clinic_reference_id">Clinic Reference ID </label>
                                    <div class="col-md-9">
                                        <input type="text" id="clinic_reference_id" class="form-control" value="{{ $clinic->clinic_profile->clinicReferenceId }}" placeholder="Clinic Reference ID" name="clinic_reference_id" required data-parsley-required-message="Please enter Clinic Reference ID" disabled>
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
                                	<i class="ft-user-plus"></i> Clinic Admin Login Details
                                </h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control" value="{{ $clinic->name }}"  placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email </label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" class="form-control" value="{{ $clinic->email }}" placeholder="Email" name="email" required data-parsley-required-message="Please enter Email" disabled>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="password">Password </label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control" value="*******************" placeholder="Password" name="password" required data-parsley-required-message="Please enter Password" disabled>
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
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="bank_code">IFSC / SWIFT Code *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="bank_code" class="form-control" value="{{ $clinic->clinic_profile->bankCode }}" placeholder="Bank IFSC / SWIFT Code" name="bank_code" required data-parsley-required-message="Please enter Bank IFSC/SWIFT Code">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="bank_address">Bank Address *</label>
                                    <div class="col-md-9">
                                        <textarea id="bank_address" rows="5" class="form-control" name="bank_address" placeholder="Bank Address" required data-parsley-required-message="Please enter Bank Address">{{ $clinic->clinic_profile->bankAddress }}</textarea>
                                    </div>
                                </div>

                                <h4 class="form-section">
                                    <i class="ft-credit-card"></i> Clinic Commission Settings
                                </h4>
                                 <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="commission_percentage">Commission Percentage *</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="number" id="commission_percentage" class="form-control" value="{{ $clinic->clinic_profile->commissionPercentage }}" placeholder="Commission Percentage" name="commission_percentage" min="0" step="0.01" value="10.00" required data-parsley-required-message="Please enter Commission Percentage" data-parsley-errors-container="#com_div">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div id="com_div"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <a href="{{ route('admin_clinic_list' ) }}" class="btn btn-warning mr-1">
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


