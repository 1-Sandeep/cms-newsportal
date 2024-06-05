@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category - Trash</h1>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th style=" width: 10%; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->title }}</td>
                                                <td>{!! Str::limit(strip_tags($category->slug), 50, '...') !!}</span></td>
                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">

                                                    {!! Form::open([
                                                        'route' => ['backend.category.restore', $category->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-redo"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-warning restorecategory',
                                                        'title' => 'Restore category',
                                                        'data-id' => $category->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                    {{-- <a href="{{ route('backend.category.restore', $category->id) }}"
                                                        class="btn btn-warning" title="Restore category">
                                                        Restore
                                                    </a> --}}
                                                    {!! Form::open([
                                                        'route' => ['backend.category.delete', $category->id],
                                                        'method' => 'DELETE',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger deletecategory',
                                                        'title' => 'Delete category',
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
            $('.deletecategory').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var categoryId = $(this).data('id'); // Get the category ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete this category!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        form.submit();
                    }
                });
            });


            // just want to warn user using sweetalert
            $('.restorecategory').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var categoryId = $(this).data('id'); // Get the category ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Post will be restored!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2DA111',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, restore category!'
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
