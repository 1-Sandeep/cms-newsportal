@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Author - Trash</h1>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th style="text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                            <tr>
                                                {{-- <td>{{ $author->id }}</td> --}}
                                                <td style="text-align: center;"><img src="{{ $author->image }}"
                                                        alt=""
                                                        style="max-width: 50px; max-height:50px; border-radius:5px">
                                                </td>
                                                <td>{{ $author->name }}</td>
                                                <td>{!! Str::limit(strip_tags($author->description), 110, '...') !!}</span></td>
                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">

                                                    {!! Form::open([
                                                        'route' => ['backend.author.restore', $author->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('Restore', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-warning restoreauthor',
                                                        'title' => 'Restore author',
                                                        'data-id' => $author->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                    {{-- <a href="{{ route('backend.author.restore', $author->id) }}"
                                                        class="btn btn-warning" title="Restore author">
                                                        Restore
                                                    </a> --}}
                                                    {!! Form::open([
                                                        'route' => ['backend.author.delete', $author->id],
                                                        'method' => 'DELETE',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger deleteauthor',
                                                        'title' => 'Delete author',
                                                        'data-id' => $author->id,
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
                @include('layouts.pagination', ['data' => $authors])
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.deleteauthor').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var authorId = $(this).data('id'); // Get the author ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete this author!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        form.submit();
                    }
                });
            });


            // just want to warn user using sweetalert
            $('.restoreauthor').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var authorId = $(this).data('id'); // Get the author ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Post will be restored!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2DA111',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, restore author!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
