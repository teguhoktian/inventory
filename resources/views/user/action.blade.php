<div class="text-right">
    <a href="{{ route('user.edit', ['user' => $id]) }}" class="btn btn-primary text-muted mr-2">
        <i class="fa fa-edit"></i>
    </a>
    <a class="text-muted btn btn-danger" href="javascript:void(0)" onclick="submitDelete('delete-form-{{$id}}')">
        <i class="fa fa-trash"></i>
    </a>
</div>

{!! Form::open([
'id' => 'delete-form-'.$id,
'method' => 'DELETE',
'route' => ['user.destroy', $id],'style'=>'display:inline'])
!!}
{!! Form::close() !!}