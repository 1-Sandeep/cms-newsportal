@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role - View</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.role.create') }}" class="btn btn-success mr-2">Add Role</a>
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
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th style="">Permissions</th>
                                            <th style="width: 10%; text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            {{-- @dd($role->permissions) --}}
                                            <tr>
                                                <td>{{ Str::limit($role->name, 20, '...') }}</td>

                                                <td>{!! Str::limit(strip_tags($role->slug), 30, '...') !!}</td>

                                                <td>
                                                    @if (isset($role->permissions) && count($role->permissions) > 0)
                                                        <div class="badge-container">
                                                            @foreach ($role->permissions as $permission)
                                                                <span
                                                                    class="badge badge-primary py-1 mx-2 my-1 h-4">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.role.edit', ['id' => $role->id]) }}"
                                                        class="btn btn-warning" title="Edit role">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.role.delete', 'id' => $role->id],
                                                        'method' => 'DELETE',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger deleterole',
                                                        'title' => 'Move to trash',
                                                        'data-id' => $role->id,
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
                @include('layouts.pagination', ['data' => $roles])
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

            // just want to warn user using sweetalert
            $('.deleterole').on('click', function(event) {
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
                    confirmButtonText: 'Yes, delete this role!'
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
