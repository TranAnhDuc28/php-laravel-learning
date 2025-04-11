@if(session('success') || session('warning') || session('error'))
    <div class="alert alert-{{ session('success') ? 'success' : (session('warning') ? 'warning' : 'danger') }} fade show" role="alert">
        {{ session('success') ?? session('warning') ?? session('error') }}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
    </div>
@endif
