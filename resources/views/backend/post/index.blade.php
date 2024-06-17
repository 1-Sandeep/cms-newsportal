@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Post - View</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.post.create') }}" class="btn btn-success mr-2">Add Post</a>
                                <a href="{{ route('backend.post.viewtrash') }}" class="btn btn-warning" title="Trash posts">
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
                                            <th style="width:10%; text-align: center;">Image</th>
                                            <th>Title</th>
                                            <th>Summary</th>
                                            <th>Description</th>
                                            <th style="width:10%; text-align: center;">Status</th>
                                            <th style="width:10%; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td style="text-align: center;">
                                                    @if (!$post->image)
                                                        <img src="{{ asset('uploads/default/defaultpost.png') }}"
                                                            alt="{{ $post->title }}"
                                                            style="max-width: 50px; max-height:50px; border-radius:5px">
                                                    @else
                                                        <img src="{{ asset('uploads/post/' . $post->image) }}"
                                                            alt="{{ $post->title }}"
                                                            style="max-width: 50px; max-height:50px; border-radius:5px">
                                                    @endif
                                                </td>

                                                <td>{{ Str::limit($post->title, 20, '...') }}</td>

                                                <td>{!! Str::limit(strip_tags($post->summary), 30, '...') !!}</td>

                                                <td>{!! Str::limit(strip_tags($post->description), 65, '...') !!}</span></td>

                                                <td style="text-align: center;">
                                                    {!! Form::checkbox('is_published', 1, $post->is_published == 1 ? true : false, [
                                                        'id' => 'is_published',
                                                        'class' => 'form-check-input is_published' . ($errors->has('is_published') ? ' is-invalid' : ''),
                                                        'data-toggle' => 'toggle',
                                                        'data-on' => ' ',
                                                        'data-off' => ' ',
                                                        'data-onstyle' => 'success',
                                                        'data-offstyle' => 'danger',
                                                        'data-size' => 'mini',
                                                        'data-id' => $post->id,
                                                    ]) !!}
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.post.edit', ['id' => $post->id]) }}"
                                                        class="btn btn-warning" title="Edit post">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.post.movetotrash', 'id' => $post->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger movetotrash',
                                                        'title' => 'Move to trash',
                                                        'data-id' => $post->id,
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
                @include('layouts.pagination', ['data' => $posts])
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
            $('.is_published').on('change', function() {
                let postId = $(this).attr('data-id');
                let isPublished = $(this).prop('checked') ? 1 : 0;
                // alert(postId + ": " + isPublished); // Fixed syntax error in alert statement
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('backend.post.updatestatus', '') }}/${postId}`,
                    data: {
                        is_published: isPublished,
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
