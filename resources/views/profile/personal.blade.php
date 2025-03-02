{!! html()->form('POST', route('profile.update'))
->attribute('id', 'personalForm')
->class('form-horizontal')
->acceptsFiles()
->open() !!}
<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Nama') }}</label>
    <div class="col-sm-10">
        {!! html()->text('name')
        ->value(Auth::user()->name)
        ->class('form-control' . ($errors->has('name') ? ' is-invalid' : '')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Username') }}</label>
    <div class="col-sm-10">
        {!! html()->text('username')
        ->value(Auth::user()->username)
        ->class('form-control' . ($errors->has('username') ? ' is-invalid' : '')) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="inputName">{{ __('Email') }}</label>
    <div class="col-sm-10">
        {!! html()->text('email')
        ->value(Auth::user()->email)
        ->class('form-control' . ($errors->has('email') ? ' is-invalid' : '')) !!}
    </div>
</div>

<div class="form-group">
    <label for="" class="col-sm-2 control-label"> {{ __('Image') }} </label>
    <div class="col-sm-10">
        <input type="file" name="image_profile" class="form-control" id="image_profile">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        <button type="submit" class="btn-flat btn btn-primary" id="personalBtn">{{ __('Update') }}</button>
    </div>
</div>

{!! html()->form()->close() !!}