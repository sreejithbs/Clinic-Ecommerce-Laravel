@extends('_admin.partials.master')
@section('page_title', 'List all Clinics | Inner Beauty')
@section('page_heading', 'List all Clinics')

@section('content')

<section id="basic-form-layouts">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header"> -->
                    <!-- <h4 class="card-title" id="bordered-layout-basic-form"></h4> -->
                <!-- </div> -->
                <div class="card-content collpase show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Reference ID</th> -->
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email Addresses</th>
                                    <th>Commission</th>
                                    <!-- <th>Account Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clinics as $clinic)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <!-- <td> {{ $clinic->clinic_profile->clinicReferenceId }}</td> -->
                                        <td> {{ $clinic->clinic_profile->clinicName }}</td>
                                        <td>
                                            {!! Str::limit($clinic->clinic_profile->clinicAddress, 40, ' ...') !!}
                                        </td>
                                        <td>
                                            <strong> {{ $clinic->email }} </strong> (primary),
                                            <br/>
                                            <strong> {{ $clinic->clinic_profile->secondaryEmail }} </strong> (secondary)

                                        </td>
                                        <td> {{ $clinic->clinic_profile->commissionPercentage }} %</td>
                                        <td>

                                            <a href="{{ route('admin_clinic_edit', $clinic->unqId ) }}" class="btn btn-icon btn-info btn-sm">
                                                <i class="la la-eye"></i>
                                            </a>

                                            {!! Form::open(array(
                                                    'route' => array('admin_clinic_delete', $clinic->unqId),
                                                    'method' => 'delete',
                                                    'class'=>'delSwalForm',
                                                    'style'=>'display:inline'
                                            )) !!}

                                            <button type="submit" class="btn btn-icon btn-danger btn-sm delSwal">
                                                <i class="la la-trash"></i>
                                            </button>

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection