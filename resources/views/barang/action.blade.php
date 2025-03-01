<!-- <div class="text-right">
    <a href="{{ route('barang.show', ['barang' => $id]) }}" class="btn btn-sm btn-success text-muted mr-2">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('barang.edit', ['barang' => $id]) }}" class="btn btn-sm btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-sm btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div> -->

<a href="{{ route('barang.show', ['barang' => $id]) }}" class="btn btn-flat btn-sm btn-primary">
    <i class="fa fa-eye"></i> {{ __('Lihat Stok') }}
</a>
<a href="{{ route('barang.edit', ['barang' => $id]) }}" class="btn btn-flat btn-sm btn-success">
    <i class="fa fa-edit"></i> {{ __('Edit Barang') }}
</a>
@if ($hasLastStok)
<a href="{{ route('barang.adjust-stok', ['barang' => $id]) }}" class="btn btn-flat btn-sm btn-warning">
    <i class="fa fa-compress"></i> {{ __('Adjusment Stok') }}
</a>
@endif
<a href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')" class="btn btn-flat btn-sm btn-danger">
    <i class="fa fa-trash"></i> {{ __('Hapus') }}
</a>


{!! html()->form('DELETE', route('barang.destroy', $id))
->id('delete-form-' . $id)
->style('display: inline;')
->open() !!}

{!! html()->form()->close() !!}