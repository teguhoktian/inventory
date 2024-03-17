<div class="text-right">
    <a href="{{ route('barang-masuk.show', ['barang_masuk' => $id]) }}" class="btn btn-success text-muted mr-2">
        <i class="fa fa-eye"></i>
    </a>
    <a class="text-muted btn btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['barang-masuk.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}