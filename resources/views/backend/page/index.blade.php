@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Page - View</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#page-form-modal-lg">
                                    Add Page
                                </button>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th style="width:10%; text-align: center;">Status</th>
                                            <th style="width:10%; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pages as $page)
                                            <tr>
                                                <td>{{ $page->title }}</td>

                                                <td>{{ $page->slug }}</td>

                                                <td>{!! Str::limit(strip_tags($page->description), 80, '...') !!}</span></td>

                                                <td style="text-align: center;">
                                                    {!! Form::checkbox('is_active', 1, $page->is_active == 1 ? true : false, [
                                                        'id' => 'is_active',
                                                        'class' => 'form-check-input is_active' . ($errors->has('is_active') ? ' is-invalid' : ''),
                                                        'data-toggle' => 'toggle',
                                                        'data-on' => ' ',
                                                        'data-off' => ' ',
                                                        'data-onstyle' => 'success',
                                                        'data-offstyle' => 'danger',
                                                        'data-size' => 'mini',
                                                        'data-id' => $page->id,
                                                    ]) !!}
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.page.edit', $page->id) }}"
                                                        class="btn btn-warning" title="Edit page">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.page.movetotrash', $page->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger movetotrash',
                                                        'title' => 'Move to trash',
                                                        'data-id' => $page->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                {{-- pagination --}}
                @include('layouts.pagination', ['data' => $pages])
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->


        <div class="modal fade" id="page-form-modal-lg">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Page</h4>
                        <button type="button" class="close closeModalBtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open([
                            'route' => 'backend.page.store',
                            'method' => 'POST',
                            'enctype' => 'multipart/form-data',
                            'id' => 'pageForm',
                        ]) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}<span class="text-danger">*</span>
                            {!! Form::text('title', null, [
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
                            {!! Form::text('slug', null, [
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
                            {!! Form::label('description', 'Description') !!}<span class="text-danger">*</span>
                            {!! Form::textarea('description', null, [
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
                            {!! Form::label('status', 'Page Status') !!}
                            {!! Form::checkbox('status', 1, true, [
                                'id' => 'status',
                                'class' => 'form-check-input' . ($errors->has('status') ? ' is-invalid' : ''),
                                'data-toggle' => 'toggle',
                                'data-on' => ' ',
                                'data-off' => ' ',
                                'data-onstyle' => 'success',
                                'data-offstyle' => 'danger',
                                'data-size' => 'mini',
                            ]) !!}
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {!! Form::close() !!}

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger closeModalBtn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveModalData">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#page-form-modal-lg').on('hidden.bs.modal', function() {
                $('#pageForm')[0].reset();

                // Remove validation error messages
                $('.invalid-feedback').remove();
                $('#pageForm').find('.is-invalid').removeClass('is-invalid');

                // Reset TinyMCE content if necessary
                if (typeof tinymce !== 'undefined') {
                    tinymce.get('description').setContent('');
                }
            });


            $('#title').on('input', function() {
                var title = $(this).val().toLowerCase();
                var slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $('#slug').val(slug);
            });

            $('#saveModalData').on('click', function() {
                // Ensure TinyMCE content is saved to the textarea
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }

                // Collect form data
                var formData = new FormData($('#pageForm')[0]);

                $.ajax({
                    url: '{{ route('backend.page.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response
                        $('#page-form-modal-lg').modal('hide');
                        // Optionally reset the form
                        $('#pageForm')[0].reset();
                        if (typeof tinymce !== 'undefined') {
                            tinymce.get('description').setContent('');
                        }
                        // Optionally show a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        // Clear previous error messages
                        $('.invalid-feedback').remove();
                        // Display error messages
                        $.each(errors, function(key, value) {
                            console.log(key,
                                value); // Log each key and value to see what you get
                            var input = $('#pageForm').find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after(
                                '<span class="invalid-feedback" role="alert"><strong>' +
                                value[0] + '</strong></span>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
