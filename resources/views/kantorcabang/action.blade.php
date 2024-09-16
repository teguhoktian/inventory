<div class="text-right">
    <a href="{{ route('kantor-cabang.edit', ['kantor_cabang' => $id]) }}"
        class="btn btn-xs btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-xs btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['kantor-cabang.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}