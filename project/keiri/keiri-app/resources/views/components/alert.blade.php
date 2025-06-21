<div class="alert {{ 'alert-' . $type  }} alert-dismissible fade show {{ $className }}" role="alert">
    @foreach($messages as $msg)
        <span class="{{ 'text-' . $type }}">{{ $msg }}</span> <br>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

