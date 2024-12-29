@props(['headerClass' => ''])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog {{ $size ?? '' }}" role="document">
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