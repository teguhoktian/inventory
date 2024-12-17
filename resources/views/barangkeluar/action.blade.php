<div class="text-right">
    <a href="{{ route('barang-keluar.show', ['barang_keluar' => $id]) }}"
        class="btn btn-success text-muted mr-2 btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    <a class="text-muted btn btn-danger btn-sm" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['barang-keluar.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}