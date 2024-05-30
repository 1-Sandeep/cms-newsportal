@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category - View</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.category.create') }}" class="btn btn-success mr-2">Add
                                    Category</a>
                                <a href="{{ route('backend.category.viewtrash') }}" class="btn btn-warning"
                                    title="Trash categorys">
                                    <i class="fas fa-trash"></i></a>
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
                                            <th style="wdith:10%; text-align: center;">Status</th>
                                            <th style="width:10%; text-align: center; ">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>


                                                <td>{{ $category->title }}</td>

                                                <td>{!! Str::limit(strip_tags($category->slug), 100, '...') !!}</span></td>

                                                <td style="text-align: center;">
                                                    {!! Form::checkbox('is_active', 1, $category->is_active == 1 ? true : false, [
                                                        'id' => 'is_active',
                                                        'class' => 'form-check-input is_active' . ($errors->has('is_active') ? ' is-invalid' : ''),
                                                        'data-toggle' => 'toggle',
                                                        'data-on' => ' ',
                                                        'data-off' => ' ',
                                                        'data-onstyle' => 'success',
                                                        'data-offstyle' => 'danger',
                                                        'data-size' => 'mini',
                                                        'data-id' => $category->id,
                                                    ]) !!}
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.category.edit', $category->id) }}"
                                                        class="btn btn-warning" title="Edit category">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.category.movetotrash', $category->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger movetotrash',
                                                        'title' => 'Move to trash',
                                                        'data-id' => $category->id,
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
                @include('layouts.pagination', ['data' => $categories])
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
            // jQuery to update published status of post
            $('.is_active').on('change', function() {
                let postId = $(this).attr('data-id');
                let isActive = $(this).prop('checked') ? 1 : 0;
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('backend.category.updatestatus', '') }}/${postId}`,
                    data: {
                        is_active: isActive,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(response) { // Fixed syntax error in error function parameter
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    },
                })
            });

            // just want to warn user using sweetalert
            $('.movetotrash').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var postId = $(this).data('id'); // Get the post ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, move to trash!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        form.submit();
                    }
                });
            });
        })
    </script>
@endsection
