@php
    $third_segment = Request::segment(3);
    $is_create = $third_segment === 'create';
    $is_edit = $third_segment === 'edit';

    $name_value = old('name') ?? ($is_edit ? $role->name : '');
    $slug_value = old('slug') ?? ($is_edit ? $role->slug : '');

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
                                Role - Create
                            @elseif ($is_edit)
                                Role - Edit
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.role.index') }}" class="text-danger font-weight-bold">Go Back</a>
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
                                    'route' => $is_edit ? ['backend.role.update', $role->id] : ['backend.role.store'],
                                    'method' => $is_edit ? 'PUT' : 'POST',
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
                                    {!! Form::label('slug', 'Slug') !!}<span class="text-danger">*</span>
                                    {!! Form::text('slug', $slug_value, [
                                        'id' => 'slug',
                                        'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''),
                                    ]) !!}
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {!! Form::label('permission', 'Permissions') !!} <span class="text-danger">*</span>
                                    {!! Form::select('permission[]', $permissions->pluck('name', 'id'), $is_edit ? $selectedPermissions : null, [
                                        'class' =>
                                            'form-control select-multiple-value select-permission' . ($errors->has('permissions') ? ' is-invalid' : ''),
                                        'multiple' => 'multiple',
                                    ]) !!}
                                    @error('permission')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    {!! Form::submit('Submit', ['class' => ' btn btn-primary']) !!}
                                    <a href="{{ route('backend.role.index') }}" class=" btn btn-danger">Cancel</a>
                                </div>

                                {!! Form::close() !!}
                            </div>
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
        $(document).ready(function() {
            $('.select-multiple-value').select2(

            );
            $('.select-permission').select2({
                closeOnSelect: false
            });

            $('#name').on('input', function() {
                var title = $(this).val().toLowerCase();
                var slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $('#slug').val(slug);
            });
        });
    </script>
@endsection
