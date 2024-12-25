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

<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <span class="fa fa-ellipsis-v"></span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <li>
            <a href="{{ route('barang.show', ['barang' => $id]) }}" class="text-light-blue">
                <i class="fa fa-eye"></i> {{ __('Lihat Stok') }}
            </a>
        </li>
        <li>
            <a href="{{ route('barang.edit', ['barang' => $id]) }}" class="text-green">
                <i class="fa fa-edit"></i> {{ __('Edit Barang') }}
            </a>
        </li>
        @if ($hasLastStok)
        <li>
            <a href="{{ route('barang.adjust-stok', ['barang' => $id]) }}" class="text-yellow">
                <i class="fa fa-compress"></i> {{ __('Adjusment Stok') }}
            </a>
        </li>
        @endif
        <li class="divider"></li>
        <li>
            <a href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')" class="text-red">
                <i class="fa fa-trash"></i> {{ __('Hapus') }}
            </a>
        </li>
    </ul>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['barang.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}