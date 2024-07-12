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
                                <button class="btn btn-success">Add Page</button>
                                {{-- <a href="{{ route('backend.page.create') }}" class="btn btn-success mr-2">Add Page</a> --}}
                                {{-- <a href="{{ route('backend.page.viewtrash') }}" class="btn btn-warning"
                                    title="Trash authors">
                                    <i class="fas fa-trash"></i></a> --}}
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
                                {{-- <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th style="width:10%; text-align: center;">Status</th>
                                            <th style="width:10%; text-align: center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                            <tr>
                                                <td style="text-align: center;">
                                                    @if (!$author->image)
                                                        <img src="{{ asset('uploads/default/defaultuser.png') }}"
                                                            alt="{{ $author->name }}"
                                                            style="max-width: 40px; max-height: 40px; border-radius:5px">
                                                    @else
                                                        <img src="{{ $author->image }}" alt="{{ $author->name }}"
                                                            style="max-width: 40px; max-height: 40px; border-radius:5px">
                                                    @endif
                                                </td>

                                                <td>{{ $author->name }}</td>

                                                <td>{!! Str::limit(strip_tags($author->description), 65, '...') !!}</span></td>

                                                <td style="text-align: center;">
                                                    {!! Form::checkbox('is_active', 1, $author->is_active == 1 ? true : false, [
                                                        'id' => 'is_active',
                                                        'class' => 'form-check-input is_active' . ($errors->has('is_active') ? ' is-invalid' : ''),
                                                        'data-toggle' => 'toggle',
                                                        'data-on' => ' ',
                                                        'data-off' => ' ',
                                                        'data-onstyle' => 'success',
                                                        'data-offstyle' => 'danger',
                                                        'data-size' => 'mini',
                                                        'data-id' => $author->id,
                                                    ]) !!}
                                                </td>

                                                <td style="text-align: center; display: flex; justify-content: space-evenly;"
                                                    class="gap-2">
                                                    <a href="{{ route('backend.author.edit', $author->id) }}"
                                                        class="btn btn-warning" title="Edit author">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {!! Form::open([
                                                        'route' => ['backend.author.movetotrash', $author->id],
                                                        'method' => 'PUT',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fas fa-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger movetotrash',
                                                        'title' => 'Move to trash',
                                                        'data-id' => $author->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                {{-- pagination --}}
                {{-- @include('layouts.pagination', ['data' => $pages]) --}}
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
