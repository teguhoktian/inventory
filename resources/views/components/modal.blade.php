@props(['headerClass' => ''])

<div class="modal fade" id="{{ $id }}">
    <div class="modal-dialog {{ $size ?? '' }}">
        <div class="modal-content">
            @isset($header)
            <div class="modal-header {{ $headerClass }}">
                {{ $header }}
            </div>
            @endisset

            @isset($body)
            <div class=" modal-body">
                {{ $body }}
            </div>
            @endisset

            @isset($footer)
            <div class="modal-footer">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>
</div>