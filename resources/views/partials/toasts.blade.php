@if (Session::has('success') || Session::has('failed'))
<div class="bs-toast toast toast-placement-ex m-2 fade {{ Session::has('success') ? 'bg-primary' : 'bg-danger' }} top-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
    <div class="toast-header">
        <i class='bx bx-bell me-2'></i>
        <div class="me-auto fw-semibold">Alert</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        @if (Session::has('success'))
            {{ Session::get('success') }}
        @elseif(Session::has('failed'))
            {{ Session::get('failed') }}
        @endif
    </div>
</div>
@endif