@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User - View</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.user.create') }}" class="btn btn-success mr-2">Add User</a>
                                <a href="{{ route('backend.user.viewtrash') }}" class="btn btn-warning" title="Trash users">
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th style="text-align: center;">Roles</th>
                                            <th style="width:10%; text-align: center;">Status</th>
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
                                                        <img src="{{ asset('uploads/users/' . $user->image) }}"
                                                            alt="{{ $user->name }}"
                                                            style="max-width: 40px; max-height: 40px; border-radius:5px">
                                                    @endif
                                                </td>

                                                <td>{{ $user->name }}</td>

                                                <td>{{ $user->email }}</td>

                                                <td style="text-align: center;">
                                                    @foreach ($user->role as $role)
                                                        <span class="badge badge-primary py-1 mx-2 my-1 h-4">
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </td>

                                                <td style="text-align: center;">
                                                    {!! Form::checkbox('is_active', 1, $user->is_active == 1 ? true : false, [
                                                        'id' => 'is_active',
                                                        'class' => 'form-check-input is_active' . ($errors->has('is_active') ? ' is-invalid' : ''),
                                                        'data-toggle' => 'toggle',
                                                        'data-on' => ' ',
                                                        'data-off' => ' ',
                                                        'data-onstyle' => 'success',
                                                        'data-offstyle' => 'danger',
                                                        'data-size' => 'mini',
                                                        'data-id' => $user->id,
                                                    ]) !!}
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.user.edit', ['id' => $user->id]) }}"
                                                        class="btn btn-warning" title="Edit user">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.user.movetotrash', 'id' => $user->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger movetotrash',
                                                        'title' => 'Move to trash',
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.is_active').on('change', function() {
                let postId = $(this).attr('data-id');
                let is_active = $(this).prop('checked') ? 1 : 0;
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('backend.user.updatestatus', '') }}/${postId}`,
                    data: {
                        is_active: is_active,
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
