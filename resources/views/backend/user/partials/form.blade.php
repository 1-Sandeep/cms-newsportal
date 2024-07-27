@php
    $third_segment = Request::segment(3);
    $is_create = $third_segment === 'create';
    $is_edit = $third_segment === 'edit';

    $name_value = old('name') ?? ($is_edit ? $user->name : '');
    $email_value = old('email') ?? ($is_edit ? $user->email : '');
    $is_active_value = old('is_active') ?? ($is_edit ? $user->is_active : true);

@endphp
@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">
                            @if ($is_create)
                                User - Create
                            @elseif ($is_edit)
                                User - Edit
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.user.index') }}" class="text-danger font-weight-bold">Go Back</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <div class="card-body">
                                {!! Form::open([
                                    'route' => $is_edit ? ['backend.user.update', $user->id] : ['backend.user.store'],
                                    'method' => $is_edit ? 'PUT' : 'POST',
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                ]) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}<span class="text-danger">*</span>
                                    {!! Form::text('name', $name_value, [
                                        'id' => 'name',
                                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                    ]) !!}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}<span class="text-danger">*</span>
                                    {!! Form::text('email', $email_value, [
                                        'id' => 'email',
                                        'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                        'readonly' => $is_edit ? 'readonly' : null,
                                    ]) !!}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password', 'Password') !!}<span class="text-danger">*</span>
                                    <div class="input-group">
                                        {!! Form::password('password', [
                                            'id' => 'password',
                                            'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                        ]) !!}
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i id="togglePasswordIcon" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Confirm Password') !!}<span class="text-danger">*</span>
                                    <div class="input-group">
                                        {!! Form::password('password_confirmation', [
                                            'id' => 'password_confirmation',
                                            'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''),
                                        ]) !!}
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="togglePasswordConfirmation">
                                                <i id="togglePasswordConfirmationIcon" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    {!! Form::label('image', 'Upload Image') !!}
                                    <span class="text-muted ml-2 text-sm">Max Size: 2MB</span>

                                    {!! Form::file('image', [
                                        'id' => 'image',
                                        'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''),
                                    ]) !!}

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('role', 'Select Role') !!}
                                    {!! Form::select('role[]', $roles->pluck('name', 'id'), $is_edit ? $selectedRoles : null, [
                                        'class' => 'form-control select-multiple-value select-role' . ($errors->has('role') ? ' is-invalid' : ''),
                                        'multiple' => 'multiple',
                                    ]) !!}
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('is_active', 'User Status') !!}
                                    {!! Form::checkbox('is_active', 1, $is_active_value, [
                                        'id' => 'is_active',
                                        'class' => 'form-check-input' . ($errors->has('is_active') ? ' is-invalid' : ''),
                                        'data-toggle' => 'toggle',
                                        'data-on' => ' ',
                                        'data-off' => ' ',
                                        'data-onstyle' => 'success',
                                        'data-offstyle' => 'danger',
                                        'data-size' => 'mini',
                                    ]) !!}
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    {!! Form::submit('Submit', ['class' => ' btn btn-primary']) !!}
                                    <a href="{{ route('backend.user.index') }}" class=" btn btn-danger">Cancel</a>
                                </div>

                            </div>
                            {!! Form::close() !!}
                            <!-- form close-->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const togglePasswordConfirmationIcon = document.getElementById('togglePasswordConfirmationIcon');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute for password
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // toggle the eye icon
                if (type === 'password') {
                    togglePasswordIcon.classList.remove('fa-eye-slash');
                    togglePasswordIcon.classList.add('fa-eye');
                } else {
                    togglePasswordIcon.classList.remove('fa-eye');
                    togglePasswordIcon.classList.add('fa-eye-slash');
                }
            });

            togglePasswordConfirmation.addEventListener('click', function(e) {
                // Toggle the type attribute for password confirmation
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);

                // Toggle the eye icon
                if (type === 'password') {
                    togglePasswordConfirmationIcon.classList.remove('fa-eye-slash');
                    togglePasswordConfirmationIcon.classList.add('fa-eye');
                } else {
                    togglePasswordConfirmationIcon.classList.remove('fa-eye');
                    togglePasswordConfirmationIcon.classList.add('fa-eye-slash');
                }
            });
        });



        $(document).ready(function() {
            // initializing select2 for select dropdown
            $('.select-multiple-value').select2(

            );
            // doesnot close dropdown on item select
            $('.select-role').select2({
                closeOnSelect: false
            });
        });
    </script>
@endsection
