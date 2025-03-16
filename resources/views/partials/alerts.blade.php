@if (session('success'))
    <div class="alert alert-success mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error mb-4">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning mb-4">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info mb-4">
        {{ session('info') }}
    </div>
@endif
