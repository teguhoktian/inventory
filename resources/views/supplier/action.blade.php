<div class="text-right">
    <a href="{{ route('supplier.edit', ['supplier' => $id]) }}" class="btn btn-sm btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-sm btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! html()->form('DELETE', route('supplier.destroy', $id))
->id('delete-form-' . $id)
->style('display: inline;')
->open() !!}

{!! html()->form()->close() !!}