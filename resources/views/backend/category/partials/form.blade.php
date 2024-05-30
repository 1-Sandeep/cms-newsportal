@php
    $third_segment = Request::segment(3);
    $is_create = $third_segment === 'create';
    $is_edit = $third_segment === 'edit';

    $title_value = old('title') ?? ($is_edit ? $category->title : '');
    $slug_value = old('slug') ?? ($is_edit ? $category->slug : '');
    $is_active = old('is_actuve') ?? ($is_edit ? $category->is_active : true);

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
                                Category - Create
                            @elseif ($is_edit)
                                Category - Edit
                            @endif
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.category.index') }}" class="text-danger font-weight-bold">Go
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
                                    'route' => $is_edit ? ['backend.category.update', $category->id] : ['backend.category.store'],
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
                                    {!! Form::label('is_active', 'Category Status') !!}
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
                                    <a href="{{ route('backend.category.index') }}" class=" btn btn-danger">Cancel</a>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#title').on('input', function() {
                var title = $(this).val().toLowerCase();
                var slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $('#slug').val(slug);
            });
        })
    </script>
@endsection
