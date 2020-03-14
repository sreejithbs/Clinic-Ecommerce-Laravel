@extends('_admin.partials.master')
@section('page_title', 'List all Admins | Inner Beauty')
@section('page_heading', 'List all Admins')

@section('content')

<section id="basic-form-layouts">

    <div class="row">
        <div class="col-md-3 ml-auto">
            <div class="float-md-right">
                <a href="{{ route('admin_user_create') }}" class="btn btn-info btn-sm">
                    <i class="la la-plus-square"></i> Add New Admin
                </a>
            </div>
        </div>
    </div>
    <br/>

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
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $admin->name }}</td>
                                        <td> {{ $admin->email }} </td>
                                        <td> {{ $admin->created_at->format('d/m/Y') }} </td>
                                        <td>
                                            <a href="{{ route('admin_user_edit', $admin->unqId ) }}" class="btn btn-icon btn-info btn-sm">
                                                <i class="la la-edit"></i>
                                            </a>

                                            {!! Form::open(array(
                                                    'route' => array('admin_user_delete', $admin->unqId),
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