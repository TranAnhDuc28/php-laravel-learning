<div class="alert {{ 'alert-' . $type  }} alert-dismissible fade show msg-error text-danger mb-0 {{ $className }}" role="alert">
    @foreach($messages as $msg)
        <span class="text-danger">{{ $msg }}</span> <br>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

