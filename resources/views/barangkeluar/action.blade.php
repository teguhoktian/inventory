<div class="text-right">
    <a href="{{ route('barang-keluar.show', ['barang_keluar' => $id]) }}"
        class="btn btn-success text-muted mr-2 btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    <a class="text-muted btn btn-danger btn-sm" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! html()->form('DELETE', route('barang-keluar.destroy', $id))
->id('delete-form-' . $id)
->style('display: inline;')
->open() !!}

{!! html()->form()->close() !!}