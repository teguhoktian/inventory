<div class="text-right">
    <a href="{{ route('jabatan.edit', ['jabatan' => $jabatan->id]) }}" class="btn btn-sm btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-sm btn-danger" href="javascript:void(0)"
        onclick="submitDelete('delete-form-{{$jabatan->id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! html()->form('DELETE', route('jabatan.destroy', $jabatan->id))
->id('delete-form-' . $jabatan->id)
->style('display: inline;')
->open() !!}

{!! html()->form()->close() !!}