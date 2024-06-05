@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User - Trash</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.user.index') }}" class="text-danger font-weight-bold">Go Back</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th style="width:10%; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td style="text-align: center;">
                                                    @if (!$user->image)
                                                        <img src="{{ asset('uploads/default/defaultuser.png') }}"
                                                            alt="{{ $user->name }}"
                                                            style="max-width: 40px; max-height: 40px; border-radius:5px">
                                                    @else
                                                        <img src="{{ asset('uploads/user/' . $user->image) }}"
                                                            alt="{{ $user->name }}"
                                                            style="max-width: 40px; max-height: 40px; border-radius:5px">
                                                    @endif
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td> user role </span></td>
                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">

                                                    {!! Form::open([
                                                        'route' => ['backend.user.restore', $user->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-redo"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-warning restoreuser',
                                                        'title' => 'Restore user',
                                                        'data-id' => $user->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                    {{-- <a href="{{ route('backend.user.restore', $user->id) }}"
                                                        class="btn btn-warning" title="Restore user">
                                                        Restore
                                                    </a> --}}
                                                    {!! Form::open([
                                                        'route' => ['backend.user.delete', $user->id],
                                                        'method' => 'DELETE',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger deleteuser',
                                                        'title' => 'Delete user',
                                                        'data-id' => $user->id,
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
                @include('layouts.pagination', ['data' => $users])
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.deleteuser').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var userId = $(this).data('id'); // Get the user ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete this user!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        form.submit();
                    }
                });
            });


            // just want to warn user using sweetalert
            $('.restoreuser').on('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                var form = $(this).closest('form'); // Find the closest form element
                var userId = $(this).data('id'); // Get the user ID from data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'User will be restored!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2DA111',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, restore user!'
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
