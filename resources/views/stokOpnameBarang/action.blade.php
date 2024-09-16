<div class="text-right">

    @if($status === 'Selesai')
    <a href="{{ route('stok-opname-barang.show', [$id]) }}" class="btn btn-xs btn-success text-muted mr-2">
        <i class="fa fa-eye"></i> {{__('Lihat Stok Opname')}}
    </a>
    @endif

    @if($status === 'Open')
    <a href="{{ route('stok-opname-barang.edit', [$id]) }}" class="btn btn-xs btn-info text-muted mr-2">
        <i class="fa fa-edit"></i> {{__('Edit Stok Opname')}}
    </a>
    @endif

    @if($status === 'Batal')
    <span class="label label-danger">
        {{__('Stok Opname Dibatalkan')}}
    </span>
    @endif

</div>