<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $size ?? '' }}" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="{{ $id }}Label">{{ $title }}</h4>
            </div>
            <!-- /.modal-header -->

            <div class="modal-body">
                {{ $slot }}
            </div>
            <!-- /.modal-body -->

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">{{ $closeText ??
                    __('Close') }}</button>
                @if (isset($submitText))
                <button type="submit" class="btn btn-primary btn-flat">{{ $submitText }}</button>
                @endif
            </div>
            <!-- /.modal-footer -->

        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->

</div>
<!-- /.modal -->