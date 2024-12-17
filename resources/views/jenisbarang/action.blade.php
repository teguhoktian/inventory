<div class="text-right">
    <a href="{{ route('jenis-barang.edit', ['jenis_barang' => $id]) }}" class="btn btn-sm btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-sm btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['jenis-barang.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}