<div class="box box-solid box-{{ $type }} 
    {{ $flat ? 'box-flat' : '' }} 
    {{ $shadow ? 'box-shadow' : '' }}">

    @isset($header)
    <div class="box-header">
        <h2 class="box-title">{{ $header }}</h2>
    </div>
    @endisset

    <div class="box-body">
        {{ $slot }}
    </div>

    @isset($footer)
    <div class="box-footer">
        {{ $footer }}
    </div>
    @endisset
</div>