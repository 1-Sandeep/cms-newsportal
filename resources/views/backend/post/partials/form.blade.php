@php
    $third_segment = Request::segment(3);
    $is_create = $third_segment === 'create';
    $is_edit = $third_segment === 'edit';

    $title_value = old('title') ?? ($is_edit ? $post->title : '');
    $description_value = old('description') ?? ($is_edit ? $post->description : '');
    $summary_value = old('summary') ?? ($is_edit ? $post->summary : '');
    $is_published_value = old('is_published') ?? ($is_edit ? $post->is_published : true);

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
                                Post - Create
                            @elseif ($is_edit)
                                Post - Edit
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.post.index') }}" class="text-danger font-weight-bold">Go Back</a>
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
                                    'route' => $is_edit ? ['backend.post.update', $post->id] : ['backend.post.store'],
                                    'method' => $is_edit ? 'PUT' : 'POST',
                                    'enctype' => 'multipart/form-data',
                                    'files' => true,
                                ]) !!}

                                <div class="form-group">
                                    {!! Form::label('title', 'Title') !!}<span class="text-danger">*</span>
                                    {!! Form::text('title', $title_value, [
                                        'id' => 'title',
                                        'class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''),
                                    ]) !!}
                                    @error('title')
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
                                    {!! Form::label('summary', 'Summary') !!}
                                    {!! Form::textarea('summary', $summary_value, [
                                        'id' => 'summary',
                                        'class' => 'form-control tinyMCE' . ($errors->has('summary') ? ' is-invalid' : ''),
                                    ]) !!}
                                    @error('summary')
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

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        {!! Form::label('author', 'Select Author') !!} <span class="text-danger">*</span>
                                        {!! Form::select('author[]', $authors->pluck('name', 'id'), null, [
                                            'class' => 'form-control select-multiple-value select-author' . ($errors->has('author') ? ' is-invalid' : ''),
                                            'multiple' => 'multiple',
                                        ]) !!}
                                        @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        {!! Form::label('category', 'Select Category') !!} <span class="text-danger">*</span>
                                        {!! Form::select('category[]', $categories->pluck('title', 'id'), null, [
                                            'class' => 'form-control select-multiple-value select-category' . ($errors->has('category') ? ' is-invalid' : ''),
                                            'multiple' => 'multiple',
                                        ]) !!}
                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('is_published', 'Post Status') !!}
                                    {!! Form::checkbox('is_published', 1, $is_published_value, [
                                        'id' => 'is_published',
                                        'class' => 'form-check-input' . ($errors->has('is_published') ? ' is-invalid' : ''),
                                        'data-toggle' => 'toggle',
                                        'data-on' => ' ',
                                        'data-off' => ' ',
                                        'data-onstyle' => 'success',
                                        'data-offstyle' => 'danger',
                                        'data-size' => 'mini',
                                    ]) !!}
                                    @error('is_published')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group ">
                                    {!! Form::submit('Submit', ['class' => ' btn btn-primary']) !!}
                                    <a href="{{ route('backend.post.index') }}" class=" btn btn-danger">Cancel</a>
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
        $(document).ready(function() {
            // initializing select2 for select dropdown
            $('.select-multiple-value').select2(

            );
            // doesnot close dropdown on each item select
            $('.select-author').select2({
                closeOnSelect: false
            });
            $('.select-category').select2({
                closeOnSelect: false
            });
        });
    </script>
@endsection
