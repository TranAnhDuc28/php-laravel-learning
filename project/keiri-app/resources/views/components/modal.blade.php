<div class="modal fade {{ $classNameModal }} {{ $size }}" id="{{ $id }}" tabindex="-1" aria-hidden="true"
     @if($maskClosable) data-bs-backdrop="true" @else data-bs-backdrop="static" @endif>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{ $closable }}
                {{ $closable }}
                <h5 class="modal-title">{{ $title }}</h5>
                @if($closable)
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body">
                {!! $messages !!}
            </div>
            @if($footer !== false)
                <div class="modal-footer">
                    @if($isConfirmation)
                        <button type="button" class="btn btn-{{ $cancelType }}" {{ $cancelAttributes }} data-bs-dismiss="modal">{{ $cancelText }}</button>
                        <button type="button" class="btn btn-{{ $okType }}" {{ $okAttributes }} data-bs-dismiss="modal">{{ $okText }}</button>
                    @else
                        <form id="{{ $idForm }}" action="{{ $action }}" method="{{ $method }}">
                            @csrf
                            <button type="button" class="btn btn-{{ $cancelType }}" {{ $cancelAttributes }} data-bs-dismiss="modal">{{ $cancelText }}</button>
                            <button type="submit" class="btn btn-{{ $okType }}" {{ $okAttributes }}>{{ $okText }}</button>
                        </form>
                    @endif
                    {{ $footer ?? '' }}
                </div>
            @endif
        </div>
    </div>
</div>
