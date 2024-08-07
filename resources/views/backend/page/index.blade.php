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
                                    <tbody id="pagesTableBody">
                                        @include('backend.page.partials.pages_table', ['pages' => $pages])
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                {{-- pagination here --}}

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
            // CSRF Token for Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Remove all invalid messages, classes, and clear form fields once the modal is closed
            $('#page-form-modal-lg').on('hidden.bs.modal', function() {
                $('#pageForm')[0].reset();
                $('.invalid-feedback').remove();
                $('#pageForm').find('.is-invalid').removeClass('is-invalid');

                if (typeof tinymce !== 'undefined') {
                    tinymce.get('description').setContent('');
                }
            });

            // Generate slug from title
            $('#title').on('input', function() {
                var title = $(this).val().toLowerCase();
                var slug = title.replace(/\s+/g, '-').replace(/[^a-z0-9-]/g, '');
                $('#slug').val(slug);
            });

            // Function to generate table row HTML
            function generateTableRow(page) {

                let truncatedTitle = page.title.length > 20 ? page.title
                    .substring(0,
                        20) +
                    '...' : page.title;
                let truncatedSlug = page.slug.length > 20 ? page.slug.substring(0,
                        20) +
                    '...' : page.slug;
                let parsedDescription = $('<div/>').html(page.page_description).text();

                // displaying parsed description if not null also check for the character count, else set to an empty string
                let truncatedParsedDescription = parsedDescription !== null ?
                    (parsedDescription.length > 30 ? parsedDescription.substring(0,
                            30) +
                        '...' : parsedDescription) : '';
                return `
                <tr>
                    <td>${truncatedTitle}</td>
                    <td>${truncatedSlug}</td>
                    <td>${truncatedParsedDescription}</td>
                    <td style="text-align: center;">
                        <input type="checkbox" class="form-check-input pageStatus" data-toggle="toggle"
                            data-on=" " data-off=" " data-onstyle="success" data-offstyle="danger"
                            data-size="mini" data-id="${page.id}" ${page.status ? 'checked' : ''}>
                    </td>
                    <td style="text-align: center; display: flex; justify-content: space-evenly;">
                        <button class="btn btn-warning editPage" data-id="${page.id}" title="Edit page">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger deletePage" data-id="${page.id}" title="Delete page">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            }

            // Toggle page status
            $(document).on('change', '.pageStatus', function() {
                let pageId = $(this).attr('data-id');
                let status = $(this).prop('checked') ? 1 : 0;
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('backend.page.updateStatus', ':id') }}`.replace(':id',
                        pageId),
                    data: {
                        status: status,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message ||
                                'Failed to update status.',
                        });
                    },
                });
            });

            // Delete page
            $(document).on('click', '.deletePage', function() {
                let pageId = $(this).attr('data-id');
                // Confirm deletion
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: `{{ route('backend.page.delete', ':id') }}`.replace(':id',
                                pageId),
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                }).then(() => {
                                    // Optionally remove the page row from the table
                                    $(`button.deletePage[data-id="${pageId}"]`)
                                        .closest('tr').remove();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON.message ||
                                        'Failed to delete the page.',
                                });
                            },
                        });
                    }
                });
            });

            $('#saveModalData').on('click', function() {
                // Saving content of TinyMCE to textarea
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }

                // Collecting form field data
                var formData = new FormData($('#pageForm')[0]);

                $.ajax({
                    url: '{{ route('backend.page.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#page-form-modal-lg').modal('hide');
                        $('#pageForm')[0].reset();
                        if (typeof tinymce !== 'undefined') {
                            tinymce.get('description').setContent('');
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });

                        // Append the new row to the table
                        generateTableRow(response.page);

                        // Optionally reinitialize any plugins like Bootstrap Toggle
                        $('input[data-toggle="toggle"]').bootstrapToggle();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('.invalid-feedback').remove();
                        $.each(errors, function(key, value) {
                            var input = $('#pageForm').find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.after(
                                '<span class="invalid-feedback" role="alert"><strong>' +
                                value[0] + '</strong></span>'
                            );
                        });
                    }
                });
            });

        });
    </script>
@endsection
