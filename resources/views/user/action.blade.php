<div class="text-right">
    <a href="{{ route('user.edit', ['user' => $id]) }}" class="btn btn-sm btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i> Edit Data
    </a>
    <a class="text-muted btn btn-danger btn-sm" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i> Hapus Data
    </a>
</div>

{!! html()->form('DELETE', route('user.destroy', $id))
->id('delete-form-' . $id)
->style('display: inline;')
->open() !!}

{!! html()->form()->close() !!}