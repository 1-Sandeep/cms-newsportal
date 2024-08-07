@foreach ($pages as $page)
    <tr>
        <td>{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>{!! Str::limit(strip_tags($page->description), 80, '...') !!}</td>
        <td style="text-align: center;">
            {!! Form::checkbox('status', 1, $page->status == 1 ? true : false, [
                'id' => 'status',
                'class' => 'form-check-input pageStatus' . ($errors->has('status') ? ' is-invalid' : ''),
                'data-toggle' => 'toggle',
                'data-on' => ' ',
                'data-off' => ' ',
                'data-onstyle' => 'success',
                'data-offstyle' => 'danger',
                'data-size' => 'mini',
                'data-id' => $page->id,
            ]) !!}
        </td>
        <td style="text-align: center; display: flex; justify-content: space-evenly;" class="gap-2">
            <button class="btn btn-warning editPage" data-id={{ $page->id }} title="Edit page">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger deletePage" data-id={{ $page->id }} title="Delete page">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
@endforeach
