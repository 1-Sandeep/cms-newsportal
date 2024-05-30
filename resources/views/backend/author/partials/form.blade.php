@php
    $third_segment = Request::segment(3);
    $is_create = $third_segment === 'create';
    $is_edit = $third_segment === 'edit';

    $title_value = old('name') ?? ($is_edit ? $author->name : '');
    $description_value = old('description') ?? ($is_edit ? $author->description : '');
    $is_active = old('is_actuve') ?? ($is_edit ? $author->is_active : true);

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
                                Author - Create
                            @elseif ($is_edit)
                                Author - Edit
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.author.index') }}" class="text-danger font-weight-bold">Go
                                    Back</a>
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
                                    'route' => $is_edit ? ['backend.author.update', $author->id] : ['backend.author.store'],
                                    'method' => $is_edit ? 'PUT' : 'POST',
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                ]) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}<span class="text-danger">*</span>
                                    {!! Form::text('name', $title_value, [
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
                                    {!! Form::label('description', 'Description') !!}<span class="text-danger">*</span>
                                    {!! Form::textarea('description', $description_value, [
                                        'id' => 'description',
                                        'class' => 'form-control tinyMCE' . ($errors->has('description') ? ' is-invalid' : ''),
                                    ]) !!}
                                    @error('description')
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
                                    {!! Form::label('is_active', 'Post Status') !!}
                                    {!! Form::checkbox('is_active', 1, $is_active, [
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
                                    <a href="{{ route('backend.author.index') }}" class=" btn btn-danger">Cancel</a>
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
